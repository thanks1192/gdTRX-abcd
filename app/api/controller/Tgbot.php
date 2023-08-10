<?php

namespace app\api\controller;

use support\Request;

use Shopwwi\WebmanAuth\Facade\Auth;#jwt https://www.workerman.net/plugin/24
use think\facade\Db;#mysql https://www.kancloud.cn/manual/think-orm/1258003
use think\facade\Cache;#Cache https://www.kancloud.cn/manual/thinkphp6_0/1037634
use Respect\Validation\Exceptions\ValidationException;#字符验证器捕获错误

use Webman\Push\Api; //push推送
use support\Redis;//redis缓存
use Gregwar\Captcha\CaptchaBuilder;#Captcha 验证码
use Webman\RedisQueue\Client; #redis queue 队列

use Casbin\WebmanPermission\Permission;#casbin权限
use Vectorface\GoogleAuthenticator;#谷歌验证

use TNTma\TronWeb\Address;
use TNTma\TronWeb\Account;
use TNTma\TronWeb\Tron; 

#不确定数量的请求
use GuzzleHttp\Pool;
use GuzzleHttp\Client as Guzz_Client;
use GuzzleHttp\Psr7\Request as Guzz_Request; 
use GuzzleHttp\Promise as Guzz_Promise;

use app\model;

class tgbot{
    
    public function usdtlog_list(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->get();
      $page = ($data['page']-1)*$data['limit']; 
      $jsonVal = array();
      $so =[]; 
      
    //   array_push($so,"del");
    //   array_push($so,'=');
    //   array_push($so,0); 
      
      array_push($so,"bot");
      array_push($so,'=');
      array_push($so,$bot); 
      
      //参数不等于空进行匹配搜索    
      if(!empty($data['state'])){
          if($data['state'] == 1){
              array_push($so,"del");
              array_push($so,'=');
              array_push($so,1);   
          } 
 
      } 
      if(!empty($data['keyword'])){
          array_push($so,$data['t']?$data['t']:'tgid');
          array_push($so,'=');
          array_push($so,$data['keyword']);
      }
      
      if(!empty($data['timea'])){
          array_push($so,"time");
          array_push($so,'>');
          array_push($so,substr($data['timea'],0,10));
          array_push($so,"time");
          array_push($so,'<');
          array_push($so,substr($data['timeb'],0,10));
      }
      
     $so = array_chunk($so,3);//拆分 
     $date = date("Ymd"); 
     $bot_total_d = Db::name('bot_total_d')->where('bot', $bot)->where('dated', $date)->find();
 
     $count = Db::name('bot_usdt_list')->where([$so])->count(); 
     $list = Db::name('bot_usdt_list')->where([$so])->limit($page,$data['limit'])->order('id desc')->select();  
 
     $jsonVal['count'] = $count;
     $jsonVal['list'] = $list;  
     $jsonVal['total'] = $bot_total_d;  
      return json(['code' => 0,'msg'=>"获取成功",'num'=>count($list),'data' => $jsonVal ]);  
    }
    
    
    
    public function bot_user_list(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->get();
      $page = ($data['page']-1)*$data['limit']; 
      $jsonVal = array();
      $so =[]; 
      
    //   array_push($so,"del");
    //   array_push($so,'=');
    //   array_push($so,0); 
      
      array_push($so,"bot");
      array_push($so,'=');
      array_push($so,$bot); 
      
      //参数不等于空进行匹配搜索    
      if(!empty($data['state'])){
          if($data['state'] == 1){
              array_push($so,"del");
              array_push($so,'=');
              array_push($so,1);   
          } 
 
      } 
      if(!empty($data['keyword'])){
          array_push($so,$data['t']?$data['t']:'tgid');
          array_push($so,'=');
          array_push($so,$data['keyword']);
      }
      
      if(!empty($data['timea'])){
          array_push($so,"regtime");
          array_push($so,'>');
          array_push($so,substr($data['timea'],0,10));
          array_push($so,"regtime");
          array_push($so,'<');
          array_push($so,substr($data['timeb'],0,10));
      }
      
     $so = array_chunk($so,3);//拆分 
     
     $date = date("Ymd"); 
     $total_tg_d = Db::name('bot_total_d')->where('bot', $bot)->where('dated', $date)->find();
      
     $count = Db::name('account_tg')->where([$so])->count(); 
     $list = Db::name('account_tg')->where([$so])->limit($page,$data['limit'])->order('id desc')->select();  
 
     $jsonVal['count'] = $count;
     $jsonVal['list'] = $list; 
     $jsonVal['total'] = $total_tg_d; 
      return json(['code' => 0,'msg'=>"获取成功",'num'=>count($list),'data' => $jsonVal ]);  
    }
    
    
    
    
    
    
    
    
    
    
    
    public function trc20_list(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->get();
      $page = ($data['page']-1)*$data['limit']; 
      $jsonVal = array();
      $so =[]; 
      
      array_push($so,"del");
      array_push($so,'=');
      array_push($so,0); 
      
      array_push($so,"bot");
      array_push($so,'=');
      array_push($so,$bot); 
      
      //参数不等于空进行匹配搜索    
      if(!empty($data['state'])){
          if($data['state'] == 1){
              array_push($so,"tgid");
              array_push($so,'=');
              array_push($so,0);   
          }else if($data['state'] == 2){
              array_push($so,"disable");
              array_push($so,'=');
              array_push($so,1);   
          }  
 
      } 
      if(!empty($data['keyword'])){
          array_push($so,$data['t']?$data['t']:'trc20');
          array_push($so,'=');
          array_push($so,$data['keyword']);
      }
      
      if(!empty($data['timea'])){
          array_push($so,"regtime");
          array_push($so,'>');
          array_push($so,substr($data['timea'],0,10));
          array_push($so,"regtime");
          array_push($so,'<');
          array_push($so,substr($data['timeb'],0,10));
      }
      
     $so = array_chunk($so,3);//拆分 
     
 
     $count = Db::name('bot_total_trc20')->where([$so])->count(); 
     $list = Db::name('bot_total_trc20')->where([$so])->limit($page,$data['limit'])->order('id desc')->select();  
 
     $jsonVal['count'] = $count;
     $jsonVal['list'] = $list;  
      return json(['code' => 0,'msg'=>"获取成功",'num'=>count($list),'data' => $jsonVal ]);  
    }
    
    
    
    
    
    
    
    
    public function group_list(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->get();
      $page = ($data['page']-1)*$data['limit']; 
      $jsonVal = array();
      $so =[]; 
      
      array_push($so,"del");
      array_push($so,'=');
      array_push($so,0); 
      
      array_push($so,"bot");
      array_push($so,'=');
      array_push($so,$bot); 
      
      //参数不等于空进行匹配搜索    
      if(!empty($data['state'])){
          if($data['state'] == 1){
              array_push($so,"vip");
              array_push($so,'=');
              array_push($so,1);   
          }else if($data['state'] == 2){
              array_push($so,"vip");
              array_push($so,'=');
              array_push($so,0);   
          }  
 
      } 
      if(!empty($data['keyword'])){
          array_push($so,$data['t']?$data['t']:'groupid');
          array_push($so,'=');
          array_push($so,$data['keyword']);
      }
      
      if(!empty($data['timea'])){
          array_push($so,"time");
          array_push($so,'>');
          array_push($so,substr($data['timea'],0,10));
          array_push($so,"time");
          array_push($so,'<');
          array_push($so,substr($data['timeb'],0,10));
      }
      
     $so = array_chunk($so,3);//拆分 
     
 
     $count = Db::name('bot_group')->where([$so])->count(); 
     $list = Db::name('bot_group')->where([$so])->limit($page,$data['limit'])->order('id desc')->select();  
 
     $jsonVal['count'] = $count;
     $jsonVal['list'] = $list;  
      return json(['code' => 0,'msg'=>"获取成功",'num'=>count($list),'data' => $jsonVal ]);  
    }
    
    
    
    
    
    
    
    
    
    
    
    

