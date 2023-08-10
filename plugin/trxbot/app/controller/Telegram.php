<?php
namespace plugin\trxbot\app\controller;
 
use support\Request;
use Tntma\Tntjwt\Auth;
use support\Redis; 
use support\Log;//日志
use GuzzleHttp\Pool;
use GuzzleHttp\Client as Guzz_Client;
use GuzzleHttp\Psr7\Request as Guzz_Request; 
use GuzzleHttp\Promise as Guzz_Promise;

use Vectorface\GoogleAuthenticator;#谷歌验证
use think\facade\Db;#mysql https://www.kancloud.cn/manual/think-orm/1258003

use think\facade\Cache;
use app\model;

use plugin\trxbot\app\controller\tgapi_inline_query; 
use plugin\trxbot\app\controller\tgapi_Message;
use plugin\trxbot\app\controller\tgapi_callback_query;
use plugin\trxbot\app\controller\tgapi_group_power;
use plugin\trxbot\app\controller\tgapi_group_user_notify;
use plugin\trxbot\app\controller\tgapi_group_newTitle;
use plugin\trxbot\app\controller\tgapi_callback_game;
use plugin\trxbot\app\controller\tgapi_group_move;


class Telegram extends Base{ 
    
    public function index(Request $request){  
        $data = $request->all();   
        if(empty($data) || empty(localIP())){
            return json(["code"=>1,"msg"=>"你小子搞什么飞机?,版权：www.telegbot.org",]);   
        }  
        if(empty($this->BOT)){ 
            echo "消息接口错误,请配置应用：{$this->plugin}_{$this->tobot}的机器人数据\n"; 
            return true;  
        } 
        if(empty($this->setup['PrivateKey'])){ 
            echo "消息接口错误,请配置机器人：{$this->plugin}_{$this->tobot}的钱包数据\n"; 
            #$this->send("/sendMessage?chat_id={$this->BOT['Admin']}&text=<b>管理员你好,机器人出错提示：</b>\n未配置钱包数据·请登录后台配置");
            // if(!empty($data['message']['chat']['id'])){
            //     $this->send("/sendMessage?chat_id={$data['message']['chat']['id']}&text=<b>错误·该机器人未启动</b>\n请联系老板登录管理后台配置兑换信息"); 
            // }
            return true;  
        } 
        echo "\n\n-------------------------\n收到机器人WebHook调试消息：\n";
        print_r($data); 
        if(!Redis::SETNX($data['update_id'],1)){  
            Log::info("消息二次通知过滤",$data); 
            $this->send("/sendMessage?chat_id={$this->BOT['Admin']}&text=机器人运行错误提示\n以下消息被过滤(不做任何处理)\n<code>".json_encode($data,JSON_UNESCAPED_UNICODE)."</code>");
            return true;     
        }
        Redis::EXPIRE($data['update_id'],10);
        
        #这里检查用户数据 使用本地缓存 
        if(!empty($data['message']['chat']['type'])){
            $chatId = $data['message']['chat']['id'];
            
             if($data['message']['chat']['type'] =="supergroup" || $data['message']['chat']['type'] =="group"){
                 #检查群
                $group =  model\bot_group::where("plugin",$this->plugin)->where("bot",$this->tobot)->where('groupid', $chatId)->cache("{$chatId}{$this->tobot}")->find();
                 if(empty($group)){
                    $group['plugin']=$this->plugin; 
                    $group['bot']=$this->tobot; 
                    $group['groupid']=$chatId; 
                    $group['grouptitle']=$data['message']['chat']['title']??"未设置群标题"; 
                    $group['groupname']=$data['message']['chat']['username']??"私密";  
                    $group['time']=$data['message']['date']; 
                    Db::name('bot_group')->insert($group);   
                 } 
                #检查成员 
                $user_id =  $data['message']['from']['id'];
                $group_user =  model\bot_group_user::where("qunid",$chatId)->where("userid",$user_id)->cache("{$chatId}_{$user_id}")->find();
                if(empty($group_user)){
                    $group_user['qunid']=$chatId;
                    $group_user['quninfo']=json_encode($data['message']['chat'],JSON_UNESCAPED_UNICODE);
                    $group_user['userid']=$user_id;
                    $group_user['userinfo']=json_encode($data['message']['from'],JSON_UNESCAPED_UNICODE); 
                    $group_user['cretae_time']=$data['message']['date'];
                    Db::name('bot_group_user')->insert($group_user);   
                }else{
                    
                    $tgx = $data['message']['from']['first_name'] ?? "";
                    $tgx .= $data['message']['from']['last_name'] ?? "";
                    $sqx = $group_user['userinfo']['first_name'] ?? "";
                    $sqx .= $group_user['userinfo']['last_name'] ?? ""; 
                   
                   if($tgx != $sqx){ 
                       $username = $data['message']['from']['username'] ?? "未设置用户名"; 
                      $text = "<b>用户修改昵称提示</b>
                      用户名：@{$username}
                      原昵称：<b>{$sqx}</b>
                      新昵称：<b>{$tgx}</b>
                      \n请注意规避风险,谨防假冒管理员" ;
                      model\bot_group_user::where("qunid",$chatId)->where("userid",$user_id)->cache("{$chatId}_{$user_id}")->update(['userinfo'=>json_encode($data['message']['from'],JSON_UNESCAPED_UNICODE)]);
                      $this->send("/sendMessage?chat_id={$chatId}&text={$text}");  
                   }    
                    
                    
                }
                 
                 
             }else if($data['message']['chat']['type'] == "private"){
                 #检查用户
                 $user =  Db::name('account_tg')->where("bot",$this->tobot)->where('tgid', $chatId)->cache("{$chatId}{$this->tobot}")->find();
                 if(empty($user)){ 
                     echo "没有用户数据\n";
                    $user['bot']=$this->tobot; 
                    $user['tgid']=$chatId; 
                    $user['username']=$data['message']['chat']['username']??"未设置用户名";  
                    $user['name']=$data['message']['chat']['first_name']??""; 
                    $user['name'].=$data['message']['chat']['last_name']??"";  
                    $user['regtime']=$data['message']['date']; 
                    Db::name('account_tg')->insert($user);   
                    
                    $dated = date("Ymd",$data['message']['date']); 
                    $bot_total_d = Db::name('bot_total_d')->where('bot', $this->BOT['API_BOT'])->where('dated', $dated)->cache("{$dated}{$this->tobot}")->find(); 
                    if(empty($bot_total_d)){
                        $bot_total_d['bot'] = $this->BOT['API_BOT']; 
                        $bot_total_d['dated'] = $dated;
                        $bot_total_d['user'] = 1;
                        $bot_total_d['time'] = $data['message']['date'];
                        Db::name('bot_total_d')->insert($bot_total_d);  
                    }else{ 
                        Db::name('bot_total_d')->where('id', $bot_total_d['id'])->inc("user",1)->update(); 
                    }  
                    
                 }
                 
             } 
        }
        #缓存检查结束
        
         
        #----------
        if(!empty($data['message']['text'])){ //文本消息
            $act = new tgapi_Message();
            $act->index($data['message']); 
            return true; 
        }else if(!empty($data['message']['photo'])){ //图片消息
            if(empty($data['message']['caption'])){//没有说明文字阻断 
                return true;  
            }  
            $act = new tgapi_Message();
            $act->index($data['message'],"photo"); 
            return true; 
        }else if(!empty($data['inline_query'])){  //@内联查询事件 
            $inline_query = new tgapi_inline_query();
            $inline_query->index($data['inline_query']); 
            return true;    
        }else if(!empty($data['callback_query']['data'])){  //按钮点击事件
            $callback_query = new tgapi_callback_query();
            $callback_query->index($data['callback_query']); 
            return true;    
        }else if(!empty($data['my_chat_member']['new_chat_member']['status'])){ //机器人群事件
            #$type = $data['my_chat_member']['new_chat_member']['status']; 
            $group_power = new tgapi_group_power();
            $group_power->index($data['my_chat_member']);  
            return true; 
        }else if(!empty($data['chat_member']['new_chat_member']['user'])){ //通用群事件
            $group_new = new tgapi_group_user_notify();
            $group_new->index($data['chat_member']); 
            return true;  
        }else if(!empty($data['message']['new_chat_title'])){ //群修改标题事件
            $group_newTitle = new tgapi_group_newTitle();
            $group_newTitle->index($data['message']); 
            return true;  
        }else if(!empty($data['channel_post']['new_chat_title'])){ //频道修改标题事件
            $group_newTitle = new tgapi_group_newTitle();
            $group_newTitle->index($data['channel_post']); 
            return true;  
        }else if(!empty($data['callback_query']['game_short_name'])){  //按钮点击事件
            $callback_game = new tgapi_callback_game();
            $callback_game->index($data['callback_query']); 
            return true;    
        }else if(!empty($data['message']['migrate_to_chat_id'])){ //群升级消息
            $group_move = new tgapi_group_move();
            $group_move->index($data['message']); 
            return true;    
        }
        
        
        
        echo "--------【".$request->plugin."】以上消息不支持------------\n"; 
        return true; 
    } 
 
 
     #登录鉴权 与 loginurl 不同
    public function login($request){  
          $authData = $request->post();   
          if(empty($authData['hash']) || empty($authData['user']) || empty($authData['auth_date'])){
              return json(["code"=>2,"msg"=>"请在电报机器人：".$this->BOT['API_BOT']." 内打开本页面",]);  
          }
          $check_hash = $authData['hash'];
          unset($authData['hash']); 
          $data_check_arr=[]; 
          foreach ($authData as $key => $value) {
              if(is_array($value)){
                  $data_check_arr[] = $key . '=' . json_encode($value,JSON_UNESCAPED_UNICODE);
              }else{
                  $data_check_arr[] = $key . '=' . $value;
              }  
          } 
          sort($data_check_arr);
          $data_check_string = implode("\n", $data_check_arr);  
          $secret = hash_hmac('sha256', $this->BOT['API_TOKEN'], 'WebAppData',TRUE);
          $hash = hash_hmac('sha256', $data_check_string, $secret); 
          if($hash != $check_hash){
              return json(["code"=>3,"msg"=>"小伙子,不要搞事哟,版权：www.telegbot.org",]);   
          } 
        //   if ((time() - $authData['auth_date']) > 86400) {
        //       return json(["code"=>0,"msg"=>"登录过期,请重新登录哟",]); 
        //   } 
        
         $user = Db::name('account_tg')->where('bot', $this->BOT['API_BOT'])->where('tgid', $authData['user']['id'])->find();
         if(empty($user)){
            $namea = $authData['user']['last_name'] ?? "";
            $nameb = $authData['user']['first_name'] ?? ""; 
            $user['bot'] = $this->BOT['API_BOT'];  
            $user['tgid'] = $authData['user']['id'];  
            $user['roleId'] = 1;  
            $user['username'] = $authData['user']['username'] ?? "未设置"; 
            $user['name'] = $namea.$nameb; 
            $user['regtime'] = time(); 
            $user['id'] = Db::name('account_tg')->insertGetId($user);   
         }  
         $user['remark'] = $this->BOT['API_BOT']; 
         $tokenObject = Auth::login($user);//生成token  
        //   $JWTuid = $user['id'];//定义储存ID
        //   $JWT_MD5 = $tokenObject->token_md5;//取得token md5
        //   Redis::HSET("TG_login",$JWT_MD5,time());//储存到redis
        //   redis::EXPIRE("TG_login_{$JWTuid}",config('plugin.TNTma.tntjwt.app.exp'));//设置过期时间  
        $authData['user']['roleId'] = $user['roleId'];
        return json(["code"=>1,"msg"=>"成功","data"=>$tokenObject,"user"=>$authData['user']]); 
    } 
    
     
    
    
}