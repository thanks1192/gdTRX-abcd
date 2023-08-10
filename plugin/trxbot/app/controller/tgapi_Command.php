<?php
namespace plugin\trxbot\app\controller;


use TNTma\TronWeb\Address;
use TNTma\TronWeb\Account;
use TNTma\TronWeb\Tron; 

use support\Redis;//redis缓存
use Hashids\Hashids; //数字加密
use Vectorface\GoogleAuthenticator;#谷歌验证
use Webman\RedisQueue\Client; #redis queue 队列
use think\facade\Db;#mysql https://www.kancloud.cn/manual/think-orm/1258003
use think\facade\Cache;#Cache https://www.kancloud.cn/manual/thinkphp6_0/1037634
use Tntma\Tntjwt\Auth; 

//负责处理：所有菜单命令事件(包括私聊 群聊) 只要消息内容是以：/ 开头的消息这个文件接收处理
class tgapi_Command extends Base{ 
    public function index($message){  
        $bot = $this->BOT['API_BOT'];
        $by = $this->BOT['Admin']; 
        
        $chatType = $message['chat']['type']; //会话类型 私人 群组 频道
        $chatId = $message['chat']['id'];//会话聊天ID
        $tgid = $message['from']['id'];//用户ID  
        
        if($chatType == "group"){
            $chatType = "supergroup";  
        } 
        
        preg_match('/\/(\w+)\s*(.*)/i', $message['text'], $com); 
        if(count($com) != 3){ 
            return true;
        } 
        
         
        
        $type = $com[1]; //正则取得的菜单命令内容
        $value = $com[2];
        
        if(!empty($value)){
            if($value[0] == "@"){//当指令带@时进行判断是否本机器人的
                if(substr($value, 1) !=  $this->tobot){
                    return true;
                }   
                $bot_group = Db::name('bot_group')->where("bot",$this->tobot)->where('groupid', $chatId)->find();
                if(empty($bot_group)){
                    $sql['bot'] = $this->tobot;  
                    $sql['plugin'] = $this->plugin; 
                    $sql['groupid'] = $chatId;
                    $sql['grouptitle'] = $message['chat']['title'];
                    $sql['groupname'] = $message['chat']['username'] ?? "私密"; 
                    $sql['time'] = time();  
                    Db::name('bot_group')->save($sql);    
                } 
                
            }  
        }
         
         
         
        #type指令更替 
        if(is_numeric($type) &&  strlen($type)==4){ 
            $type = "Login";
        } 
        #$value 更替
        if(is_numeric($value) && $value < 0){ 
            $qunid = $value;
            $value = "excel";      
        } 
        
        
        switch ($type) {  
            
            default:   //没有case对应命令时采用模式读数据库模式
                
                //已兼容多条命令 多事件触发 - 更多模块可能考虑前端 特殊处理 比如回复键盘 ，url webapp 内联等等对应模块选择
                $command = Db::name('bot_commands')->where("del",0)->where("bot",$bot)->where("chatType",$chatType)->where("command",$type)->where("type",1)->cache("{$bot}_{$type}_{$chatType}_1")->select();
             
                 
                if($command->isEmpty()){
                    return "{$type}·命令未支持"; 
                } 
                
                foreach ($command as $commands) {    
                    $_text = $commands['text'] ?? "老板·未设定回复内容"; 
                    $so =[];
                    array_push($so,'del');
                    array_push($so,'=');
                    array_push($so,0); 
                    array_push($so,'comId');
                    array_push($so,'=');
                    array_push($so,$commands['id']);   
                    array_push($so,'type');
                    array_push($so,'=');
                    array_push($so,$commands['reply_markup']);  
                    $so = array_chunk($so,3);//拆分   
                    
                    $markup = Db::name('bot_markup')->where([$so])->cache("bot_markup_select_{$commands['id']}")->order('sortId asc')->select(); 
                    $keyboard[$commands['reply_markup']]=[];
                    $d1 = array();
                  
                        foreach ($markup as $value) {   
                            if(empty($value['class']) && $commands['reply_markup']!="keyboard"){ //keyboard 时允许class 空
                                continue;   
                            } 
                            if(!array_key_exists($value['aid'],$d1)){//行
                                $d1[$value['aid']] = [];
                            } 
                            if(!empty($value['class'])){//按钮正文
                                $d2['text'] = $value['text'];
                                
                                if($value['class'] == "web_app" || $value['class'] == "login_url"){
                                    $class['url']=$value[$value['class']]; //构建json
                                    $d2[$value['class']] = $class; //二次json插入
                                }else if($value['class'] == "excel"){
                                    $d2["class"] = "url";
                                    $d2["url"] = "https://t.me/{$this->BOT['API_BOT']}?start={$chatId}"; 
                                }else if($value['class'] == "group"){
                                    $d2["class"] = "url";
                                    $d2["url"] = "https://t.me/{$this->BOT['API_BOT']}?startgroup=true"; 
                                }else if($value['class'] == "lianxiren"){
                                    $d2["class"] = "url";
                                    $d2["url"] = "https://t.me/{$value['url']}"; 
                                }else{
                                    $d2[$value['class']] = $value[$value['class']];//对应字段的值
                                }  
                                array_push($d1[$value['aid']],$d2);
                                
                            }else{
                                array_push($d1[$value['aid']],["text"=>$value['text']]);//这里基本上是回复键盘了
                            } 
                        }
                         
                        $keyboard[$commands['reply_markup']] = array_values($d1); 
                        
                        $reply_markup = json_encode($keyboard); 
                        
                        $_text = preg_replace('/\n[^\S\n]*/i', "\n", $_text);
                        $_text = urlencode($_text);
                        
                   
                        
                        if(empty($commands['photo'])){
                            $this->send("/sendMessage?chat_id={$message['chat']['id']}&text=222{$_text}&reply_markup={$reply_markup}&reply_to_message_id={$message['message_id']}");  
                        }else{
                            $this->send("/sendPhoto?chat_id={$message['chat']['id']}&caption=222{$_text}&photo={$commands['photo']}&reply_markup={$reply_markup}&reply_to_message_id={$message['message_id']}");   
                        }
                        
                         
                        
                         
                     
                } 
                break;
            
            
            
            case 'start':   
                $namea = $message['from']['last_name'] ?? "";
                $nameb = $message['from']['first_name'] ?? ""; 
                
                switch ($value) {//有参数时对号入座
                
                    default://有start参数 但未定义case   
                        #-----------------------------start 无参数私聊 ---------------------------------
                        if($chatType == "private"){   
                            $from = Db::name('account_tg')->where('bot', $this->BOT['API_BOT'])->where('tgid', $message['from']['id'])->find();
                            if(empty($from)){//不存在用户  
                                    $from['bot'] = $this->BOT['API_BOT']; 
                                    $from['tgid'] = $message['from']['id'];  
                                    $from['username'] = $message['from']['username'] ?? "未设置"; 
                                    $from['name'] = $namea.$nameb; 
                                    $from['regtime'] = time();     
                                    
                                    if($value){ //有推广参数
                                        $hashid = new Hashids();
                                        $upid = $hashid->decode($value);
                                        if(!empty($upid[0])){ //效验通过
                                            $upinfo = Db::name('account_tg')->where('bot', $this->BOT['API_BOT'])->where('id', $upid[0])->find(); //推广人数据
                                            if(!empty($upinfo)){ 
                                                $from['up'] = $upinfo['tgid']; 
                                                Db::name('account_tg')->where('id', $upinfo['id'])->inc("tgnum",1)->update();   
                                                $text = "
                                                恭喜您 <b>邀请成功%2B 1</b>
                                                \n用户：<b>{$namea}·{$nameb}</b>  
                                                ";
                                                $reply_markup = json_encode([
                                                    "inline_keyboard"=>[   
                                                        [["text"=>'邀请链接',"callback_data"=>"推广链接"],
                                                         ["text"=>'我的推广',"web_app"=>["url"=>$this->webapp()."/user/tg"]]
                                                        ],  
                                                        ]
                                                ]); 
                                                $this->send("/sendMessage?chat_id={$upinfo['tgid']}&text={$text}&reply_markup={$reply_markup}&reply_to_message_id={$message['message_id']}");
                                                #今日推广数据
                                                $date = date("Ymd"); 
                                                $bot_total_tg = Db::name('bot_total_tg')->where('bot', $this->BOT['API_BOT'])->where('tgid', $upinfo['tgid'])->where('date', $date)->find();  
                                                if(empty($bot_total_tg)){ 
                                                    $bot_total_tg['bot'] = $this->BOT['API_BOT'];
                                                    $bot_total_tg['tgid'] = $upinfo['tgid'];
                                                    $bot_total_tg['date'] = $date;
                                                    $bot_total_tg['tgnum'] = 1;
                                                    $bot_total_tg['time'] = time();
                                                    Db::name('bot_total_tg')->insert($bot_total_tg);  
                                                }else{ 
                                                    Db::name('bot_total_tg')->where('id', $bot_total_tg['id'])->inc("tgnum",1)->update(); 
                                                }
                                                
                                        
                                            }  
                                        }  
                                    }//有推广参数 结束
                                    
                                    $dated = date("Ymd"); 
                                    $bot_total_d = Db::name('bot_total_d')->where('bot', $this->BOT['API_BOT'])->where('dated', $dated)->find(); 
                                    if(empty($bot_total_d)){
                                        $bot_total_d['bot'] = $this->BOT['API_BOT']; 
                                        $bot_total_d['dated'] = $dated;
                                        $bot_total_d['user'] = 1;
                                        $bot_total_d['time'] = time();
                                        Db::name('bot_total_d')->insert($bot_total_d);  
                                    }else{ 
                                        Db::name('bot_total_d')->where('id', $bot_total_d['id'])->inc("user",1)->update(); 
                                    }  
                                    Db::name('account_tg')->insert($from); //插入新用户
                                    
                            }else{//存在的用户数据
                                if($from['del'] == 1){
                                    Db::name('account_tg')->where('id', $from['id'])->update(['del'=>0]);    
                                }
                            } 
                            
                            # 
                            
                            $Temppath = "\plugin\\{$this->plugin}\app\controller\Template";
                            $Template  =  new $Temppath;
                            $Template = $Template->reply_markup("start",$chatType,1); 
                            
                            if(empty($Template['text'])){
                                $Template['text'] = "未定义回复内容,请登录后台》自定义菜单》设定/start 回复内容"; 
                            }
                            
                            #回复键盘
                            $keyboard['resize_keyboard']=true;
                            $keyboard['keyboard'] = []; 
                            $d1 = array();
                            array_push($d1,["text"=>'💹兑换汇率']);
                            array_push($d1,["text"=>'🔰兑换地址']); 
                            array_push($keyboard['keyboard'],$d1);
                            
                            $d2 = array();
                            array_push($d2,["text"=>'🌐绑定地址',"web_app"=>["url"=> $this->webapp()."/user/addr"]]); 
                            
                            array_push($d2,["text"=>'🆘预支TRX']); 
                            array_push($keyboard['keyboard'],$d2);
                            
                            $keyboard = json_encode($keyboard);
                            
                             
                            $this->send("/sendMessage?chat_id={$message['chat']['id']}&text=你好：<b>{$namea} {$nameb}</b>\n你的电报ID：<code>{$message['from']['id']}</code>\n{$Template['text']}&reply_markup={$keyboard}");   
                            //回复键盘 end 
                            
                            
                            $price = Redis::GET("TRXprice"); 
                            $dec =  round($price * $this->setup['Rate'] / 100,2);
                            $price = $price -$dec;
                            $text ="
                            <b>当前兑换汇率：</b>
                            \n<code>1   USDT = ".round($price,2)." TRX</code>
                            \n<code>10  USDT = ".round($price*10,2)." TRX</code>
                            \n<code>100 USDT = ".round($price*100,2)." TRX</code>
                            \n\n钱包地址(trc20)：\n<code>{$this->addr}</code>\n点击上面地址自动复制
                            ";
                            
                            var_dump($Template);
                            
                            if(empty($Template['photo'])){
                                $this->send("/sendMessage?chat_id={$message['chat']['id']}&text={$Template['text']}&reply_markup={$Template['reply_markup']}"); 
                            }else{ 
                                $this->send("/sendPhoto?chat_id={$message['chat']['id']}&photo={$Template['photo']}&caption={$text}&reply_markup={$Template['reply_markup']}","url",null,2); 
                            }
                             
                             
                            break;//无start参数 私聊
                    }else{
                        #-----------------------------start 无参数群聊 ---------------------------------
                        $Temppath = "\plugin\\{$this->plugin}\app\controller\Template";
                        $Template  =  new $Temppath;
                        $Template = $Template->reply_markup("start",$chatType,1,$chatId);  
                        if($Template['text']){ 
                            if(empty($Template['photo'])){
                                $this->send("/sendMessage?chat_id={$message['chat']['id']}&text=你好：<b>{$namea}·{$nameb}</b>\n{$Template['text']}&reply_markup={$Template['reply_markup']}&reply_to_message_id={$message['message_id']}  ");
                                
                            }else{
                                $this->send("/sendPhoto?chat_id={$message['chat']['id']}&caption=你好：<b>{$namea}·{$nameb}</b>\n{$Template['text']}&photo={$Template['photo']}&reply_markup={$Template['reply_markup']}&reply_to_message_id={$message['message_id']}  ");
                            }
                             
                        }  
                        break;
                    } 
                    break;
                
                
                #----------------------//有start参数 且定义了case  ----------------------------------------- 
                
                case 'help'://start=help 
                    $Temppath = "\plugin\\{$this->plugin}\app\controller\Template";
                    $Template  =  new $Temppath; 
                    $Template = $Template->reply_markup("help",$chatType,1,$chatId); 
                    $this->send("/sendMessage?chat_id={$message['chat']['id']}&text={$Template['text']}&reply_markup={$Template['reply_markup']}");  //&reply_to_message_id={$message['message_id']}   
                    break; 
                
                
                case 'excel':    
                    // $keep_setup = Db::name('keep_setup')->where("bot",$this->BOT['API_BOT'])->cache("{$this->BOT['API_BOT']}{$qunid}setup")->where("qunid",$qunid)->find();
                    // if(empty($keep_setup)){
                    //     $this->send("/sendMessage?chat_id={$message['chat']['id']}&text=Hi 你好：<b>{$namea}·{$nameb}</b>\n\n<b>该群数据为空</b>\n<b>请把机器人踢出重新拉入群</b>");
                    //     break;
                        
                    // }else if(!stripos($keep_setup['admin'], "@{$message['from']['username']} ")){
                    //     $this->send("/sendMessage?chat_id={$message['chat']['id']}&text=Hi 你好：<b>{$namea}·{$nameb}</b>\n\n很抱歉<b>你没有权限查看账单</b>");
                    //     break;
                        
                    // }
                    // $reply_markup = json_encode([
                    //                             "inline_keyboard"=>[   
                    //                                 [["text"=>'🌐点击查看网页账单',"url"=>"{$this->BOT['WEB_URL']}/app/user/%23/demo/down?qunid={$qunid}"],
                    //                                 //  ["text"=>'我的推广',"callback_data"=>"我的推广"]
                    //                                 ],  
                    //                                 ]
                    //                         ]);
                    $this->send("/sendMessage?chat_id={$message['chat']['id']}&text=Hi 你好：<b>{$namea}·{$nameb}</b>\n该机器人暂不支持网页账单<b>excel导出</b>&reply_markup=");
                    break;
                    
                    
                } 
            break; //start end       
                
 
                
                 
                
                
                
                
                
                
                 
                
                
                
                
                
                
                
            case 'Login':
                if($chatType == "private"){
                    #$autoId = Db::name("account")->getAutoInc();
                    if($tgid != $by){
                        $this->send("/sendMessage?chat_id={$tgid}&text=您无权登录(非管理员)&reply_to_message_id={$message['message_id']}");
                        return true; 
                        break;
                    } 
                    $user = Db::name('account')->where('roleId', 6)->where('tenantId', 2)->where('tgid', $tgid)->where('plugin', $this->BOT['plugin'])->where('remark', $this->BOT['API_BOT'])->find();  
                     if(empty($user)){
                         $count_num = Db::name("account")->order('id', 'desc')->find(); 
                         
                         
                        $key = strtoupper(md5($tgid.rand(1,999)));
                        $ga = new GoogleAuthenticator();
                        $secret = $ga->createSecret();#生成谷歌密匙
                        $user['regtime'] = time();
                        $user['upid'] = 0;
                        $user['rate'] = 0; 
                        $user['google'] = 0;
                        $user['key'] = $key; 
                        $user['SecretKey'] = $secret;
                        $user['roleId'] = 6;
                        $user['tenantId'] = 2; 
                        $user['username'] = $count_num['id']+rand(1,9) . (string)rand(10,99);  
                        $user['password'] = md5(123456);   
                        $user['tgid'] = $tgid;  
                        $user['remark'] = $this->BOT['API_BOT'];  
                        $user['plugin'] = $this->BOT['plugin'];  
                        $user['id'] = Db::name('account')->insertGetId($user);
                        $this->send("/sendMessage?chat_id={$tgid}&text=<b>首次登录自动创建账号密码</b>\n<b>账号：</b>{$nna}\n<b>密码：</b>123456&reply_to_message_id={$message['message_id']}"); 
                     }
                     
                    $user['plugin'] = $this->plugin; //自定义附加内容 
                    $tokenObject = Auth::login($user); 
                    $JWTuid = $user['id'];  
                    $JWT_MD5 = $tokenObject->token_md5;
                    Redis::HSET("HJWTMD5_{$JWTuid}",$JWT_MD5,time());
                    redis::EXPIRE("HJWTMD5_{$JWTuid}",config('plugin.TNTma.tntjwt.app.exp'));//设置过期时间 
                    Redis::HSET("QRcode",$com[1],serialize($tokenObject));
                    redis::EXPIRE("QRcode",10); 
                    $this->send("/sendMessage?chat_id={$tgid}&text=快捷登录成功&reply_to_message_id={$message['message_id']}"); 
                    return true;  
                    break;
                    
                    
                }   
                
                
                
                
        }
    }
    
}