    public function command_list(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->get();
      $data['page'] = 1;
      $data['limit'] = 50;
      $page = ($data['page']-1)*$data['limit']; 
      $jsonVal = array();
      $so =[]; 
      
      array_push($so,"del");
      array_push($so,'=');
      array_push($so,0); 
      
      array_push($so,"bot");
      array_push($so,'=');
      array_push($so,$bot); 
      
      if(empty($data['reply_markup'])){
          array_push($so,"reply_markup");
          array_push($so,'=');
          array_push($so,"inline_keyboard");    
      }else{
          array_push($so,"reply_markup");
          array_push($so,'=');
          array_push($so,$data['reply_markup']);    
      } 
       
      
      //参数不等于空进行匹配搜索    
    //   if(!empty($data['state'])){
    //       if($data['state'] == 1){
    //           array_push($so,"tgid");
    //           array_push($so,'=');
    //           array_push($so,0);   
    //       }else if($data['state'] == 2){
    //           array_push($so,"disable");
    //           array_push($so,'=');
    //           array_push($so,1);   
    //       }  
 
    //   } 
    //   if(!empty($data['keyword'])){
    //       array_push($so,$data['t']?$data['t']:'trc20');
    //       array_push($so,'=');
    //       array_push($so,$data['keyword']);
    //   }
      
    //   if(!empty($data['timea'])){
    //       array_push($so,"regtime");
    //       array_push($so,'>');
    //       array_push($so,substr($data['timea'],0,10));
    //       array_push($so,"regtime");
    //       array_push($so,'<');
    //       array_push($so,substr($data['timeb'],0,10));
    //   }
      
     $so = array_chunk($so,3);//拆分 
     
 
     $count = Db::name('bot_commands')->where([$so])->count(); 
     $list = Db::name('bot_commands')->where([$so])->limit($page,$data['limit'])->order('id asc')->select();  
 
     $jsonVal['count'] = $count;
     $jsonVal['list'] = $list;  
      return json(['code' => 0,'msg'=>"获取成功",'num'=>count($list),'data' => $jsonVal ]);  
    }  
    
    
    
    public function commands_list(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->get();
      $data['page'] = 1;
      $data['limit'] = 50;
      $page = ($data['page']-1)*$data['limit']; 
      $jsonVal = array();
      $so =[]; 
      
      array_push($so,"del");
      array_push($so,'=');
      array_push($so,0); 
      
      array_push($so,"bot");
      array_push($so,'=');
      array_push($so,$bot);  
      
      array_push($so,"chatType");
      array_push($so,'=');
      array_push($so,$data['chatType']);
      
      
      if(empty($data['type'])){
          array_push($so,"type");
          array_push($so,'=');
          array_push($so,1); 
      }else{
          array_push($so,"type");
          array_push($so,'=');
          array_push($so,$data['type']); 
      } 
  
 
      
     $so = array_chunk($so,3);//拆分 
     
 
     $count = Db::name('bot_commands')->where([$so])->count(); 
     $list = Db::name('bot_commands')->where([$so])->limit($page,$data['limit'])->order('id desc')->select();  
 
     $jsonVal['count'] = $count;
     $jsonVal['list'] = $list;  
      return json(['code' => 0,'msg'=>"获取成功",'num'=>count($list),'data' => $jsonVal ]);  
    } 
    
    
    public function comclass_list(Request $request){
        $data = $request->get();
        $bot = $request->user->remark;
        $so =[]; 
        array_push($so,"del");
        array_push($so,'=');
        array_push($so,0); 
        
        array_push($so,"plugin");
        array_push($so,'=');
        array_push($so,$request->user->plugin); 
        $so = array_chunk($so,3);//拆分 
      
        $list = Db::name('bot_comclass')->where([$so])->whereIn("chatType","all,{$data['chatType']}")->select();  
        $jsonVal['list'] = $list;  
        return json(['code' => 0,'msg'=>"获取成功",'num'=>count($list),'data' => $jsonVal ]); 
        
    }
    
    public function comtype_list(Request $request){
        $data = $request->get();
        $bot = $request->user->remark;
        $so =[]; 
        array_push($so,"plugin");
        array_push($so,'=');
        array_push($so,$request->user->plugin);  
        
        $so = array_chunk($so,3);//拆分  
        $list = Db::name('bot_comtype')->where([$so])->select();  
        $jsonVal['list'] = $list;  
        return json(['code' => 0,'msg'=>"获取成功",'num'=>count($list),'data' => $jsonVal ]); 
        
    }
    
    
    public function command_detail(Request $request){ //这个地方可能存在BUG 缺少bot 
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->get();
      $so =[]; 
       
      array_push($so,"del");
      array_push($so,'=');
      array_push($so,0); 
      
      array_push($so,"bot");
      array_push($so,'=');
      array_push($so,$bot); 
      
      array_push($so,"comId");
      array_push($so,'=');
      array_push($so,$data['comId']); 
      
      array_push($so,"type");
      array_push($so,'=');
      array_push($so,$data['type']); 
      
      $so = array_chunk($so,3);//拆分 
      $list = Db::name('bot_markup')->where([$so])->order('sortId asc')->select();   
 
      
    $keyboard=[];
    $d1 = array();
 
    foreach ($list as $value) {   
        if(empty($value['class']) && $data['type']!="keyboard"){ 
            continue; 
            
        } 
        if(!array_key_exists($value['aid'],$d1)){
            $d1[$value['aid']] = [];
        } 
        array_push($d1[$value['aid']],$value);
        // if(!empty($value['class'])){
        //     $d2['text'] = $value['text'];
        //     if($value['class'] == "web_app" || $value['class'] == "login_url"){
        //         $class['url']=$value[$value['class']]; //json
        //         $d2[$value['class']] = $class; 
        //     }else{
        //         $d2[$value['class']] = $value[$value['class']];//对应字段的值
        //     }  
        //     array_push($d1[$value['aid']],$d2);
            
        // }else{
        //     array_push($d1[$value['aid']],["text"=>$value['text']]);
        // }
      
    } 
 
    $keyboard = array_values($d1); 
    
  
      
      $jsonVal['list'] = $list;  
      return json(['code' => 0,'msg'=>"获取成功",'num'=>count($list),'data' => $keyboard ]);  
    }
    
    
    
    
    
    
    
    public function command_markup(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->post();
      $so =[];  
    
 
      
      array_push($so,"del");
      array_push($so,'=');
      array_push($so,0);  
      $so = array_chunk($so,3);//拆分 
 
      
      $add = [];
      $update = [];
      
      //$bot_commands = model\bot_commands::find($data['id']);
      $bot_commands = model\bot_commands::where('bot', $bot)->where('id', $data['id'])->find();
      
      if(empty($bot_commands)){
          return json(['code' => 1,'msg'=>"对应数据不存在" ]); 
      }
      
      
      foreach ($data['list'] as $index => $val){  
          
          foreach ($val as $index2 => $val2 ){ 
              if(empty($val2['class'])){
                  return json(['code' => 1,'msg'=>"未选择按钮事件类型" ]);   
              } 
              if(empty($val2['id'])){//新加入
                $sql['bot'] = $bot;
                $sql['comId'] = $bot_commands['id'];
                $sql['chatType'] = $bot_commands['chatType'];
                $sql['type'] = $bot_commands['reply_markup'];
                $sql['aid'] = $index + 1 ;
                $sql['sortId'] = $sql['aid']  * 10 + $index2;
                $sql['text'] = $val2['text'];
                $sql['class'] = $val2['class'];
                $sql[$val2['class']] = $val2['url']??"";
                array_push($add,$sql); 
                
              }else{//update   
                if($val2['bot'] != $bot){
                    continue;   
                }
              
                $val2['class'] = $val2['class'];
                $val2[$val2['class']] = $val2['url']??"";
                $val2['aid'] = $index + 1 ;
                $val2['sortId'] = $val2['aid']  * 10 + $index2;
                array_push($update,$val2);  
              } 
          }
          
           
          
      }
      
        $bot_markup = new model\bot_markup; 
        if(count($update) > 0){
            $bot_markup->saveAll($update);  
        }
        if(count($add) > 0){
           $bot_markup->saveAll($add);  
        } 
       
       Cache::delete("bot_markup_select_{$bot_commands['id']}"); //删除缓存
        
       return json(['code' => 0,'msg'=>"按钮同步更新成功"   ]);  
    }
    
    
    
    public function markup_del(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->post(); 
      
    //   model\bot_markup::where('id',$data['id'])->update(['del'=>1]);
      //model\bot_markup::update(['del' => 1],['id' => $data['id']])->cache("bot_markup_select_{$data['comId']}");
      Cache::delete("bot_markup_select_{$data['comId']}");
      Db::name('bot_markup')->where('id',$data['id'])->where('bot',$bot)->update(['del' => 1]);  #更新

      
      return json(['code' => 0,'msg'=>"按钮删除成功" ]);  
    }
    
    
    public function command_add(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->post();
      
      
      $bot_comtype = model\bot_comtype::where('plugin', $request->user->plugin)->where('command', $data['command'])->find();
      
      $bot_commands = model\bot_commands::where('bot', $bot)->where('command', '设置其它消息按钮')->where('type', 0)->find();
      if(empty($bot_commands)){
          return json(['code' => 1,'msg'=>"该机器人没有消息事件主体- 请重新初始化机器人"   ]);      
      }
      
      Cache::delete("{$bot}_{$data['command']}_{$data['chatType']}_2");
      
       
      
      if(empty($data['id'])){
          $commands = model\bot_commands::where('bot', $bot)->where('command', $data['command'])->where('chatType', $data['chatType'])->find();
          $data['bot'] = $bot;
          $data['parentId'] = $bot_commands['id'];
          $data['istext'] = $bot_comtype['ismsg'];
          $data['type'] = 2;
          $data['reply_markup'] = 'inline_keyboard';
          model\bot_commands::create($data);
          return json(['code' => 0,'msg'=>"添加成功" ]); 
          
      }else{
          $commands = model\bot_commands::where('id', $data['id'])->find();
          unset($data['id']); 
          //model\bot_commands::update($data,['id' => $commands['id']]);
          Db::name('bot_commands')->where('id',$commands['id'])->where('bot',$bot)->update($data);  #更新
          
          if($data['type'] == 1){//菜单命令
              $queueData['plugin'] = $request->user->plugin; 
              $queueData['API_BOT'] = $bot;
              $queueData['type'] = "commands";
              $queueData['data'] = $data['chatType'];
              Client::send('TG_queue',$queueData);     
          }
          
          
          return json(['code' => 0,'msg'=>"修改成功" ]); 
      }
        
       
      
        
    }
    
    
    public function commands_add(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->post();
      
      $botlist = Db::name('bot_list')->where("plugin",$request->user->plugin)->where('bot',$bot)->cache("{$request->user->plugin}_{$bot}")->find();
      
      $bot_commands = model\bot_commands::where('bot', $bot)->where('command', "菜单指令消息按钮")->where('type', 0)->find();
      if(empty($bot_commands)){
          return json(['code' => 1,'msg'=>"该机器人没有菜单命令主体- 请重新初始化机器人"   ]);      
      }
      
      
      Cache::delete("{$bot}_{$data['command']}_{$data['chatType']}_1");  
      
      if(!empty($data['photo'])){
          if(substr($data['photo'], 0, 4) != "http"){
              $data['photo'] = $botlist['WEB_URL'].$data['photo']; 
            }   
      }
       
 
      
      if(empty($data['id'])){
          $commands = model\bot_commands::where('bot', $bot)->where('command', $data['command'])->where('type',1)->find();
          $data['bot'] = $bot;
          $data['parentId'] = $bot_commands['id']; 
          $data['type'] = 1;
          $data['reply_markup'] = 'inline_keyboard';
          model\bot_commands::create($data);
          
          $queueData['plugin'] = $request->user->plugin; 
          $queueData['API_BOT'] = $bot;
          $queueData['type'] = "commands";
          $queueData['data'] = $data['chatType'];
          Client::send('TG_queue',$queueData); 
          
          return json(['code' => 0,'msg'=>"添加成功" ]); 
          
      }else{
          $commands = model\bot_commands::where('id', $data['id'])->find();
          unset($data['id']); 
          
          Db::name('bot_commands')->where('id',$commands['id'])->where('bot',$bot)->update($data);  #更新
          
          //model\bot_commands::update($data,['id' => $commands['id']]);
          
          $queueData['plugin'] = $request->user->plugin; 
          $queueData['API_BOT'] = $bot;
          $queueData['type'] = "commands";
          $queueData['data'] = $commands['chatType'];
          Client::send('TG_queue',$queueData); 
          
          return json(['code' => 0,'msg'=>"修改成功" ]); 
      }  
    }
    
    
    
    public function command_del(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->post();
      
      cache::delete("{$bot}_{$data['command']}_{$data['chatType']}");
      model\bot_commands::update(["del"=>1],['id' => $data['id']]);
      
      if($data['type'] == 1){//菜单命令
          $queueData['plugin'] = $request->user->plugin; 
          $queueData['API_BOT'] = $bot;
          $queueData['type'] = "commands";
          $queueData['data'] = $data['chatType'];
          Client::send('TG_queue',$queueData);    
      }
           
       return json(['code' => 0,'msg'=>"删除成功" ]); 
      } 
      
      
      
      
      
      
      
      
      
      
    public function send_Msg(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->post();
      $botlist = Db::name('bot_list')->where("plugin",$request->user->plugin)->where('bot',$bot)->cache("{$request->user->plugin}_{$bot}")->find();  
      if(empty($botlist)){
          return json(['code' => 1,'msg'=>"机器人数据获取失败" ]);  
      }
      
      if(empty($data['text']) || empty($data['tgid'])){
          return json(['code' => 1,'msg'=>"获取用户ID失败或消息内容为空" ]);  
      } 
      
      $client = new Guzz_Client(['timeout' => 8,'http_errors' => false]); 
      $res = json_decode($client->request('GET', "{$botlist['API_URL']}{$botlist['API_TOKEN']}/sendMessage?chat_id={$data['tgid']}&text={$data['text']}&parse_mode=HTML&allow_sending_without_reply=true&disable_web_page_preview=true")->getBody(),true); 
        if(empty($res['ok'])){
            return json(['code' => 1,'msg'=>"消息发送失败,{$res['description']}" ]);   
        }else{
            return json(['code' => 0,'msg'=>"消息发送成功" ]);
        } 
    }  
    
    
    
    public function bot_tuiqun(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->post(); 
      
      if(empty($data['qunid'])){
          return json(['code' => 1,'msg'=>"缺少群ID参数" ]);  
      } 
      
      $botlist = Db::name('bot_list')->where("plugin",$request->user->plugin)->where('bot',$bot)->cache("{$request->user->plugin}_{$bot}")->find();  
      if(empty($botlist)){
          return json(['code' => 1,'msg'=>"机器人数据获取失败" ]);  
      }
      
      $client = new Guzz_Client(['timeout' => 8,'http_errors' => false]); 
      $res = json_decode($client->request('GET', "{$botlist['API_URL']}{$botlist['API_TOKEN']}/leaveChat?chat_id={$data['qunid']}")->getBody(),true); 
        if(empty($res['ok'])){
            return json(['code' => 1,'msg'=>"退群失败,{$res['description']}" ]);   
        }else{
            return json(['code' => 0,'msg'=>"机器人退群成功" ]);
        } 
    } 
    
    
    
    public function group_update_zt(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->post(); 
      if(empty($data['id']) || empty($data['val']) ){
          return json(['code' => 1,'msg'=>"参数异常" ]);  
      }
      
      Db::name('bot_group')->where('plugin',$request->user->plugin)->where('bot',$bot)->where('id',$data['id'])->update([$data['val']=>(int)$data['zt'] ]);
      return json(['code' => 0,'msg'=>"操作成功" ]);
      
    }
    
    //地址管理 接收消息 开关
    public function trc20_update_zt(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->post(); 
      if(empty($data['id']) || !isset($data['send'])  ){
          return json(['code' => 1,'msg'=>"参数异常" ]);  
      }
      
      $total_trc20 = Db::name('bot_total_trc20')->where('bot',$bot)->where('id',$data['id'])->find();  
      if(empty($total_trc20['tgid'])){
          return json(['code' => 1,'msg'=>"开启失败,该地址未绑定TGID无法开启通知" ]);
      }
      
      Db::name('bot_total_trc20')->where('bot',$bot)->where('id',$data['id'])->update(["send"=>(int)$data['send'] ]);
      return json(['code' => 0,'msg'=>"操作成功" ]);
      
    }
    
    //地址管理 拉黑地址
    public function trc20_lahei(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->post(); 
      if(empty($data['id']) || !isset($data['disable']) ){
          return json(['code' => 1,'msg'=>"参数异常" ]);  
      }
      
      $total_trc20 = Db::name('bot_total_trc20')->where('bot',$bot)->where('id',$data['id'])->find();  
      if(empty($total_trc20)){
          return json(['code' => 1,'msg'=>"数据不存在" ]);
      }
      
      Db::name('bot_total_trc20')->where('bot',$bot)->where('id',$data['id'])->update(["disable"=>$data['disable'] ]);
      return json(['code' => 0,'msg'=>"操作成功" ]);
      
    }
    
    
    //地址管理 绑定tgid
    public function trc20_bangding(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->post(); 
      if(empty($data['id']) || !isset($data['tgid']) ){
          return json(['code' => 1,'msg'=>"参数异常" ]);  
      }
      
      $total_trc20 = Db::name('bot_total_trc20')->where('bot',$bot)->where('id',$data['id'])->find();  
      if(empty($total_trc20) || $total_trc20['tgid'] == $data['tgid']){
          return json(['code' => 1,'msg'=>"操作失败,绑定ID和当前已绑定ID相同" ]);
      }
       
      
      Db::name('bot_total_trc20')->where('bot',$bot)->where('id',$data['id'])->update(["tgid"=>$data['tgid'] ]);
      return json(['code' => 0,'msg'=>"操作成功" ]);
      
    }
    

    #TRX兑换配置信息获取
    public function bot_get_trxsetup(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $Coulumn = $request->user->roleId==3?"upid":"myid"; 
      
      $botlist = Db::name('trx_setup')->where("plugin",$request->user->plugin)->where('bot',$bot)->cache("trx_{$bot}_setup")->find();  
      
      return json(['code' => 0,'msg'=>"操作成功",'data'=>$botlist ]);  
    } 
    
    
    #TRX兑换配置信息修改
    public function bot_trx_setup(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $Coulumn = $request->user->roleId==3?"upid":"myid"; 
      $data = $request->post();  
      $data['addr']="";
      
    if(strlen($data['PrivateKey']) != 64){
        return json(['code' => 1,  'msg' => "钱包私钥错误,请填写TRX钱包私钥key 长度64位","find"=>"TRON_API_KEY"]);  
    }
      
    if(strlen($data['TRON_API_KEY']) != 36){
        return json(['code' => 1,  'msg' => "波场API Key错误,点击后面感叹号查看注册流程","find"=>"TRON_API_KEY"]);  
    }
    
    if($data['TRON_API_KEY'] == getenv('TRONSCAN_APIKEY') ){
        return json(['code' => 1,  'msg' => "波场API Key错误：你填写了TRONSCAN_APIKEY的APIkey 注：这是2个不同的API哦","find"=>"TRON_API_KEY"]);  
    }
    
    try {
            $PrivateKey = Account::SetPrivateKey($data['PrivateKey']);
            $address = $PrivateKey->address()->__toString();
            $tron = new Tron(1,$PrivateKey,$data['TRON_API_KEY']); 
            $TRXbalance = $tron->getTrxBalance($address) / 1000000; 
            $TRC20 = $tron->Trc20('TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t');//合约地址 - USDT合约
            $USDTbalance = $TRC20->balanceOf($address)->__toString() / 1000000;  
        
    } catch (\Exception $e) {
        if($e->getMessage() == "该地址未激活"){
            return json(['code' => 1,'msg'=>"修改失败,请填写已激活的钱包地址" ]);    
        } 
        return json(['code' => 1,'msg'=>"修改失败,".$e->getMessage() ]);   
    }
    
 
    
    
     if(empty($data['id'])){
         $data['plugin'] = $request->user->plugin;
         $data['bot'] = $bot;
         $data['yuzhi'] = '{
                            "tgvip": 0,
                            "usdtyue": 10,
                            "yuzhitrx": 15,
                            "duihuanlog": 10,
                            "xianzhitrx": 100
                        }';
         Db::name('trx_setup')->insert($data);   
     } else{
         Db::name('trx_setup')->where('plugin',$request->user->plugin)->where('bot',$bot)->update($data);  
     }
      
      
       
      Cache::delete("trx_{$bot}_setup");
      
      return json(['code' => 0,'msg'=>"修改成功",'data'=>0 ]);  
      
    } 
    
    
    #机器人获取信息
    public function bot_getmy(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $Coulumn = $request->user->roleId==3?"upid":"myid";
/*      $data = $request->get(); 
      if(empty($data['id']) || empty($data['val']) ){
          return json(['code' => 1,'msg'=>"参数异常" ]);  
      }*/
      $botlist = Db::name('bot_list')->where("plugin",$request->user->plugin)->where('API_BOT',$bot)->cache("{$request->user->plugin}_{$bot}")->find();  
      if(empty($botlist)){
          return json(['code' => 1,'msg'=>"机器人数据获取失败" ]);  
      }
      $ret['API_BOT'] = $botlist['API_BOT'];
      $ret['API_TOKEN'] = $botlist['API_TOKEN'];
      $ret['Admin'] = $botlist['Admin'];
      
      $client = new Guzz_Client(['timeout' => 8,'http_errors' => false]);   
      $promises = [
          'getMe' => $client->getAsync("{$botlist['API_URL']}{$botlist['API_TOKEN']}/getMe"), 
          'description' => $client->getAsync("{$botlist['API_URL']}{$botlist['API_TOKEN']}/getMyDescription"),
          'getAdmin' => $client->getAsync("{$botlist['API_URL']}{$botlist['API_TOKEN']}/getChat?chat_id=".$botlist['Admin'])
       ]; 
       $results = Guzz_Promise\unwrap($promises);//并发异步请求
       if($results['getMe']){
           $res = json_decode($results['getMe']->getBody()->getContents(),true);  
           if(empty($res['ok'])){
               return json(['code' => 1,'msg'=>"获取机器人信息失败"  ]); 
           }
           $ret['NAME'] =  $res['result']['first_name'];
           $ret['neilian']  =$res['result']['supports_inline_queries'];   
       }
       
       if($results['getAdmin']){
           $res = json_decode($results['getAdmin']->getBody()->getContents(),true);  
           if(empty($res['ok'])){
               return json(['code' => 1,'msg'=>"获取管理员信息失败"  ]); 
           }
            
         $ret['AdminUser'] = $res['result']['username']??"未设置";
         $ret['AdminName']  =$res['result']['first_name']??""; 
         $ret['AdminName']  .=$res['result']['last_name']??""; 
       }
       
       if($results['description']){
           $res = json_decode($results['description']->getBody()->getContents(),true);  
           $ret['description'] = $res['result']['description'] ?? "";
       }
       
      
      
      
      return json(['code' => 0,'msg'=>"操作成功",'data'=>$ret ]);
      
      
      
    } 
    
    
    #机器人信息设置
    public function bot_setup(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;     
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->post(); 
      $botlist = Db::name('bot_list')->where("plugin",$request->user->plugin)->where('API_BOT',$bot)->cache("{$request->user->plugin}_{$bot}")->find();  
      
    
      $client = new Guzz_Client(['timeout' => 8,'http_errors' => false]);   
      $promises = [ 
          'setname' => $client->getAsync("{$botlist['API_URL']}{$botlist['API_TOKEN']}/setMyName?name=".$data['NAME']),
          'setMyDescription' => $client->getAsync("{$botlist['API_URL']}{$botlist['API_TOKEN']}/setMyDescription?description=".$data['description']),
          'getAdmin' => $client->getAsync("{$botlist['API_URL']}{$botlist['API_TOKEN']}/getChat?chat_id=".$data['Admin'])
       ]; 
       $results = Guzz_Promise\unwrap($promises);//并发异步请求 
       
        
        if($results['getAdmin']){
           $res = json_decode($results['getAdmin']->getBody()->getContents(),true);  
           if(empty($res['ok'])){ 
               return json(['code' => 1,'msg'=>"你设定的管理员尚未关注机器人"  ]); 
           }
            
         $ret['AdminUser'] = $res['result']['username']??"未设置";
         $ret['AdminName']  =$res['result']['first_name']??""; 
         $ret['AdminName']  .=$res['result']['last_name']??""; 
         Db::name('bot_list')->where('plugin',$request->user->plugin)->where('API_BOT',$bot)->update(["Admin"=>$data['Admin'] ]);  
         Cache::delete("{$request->user->plugin}_{$bot}");
       } 
       
      return json(['code' => 0,'msg'=>"操作成功",'data'=>"" ]);
    }
    
    
    #欢迎语设置
    public function group_welcome(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;     
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->post(); 
      Db::name('bot_group')->where('bot',$bot)->where('groupid',$data['groupid'])->update(["welcome"=>$data['welcome']]);  
      Cache::delete("group_{$data['groupid']}_welcome");
      return json(['code' => 0,'msg'=>"操作成功",'data'=>"" ]);
    }
    
    
    #定时广告设置
    public function group_adtext(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;     
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->post(); 
      $botlist = Db::name('bot_list')->where("plugin",$request->user->plugin)->where('API_BOT',$bot)->cache("{$request->user->plugin}_{$bot}")->find(); 
      
      $update = Db::name('bot_group')->where('bot',$bot)->where('groupid',$data['groupid'])->update(["adtext"=>$data['adtext'],"adtime"=>$data['adtime']]); 
      
      if($data['adtime'] > 0){
          $group = Db::name('bot_group')->where("plugin",$request->user->plugin)->where('bot',$bot)->where('groupid',$data['groupid'])->find(); 
          $data['images'] = $group['images'];
          $data['API_URL'] = $botlist["API_URL"];
          $data['API_TOKEN'] = $botlist["API_TOKEN"]; 
          Redis::hset("group_adtext",$data['groupid'], serialize($data));
      }else{
          Redis::HDEL("group_adtext",$data['groupid']);
      } 
      #Cache::delete("group_{$data['groupid']}_adtext");
      
      return json(['code' => 0,'msg'=>"操作成功",'data'=>"" ]);
    } 
    
    
    public function group_delimg(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;     
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->post(); 
      if(empty($data['type'])){
         return json(['code' => 1,'msg'=>"操作失败·云端未删除",'data'=>"" ]); 
      }
      
      switch ($data['type']) {
          default: 
              return json(['code' => 1,'msg'=>"操作失败·未支持",'data'=>"" ]); 
              break;
              
          case 'images': 
              Db::name('bot_group')->where('bot',$bot)->where('groupid',$data['qunid'])->update(["images"=>""]);   
              break;
              
          case 'hyimg': 
              Db::name('bot_group')->where('bot',$bot)->where('groupid',$data['qunid'])->update(["hyimg"=>""]);   
              break;
          
          case 'commands': 
              Db::name('bot_commands')->where('bot',$bot)->where('id',$data['id'])->update(["photo"=>""]);   
              break;    
           
      } 
      
      return json(['code' => 0,'msg'=>"操作成功",'data'=>"" ]);
    }
    
   
   
   
   
    public function trx_jie_log(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $plugin = $request->user->plugin;
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->get(); 
      $page = ($data['page']-1)*$data['limit']; 
      $jsonVal = array();
      $so =[]; 
      
      array_push($so,"del");
      array_push($so,'=');
      array_push($so,0); 
      
      array_push($so,"plugin");
      array_push($so,'=');
      array_push($so,$plugin); 
      
      array_push($so,"bot");
      array_push($so,'=');
      array_push($so,$bot);  
 
      #状态区分
      if(!empty($data['state'])){
          array_push($so,"zt");
          array_push($so,'=');
          array_push($so,$data['state']);
      } 
      #必备关键词 + 时间日期搜索
      if(!empty($data['keyword'])){
          array_push($so,$data['t']);
          array_push($so,'=');
          array_push($so,$data['keyword']);
      }
      if(!empty($data['timea'])){
          array_push($so,"time");
          array_push($so,'>');
          array_push($so,substr($data['timea'],0,10));
          array_push($so,"time");
          array_push($so,'<');
          array_push($so,substr($data['timeb'],0,10));
      }
      #搜索end
  
 
      
     $so = array_chunk($so,3);//拆分 
     
 
     $count = Db::name('bot_log_jie')->where([$so])->count(); 
     $list = Db::name('bot_log_jie')->where([$so])->limit($page,$data['limit'])->order('id desc')->select();  
 
     $jsonVal['count'] = $count;
     $jsonVal['list'] = $list;  
      return json(['code' => 0,'msg'=>"获取成功",'num'=>count($list),'data' => $jsonVal ]);  
    }  
    
    
    
    public function trx_total(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $plugin = $request->user->plugin;
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->get(); 
      
       
        $setup = model\trx_setup::where("plugin",$plugin)->where("bot",$bot)->find();
        
        if(empty($setup['PrivateKey'])){
            return json(["code"=>1,"msg"=>"失败,似乎未配置钱包数据"]);
        }
        
        if(!empty($setup)){ 
            try {
                    $PrivateKey = Account::SetPrivateKey($setup['PrivateKey']);
                    $address = $PrivateKey->address()->__toString();
                    $tron = new Tron(1,$PrivateKey,$setup['TRON_API_KEY']); 
                    $TRXbalance = $tron->getTrxBalance($address) / 1000000; 
                    $TRC20 = $tron->Trc20('TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t');//合约地址 - USDT合约
                    $USDTbalance = $TRC20->balanceOf($address)->__toString() / 1000000;  
                
            } catch (\Exception $e) { 
                return json(['code' => 1,'msg'=>"错误提示：".$e->getMessage() ]);   
            }
             
        }else{
            $TRXbalance = 0;
        }
      
 
      
      $date = date("Ymd"); 
      $bot_total_d = Db::name('bot_total_d')->where('bot', $bot)->where('dated', $date)->find();
      if(empty($bot_total_d)){
         
          $bot_total_d['jie'] = 0;
          $bot_total_d['huan'] = 0;
      }
      
      $trxprice =  Redis::get("TRXprice");
      
      $row['trxbalance'] = $TRXbalance;
      $row['trxprice'] = $trxprice;
      $row['usdtbalance'] = $USDTbalance;
      $row['shandui'] = $setup['shandui'];
      $row['okshandui'] = $setup['okshandui'];
      
      return json(['code' => 0,'msg'=>"获取成功",'row'=>$row,'data' => $bot_total_d ,'yuzhi'=>$setup['yuzhi']]);  
    }
    
    
    
    public function trx_addtrx(Request $request){
        $uid = $request->user->id;
        $bot = $request->user->remark;
        $plugin = $request->user->plugin;
        $Coulumn = $request->user->roleId==3?"upid":"myid";
        $data = $request->post();  
        $time = time();
        
        $setup = Db::name('trx_setup')->where("plugin",$plugin)->where("bot",$bot)->cache("trx_{$bot}_setup")->find();
        
        if(empty($setup['PrivateKey'])){
            return json(["code"=>1,"msg"=>"失败,似乎未配置钱包数据"]);
        }
        
        if(empty($data['money']) || empty($data['address'])){
            return json(["code"=>1,"msg"=>"缺少数据参数"]);
        }
        
        $data['address'] = str_replace(' ', '', $data['address']);

        
        if(strlen($data['address']) != 34){
            return json(["code"=>1,"msg"=>"请输入正确的钱包地址"]);
        } 
        
       
        try {
                $PrivateKey = Account::SetPrivateKey($setup['PrivateKey']);
                $address = $PrivateKey->address()->__toString();
                $tron = new Tron(1,$PrivateKey,$setup['TRON_API_KEY']); 
                $TRXbalance = $tron->getTrxBalance($address) / 1000000;   
            
        } catch (\Exception $e) { 
            return json(['code' => 1,'msg'=>"错误提示：".$e->getMessage() ]);   
        }
        
        
        if($data['address'] == $address){
            return json(["code"=>1,"msg"=>"失败,预支地址和钱包地址相同"]);
        } 
        
        if((int)$TRXbalance < (int)$data['money'] + 0.3){
            return json(["code"=>1,"msg"=>"钱包余额最大预支数量：".(int)$TRXbalance - 0.3 ." TRX" ]);
        }
        
        $total_trc20 = Db::name('bot_total_trc20')->where('bot',$bot)->where('trc20',$data['address'])->find();  
        if(empty($total_trc20)){
            $total_trc20['bot'] = $bot;
            $total_trc20['trc20'] = $data['address'];
            $total_trc20['time'] = $time;
            $total_trc20['id'] = Db::name('bot_total_trc20')->insertGetId($total_trc20); 
        } 
        
        //  ---------日 时 记录更新-------
        $dated = date("Ymd",$time);
        $dateh = date("YmdH",$time);
        $totalh = Db::name('bot_total_h')->where('bot',$bot)->where('dateh',$dateh)->find();
        if(empty($totalh)){ 
            $total_h = ["bot"=>$bot,"dateh"=>$dateh,"time"=>$time];
            $totalh['id'] = Db::name('bot_total_h')->insertGetId($total_h); //时 
            
            //没有小时数据时 检查有没有天数据
            $totald = Db::name('bot_total_d')->where('bot',$bot)->where('dated',$dated)->find();
            if(empty($totald)){
                $total_d = ["bot"=>$bot,"dated"=>$dated,"time"=>$time];
                $totald['id'] = Db::name('bot_total_d')->insertGetId($total_d); 
            } 
        } 
        
        
        $zret = $tron->sendTrx($data['address'],$data['money'] * 1000000);
        if(empty($zret->result) || empty($zret->txid)){
		     $txid = $zret->txid ?? "no";
		     $data['plugin'] =  $plugin;
		     $data['bot'] =  $bot;
		     $data['auto'] =  1;
		     $data['type'] =  1; 
		     $data['zt'] =  2;
		     $data['hash'] =  $txid;
		     $data['time'] =  $time; 
		     Db::name('bot_log_jie')->insert($data);
		     return json(['code' => 1,'msg'=>"预支失败,请查看哈希",'hash'=>$txid]);  
         }else{
             $txid = $zret->txid ?? "no";
		     $data['plugin'] =  $plugin;
		     $data['bot'] =  $bot;
		     $data['auto'] =  1;
		     $data['type'] =  1; 
		     $data['zt'] =  1;
		     $data['hash'] =  $txid;
		     $data['time'] =  $time; 
		     Db::name('bot_log_jie')->insert($data);
		     if(!empty($data['kou'])){
		         Db::name('bot_total_trc20')->where('bot',$bot)->where('trc20',$data['address'])->inc("loan",$data['money'])->inc("trx",$data['money']* 1000000)->update(); 
		     }
		     
		     #更新 时,日 统计
		     Db::name('bot_total_h')->where('id',$totalh["id"])->inc("jie",$data['money'])->update();
             Db::name('bot_total_d')->where('bot',$bot)->where('dated',$dated)->inc("jie",$data['money'])->update(); 
		     return json(['code' => 0,'msg'=>"预支成功,请查看哈希",'hash'=>$zret->txid ]);  
		     
		      
         } 
      
      
      return json(['code' => 0,'msg'=>"操作成",'hash'=>0 ]);  
    }
   
 
        
        
        
    //获取购买TRX记录    
    public function bot_log_sunswap(Request $request){
      $uid = $request->user->id;
      $bot = $request->user->remark;
      $plugin = $request->user->plugin;
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->get(); 
      $page = ($data['page']-1)*$data['limit']; 
      $jsonVal = array();
      $so =[]; 
      
      array_push($so,"del");
      array_push($so,'=');
      array_push($so,0); 
      
      array_push($so,"plugin");
      array_push($so,'=');
      array_push($so,$plugin); 
      
      array_push($so,"bot");
      array_push($so,'=');
      array_push($so,$bot);  
 
 
      #状态区分
      if(!empty($data['state'])){
          array_push($so,"zt");
          array_push($so,'=');
          array_push($so,$data['state']);
      } 
      
      #必备关键词 + 时间日期搜索
      if(!empty($data['keyword'])){
          array_push($so,$data['t']);
          array_push($so,'=');
          array_push($so,$data['keyword']);
      }
      if(!empty($data['timea'])){
          array_push($so,"time");
          array_push($so,'>');
          array_push($so,substr($data['timea'],0,10));
          array_push($so,"time");
          array_push($so,'<');
          array_push($so,substr($data['timeb'],0,10));
      }
      #搜索end
  
 
      
     $so = array_chunk($so,3);//拆分 
     
 
     $count = Db::name('bot_log_sunswap')->where([$so])->count(); 
     $list = Db::name('bot_log_sunswap')->where([$so])->limit($page,$data['limit'])->order('id desc')->select();  
 
     $jsonVal['count'] = $count;
     $jsonVal['list'] = $list;  
      return json(['code' => 0,'msg'=>"获取成功",'num'=>count($list),'data' => $jsonVal ]);  
    }  
    
    
    
    #购买TRX 闪兑补货
    public function trx_sunswapTrx(Request $request){
        $uid = $request->user->id;
        $bot = $request->user->remark;
        $plugin = $request->user->plugin;
        $Coulumn = $request->user->roleId==3?"upid":"myid";
        $data = $request->post();  
        $time = time();
        
        $setup = Db::name('trx_setup')->where("plugin",$plugin)->where("bot",$bot)->cache("trx_{$bot}_setup")->find();    
        
        if(empty($setup['PrivateKey'])){
            return json(["code"=>1,"msg"=>"失败,似乎未配置钱包数据"]);
        }
        
        if(empty($data['number']) ){
            return json(["code"=>1,"msg"=>"请输入正确的购买数量USDT"]);
        }
        
        $SunsWapList = Redis::HGETALL("SunsWap"); 
        if(count($SunsWapList) >=2){
            return json(["code"=>1,"msg"=>"当前进行的闪兑任务数量上限(2),请等1分钟后操作"]);
        }
        
 
        
        try {
                $PrivateKey = Account::SetPrivateKey($setup['PrivateKey']);
                $address = $PrivateKey->address()->__toString();
                $tron = new Tron(1,$PrivateKey,$setup['TRON_API_KEY']); 
                #$TRXbalance = $tron->getTrxBalance($address) / 1000000; 
                $TRC20 = $tron->Trc20('TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t');//合约地址 - USDT合约
                $USDTbalance = $TRC20->balanceOf($address)->__toString() / 1000000;  
            
        } catch (\Exception $e) { 
            return json(['code' => 1,'msg'=>"错误提示：".$e->getMessage() ]);   
        }
            
         
        if($USDTbalance < $data['number']){
            return json(["code"=>1,"msg"=>"钱包可用USDT余额不足：".$data['number']]);
        }
        
        #获取当前TRX售价
        $price = Redis::GET("TRXprice");
        if(empty($price)){
            return json(["code"=>1,"msg"=>"获取当前TRX实时价格失败".$data['number']]);
        } 
        
        
        #设置sunswap合约地址
        $Sunwap = $tron->Trc20('TQn9Y2khEsLJW1ChVWFMSMeRDow5KcbLSE');//合约地址
        
        #这里应该进行判断 sunswap合约地址 授权检查
        
        
        $amount = $data['number']*1000000;//USDT数量转换为web3精度6的数量  
        $ret = $Sunwap->SwapUsdtTrx($amount,$amount*($price-0.3),time() + 60); //执行兑换合约  usdt,最小接收TRX数量,最大等待时间 
        
        $data['plugin'] =  $plugin;
        $data['bot'] =  $bot; 
        $data['time'] =  time(); 
        $data['address'] =  $address;
        $data['usdt'] =  $amount;
        $data['hash'] =  $ret->tx->txID ?? "no";
        Db::name('trx_setup')->where('id',$setup['id'])->inc("shandui",$amount)->update();
        if(empty($ret->result)){ 
            #闪兑失败 
		     $data['zt'] =  2; 
		     $data['msg'] =  "返回数据为空"; 
		     Db::name('bot_log_sunswap')->insert($data);  
		     return json(['code' => 0,'msg'=>"兑换失败",'hash' => $data['hash'] ]); 
		     
        }else{
            #闪兑成功
            $data['zt'] =  0; 
            $data['msg'] =  "下单成功";  
		    $sid = Db::name('bot_log_sunswap')->insertGetId($data);
		    Redis::Hsetnx("SunsWap",$sid,$data['hash']);
            Redis::EXPIRE("SunsWap",80);  
        }  
       return json(['code' => 0,'msg'=>"下单成功",'hash' => $data['hash'] ]);   
        
    }
    
    
    
    
    
    #自动预支设置
    public function trx_AutoSet(Request $request){
        $uid = $request->user->id;
        $bot = $request->user->remark;
        $plugin = $request->user->plugin;
        $Coulumn = $request->user->roleId==3?"upid":"myid";
        $data = $request->post();  
        
        $setup = Db::name('trx_setup')->where("plugin",$plugin)->where("bot",$bot)->cache("trx_{$bot}_setup")->find();    
        
        if(empty($setup['PrivateKey'])){
            return json(["code"=>1,"msg"=>"失败,似乎未配置钱包数据"]);
        }
        
        $setup = model\trx_setup::where("plugin",$plugin)->where("bot",$bot)->cache("trx_{$bot}_setup")->update(['yuzhi'=>$data]);  
        return json(['code' => 0,'msg'=>"设置成功"]); 
    
    }
    
    
    
    
    #trx兑换 首页
    public function trx_index(Request $request){
        $uid = $request->user->id;
        $bot = $request->user->remark;
        $plugin = $request->user->plugin;
        $Coulumn = $request->user->roleId==3?"upid":"myid";
        $data = $request->get();   
        
        
        $total_d = model\bot_total_d::where("bot",$bot)->order("id desc")->limit(0,8)->select();
        
        $date = date("Ymd"); 
        $total_tg_d = model\bot_total_d::where('bot', $bot)->where('dated', $date)->find();
        
        return json(['code' => 0,'msg'=>"获取成功","data"=>$total_d,'total_tg_d'=>$total_tg_d]); 
    
    }
    
    
    
    #trx兑换记录 补发
    public function trx_bufa(Request $request){
        $uid = $request->user->id;
        $bot = $request->user->remark;
        $plugin = $request->user->plugin;
        $Coulumn = $request->user->roleId==3?"upid":"myid";
        $data = $request->post();   
        if(empty($data['id'])){
            return json(['code' => 1,'msg'=>"参数错误"]); 
        }
        
        #判断钱包是否配置
        $setup = Db::name('trx_setup')->where("plugin",$plugin)->where("bot",$bot)->cache("trx_{$bot}_setup")->find();  
        if(empty($setup['PrivateKey'])){
            return json(["code"=>1,"msg"=>"失败,似乎未配置钱包数据"]);
        }
        
        #检查订单数据是否存在
        $bot_usdt_list = Db::name('bot_usdt_list')->where("id",$data['id'])->find();  
        if(empty($bot_usdt_list)){
            return json(['code' => 1,'msg'=>"数据不存在"]);  
        }
        
        if(!Redis::SETNX("bufa_{$bot_usdt_list['id']}",1)){  
            return json(['code' => 1,'msg'=>"该订单已补发,回币中..."]);  
        }else{
            Redis::EXPIRE("bufa_{$bot_usdt_list['id']}",60);
        }
        
        $time = $bot_usdt_list['time'];
        $dated = date("Ymd",$time);
        $dateh = date("YmdH",$time);
        
        #判断订单是否已成功
        if($bot_usdt_list['okzt'] == 3){
            return json(['code' => 1,'msg'=>"订单已成功"]);  
        }
        
        #计算汇率
        $price = Redis::GET("TRXprice");
        if(empty($price)){
            return json(["code"=>1,"msg"=>"获取当前TRX实时价格失败"]);
        }else{
            $dec =  round($price * $setup['Rate'] / 100,2);
            $price = $price -$dec;
        }
        
        
        
        
        #初始化钱包节点 
        try {
                $PrivateKey = Account::SetPrivateKey($setup['PrivateKey']);
                $address = $PrivateKey->address()->__toString();
                $tron = new Tron(1,$PrivateKey,$setup['TRON_API_KEY']); 
                $TRXbalance = $tron->getTrxBalance($address) / 1000000;  
            
        } catch (\Exception $e) { 
            return json(['code' => 1,'msg'=>"错误提示：".$e->getMessage() ]);   
        }
            
         
         
        #计算应回TRX数量    
        $huiTrx = $price * $bot_usdt_list['value']; 
        if($TRXbalance * 1000000 < $huiTrx){
            return json(["code"=>1,"msg"=>"你的账户TRX余额不足以完成本次补发","yue"=>$TRXbalance,"hui"=>$huiTrx]);
        }
        
        
         #查询地址是否有预支
        $total_trc20 = Db::name('bot_total_trc20')->where('bot',$bot)->where('trc20',$bot_usdt_list['ufrom'])->find(); 
         if(!empty($total_trc20) && $total_trc20['loan'] > 0){
            $huiTrx =  $huiTrx - $total_trc20['loan'] * 1000000;
         }
         
        #查询最终还需要回多少TRX 是否为正数
        if($huiTrx < 1){
            return json(['code' => 1,'msg'=>"[回款阻断]该地址预支：{$total_trc20['loan']}未还,本订单TRX尚不足偿还欠款"]);  
        }
         
        
        // var_dump($bot_usdt_list['ufrom'],$huiTrx);
        // return json(['code' => 1,'msg'=>"补发订单失败"]);  
        
        #执行转TRX操作
        $zret = $tron->sendTrx($bot_usdt_list['ufrom'],$huiTrx);
        if(empty($zret->result) || empty($zret->txid)){
		     $txid = $zret->txid ?? "no"; 
		     Db::name('bot_usdt_list')->where('id',$bot_usdt_list['id'])->update(['okzt'=>2,'huilv'=>$price,'oktxid'=>$txid,'oktrx'=>$huiTrx/1000000,'oktime'=>$time,"msg"=>"交易失败"]);  
		     return json(['code' => 1,'msg'=>"补发订单失败,请查看哈希",'hash'=>$txid]);  
         } 
         
         #转账成功
         $txid = $zret->txid ?? "no";
         Db::name('bot_usdt_list')->where('id',$bot_usdt_list['id'])->update(['okzt'=>3,'huilv'=>$price,'oktxid'=>$txid,'oktrx'=>$huiTrx/1000000,'oktime'=>$time,"msg"=>"交易成功"]);  
         
         
          
               
 
        //  ---------日 时 记录更新-------
         
        $totalh = Db::name('bot_total_h')->where('bot',$bot)->where('dateh',$dateh)->find();
        if(empty($totalh)){ 
            $total_h = ["bot"=>$bot,"dateh"=>$dateh,"time"=>$time];
            $totalh['id'] = Db::name('bot_total_h')->insertGetId($total_h); //时 
            
            //没有小时数据时 检查有没有天数据
            $totald = Db::name('bot_total_d')->where('bot',$bot)->where('dated',$dated)->find();
            if(empty($totald)){
                $total_d = ["bot"=>$bot,"dated"=>$dated,"time"=>$time];
                $totald['id'] = Db::name('bot_total_d')->insertGetId($total_d); 
            } 
        } 
        #更新 时,日 统计
        Db::name('bot_total_h')->where('id',$totalh["id"])->inc("trx",$huiTrx)->update();
        Db::name('bot_total_d')->where('bot',$bot)->where('dated',$dated)->inc("trx",$huiTrx)->update(); 
         
         
		      
        #如果该地址有预支进行还款
        if(!empty($total_trc20) && $total_trc20['loan'] > 0){  
            Db::name('bot_usdt_list')->where('id',$bot_usdt_list['id'])->inc("huan",$total_trc20['loan'])->update();  
            Db::name('bot_total_trc20')->where('id',$total_trc20['id'])->update(['loan'=>0]);  //直接还清
            Db::name('bot_total_h')->where('id',$totalh["id"])->inc("huan",$total_trc20['loan'])->update();
            Db::name('bot_total_d')->where('bot',$bot)->where('dated',$dated)->inc("huan",$total_trc20['loan'])->update(); 
             
              
        }
        
        
        return json(['code' => 0,'msg'=>"补发成功"]); 
    }
    
    
    
   
   
   
   
    #获取控制中心功能开关
    public function bot_set(Request $request){
        $uid = $request->user->id;
        $bot = $request->user->remark;
        $plugin = $request->user->plugin;
        $Coulumn = $request->user->roleId==3?"upid":"myid";
        $data = $request->get();  
        $time = time(); 
        $data['page'] = 1;
        $data['limit'] = 20;
        $page = ($data['page']-1)*$data['limit']; 
        
        $jsonVal = array();
        $so =[]; 
        
        array_push($so,"del");
        array_push($so,'=');
        array_push($so,0); 
        
        array_push($so,"plugin");
        array_push($so,'=');
        array_push($so,$plugin); 
  
        
        
        #必备关键词 + 时间日期搜索
        if(!empty($data['keyword'])){
          array_push($so,$data['t']);
          array_push($so,'=');
          array_push($so,$data['keyword']);
        }
        if(!empty($data['timea'])){
          array_push($so,"time");
          array_push($so,'>');
          array_push($so,substr($data['timea'],0,10));
          array_push($so,"time");
          array_push($so,'<');
          array_push($so,substr($data['timeb'],0,10));
        }
        #搜索end
        
        
        
        $so = array_chunk($so,3);//拆分 
        
        
        
        $count = model\bot_set::where([$so])->count();
        $list = model\bot_set::where([$so])->limit($page,$data['limit'])->select();  
        #$count = Db::name('bot_set')->where([$so])->count(); 
        #$list = Db::name('bot_set')->where([$so])->limit($page,$data['limit'])->order('id desc')->select();  
        
        $jsonVal['count'] = $count;
        $jsonVal['list'] = $list;  
        return json(['code' => 0,'msg'=>"获取成功",'num'=>count($list),'data' => $jsonVal ]);  
        }  
   
   
   
   
    
    public function bot_setkg(Request $request){
        $uid = $request->user->id;
        $bot = $request->user->remark;
        $plugin = $request->user->plugin;
        $Coulumn = $request->user->roleId==3?"upid":"myid";
        $data = $request->post();   
        
        $botlist = Db::name('bot_list')->where("plugin",$plugin)->where('bot',$bot)->cache("{$plugin}_{$bot}")->find();
        $bot_set = Db::name('bot_set')->where('id',$data['id'])->where('id',$data['id'])->find();
        if(empty($bot_set)){
            return json(['code' => 1,'msg'=>"数据获取失败"]);    
        }
        
        $data['zt'] = $data['zt'] ? 0 :1;
        
        switch ($data['name']) {
            default:
                 Db::name('bot_set')->where('id',$data['id'])->cache("{$bot}_botset")->update($data);
                break;
                
                
            case '机器人小程序功能': 
                if(!Redis::setNX("xiaochengxu_{$bot}",1)){
                   return json(['code' => 1,'msg'=>"修改受限,该功能5分钟内只能修改1次" ]); 
                } 
                Redis::expire("xiaochengxu_{$bot}",300);
                
                
                Db::name('bot_set')->where('id',$data['id'])->cache("{$bot}_botset")->update($data);
                if($data['zt'] == 1){
                    $appurl = "{$botlist['WEB_URL']}/app/{$plugin}/#/login?bot={$bot}";  
                    $client = new Guzz_Client(['timeout' => 8,'http_errors' => false]); 
                    $canshu = urlencode('{"type":"web_app","text":"进入小程序","web_app":{"url":"'.$appurl.'"}}');
                    $res = json_decode($client->request('GET', "{$botlist['API_URL']}{$botlist['API_TOKEN']}".'/setChatMenuButton?menu_button='.$canshu)->getBody(),true);  
                    echo "{$botlist['API_URL']}{$botlist['API_TOKEN']}".'/setChatMenuButton?menu_button='.$canshu;
                     
                    if(empty($res['ok'])){
                        return json(['code' => 1,'msg'=>"修改失败" ]);
                    }else{
                        return json(['code' => 0,'msg'=>"修改为小程序成功,1分钟左右生效" ]);   
                         
                    }  
                }else{
                    $client = new Guzz_Client(['timeout' => 8,'http_errors' => false]); 
                    $res = json_decode($client->request('GET', "{$botlist['API_URL']}{$botlist['API_TOKEN']}".'/setChatMenuButton?menu_button={"type":"commands"}')->getBody(),true);  
                     
                    if(empty($res['ok'])){
                        return json(['code' => 1,'msg'=>"修改失败" ]);
                    }else{ 
                        return json(['code' => 0,'msg'=>"修改为菜单成功,1分钟左右生效" ]);   
                    }  
                    
                } 
                 
                break;
            
             
        }
        
        
        
         
        return json(['code' => 0,'msg'=>"修改成功"]); 
    
    }
    
    
    
    
    
    
   
    
}