<?php
namespace plugin\trxbot\app\controller;


use support\Redis;//redis缓存
use Webman\RedisQueue\Client; #redis queue 队列 
use think\facade\Db;#mysql https://www.kancloud.cn/manual/think-orm/1258003
use support\Request;
use app\model;
//负责处理：机器人所在群内 新用户入群，退群，被踢出群等消息处理
class tgapi_group_user_notify extends Base{
    
    public function index($chat_member){  
        $tgTime = $chat_member['date']; 
        $datem = date("Ym",$tgTime);
        $dated = date("Ymd",$tgTime);
        $chatId = $chat_member['chat']['id'];  
        $user = $chat_member['new_chat_member']['user'];
        $userId = $user['id']; 
        $type = $chat_member['new_chat_member']['status'];
        $old = $chat_member['old_chat_member']['status'];
        
        $group_user = Db::name('bot_group_user')->where('qunid',$chatId)->where('userid',$userId)->find(); 
        
        if($type == "member" && $old=="left"){//新入群
            if(empty($group_user)){
                $sql['qunid']=$chatId;
                $sql['quninfo']=json_encode($chat_member['chat'],JSON_UNESCAPED_UNICODE);
                $sql['userid']=$userId;
                $sql['userinfo']=json_encode($user,JSON_UNESCAPED_UNICODE);
                $sql['ufrom']=json_encode($chat_member['from'],JSON_UNESCAPED_UNICODE);
                $sql['cretae_time']=$tgTime;
                Db::name('bot_group_user')->insert($sql);   
            }else{
                Db::name('bot_group_user')
                    ->where('id', $group_user['id'])
                    ->update(["del"=>0,"userinfo"=>json_encode($user,JSON_UNESCAPED_UNICODE),"ufrom"=>json_encode($chat_member['from'],JSON_UNESCAPED_UNICODE),"tfrom"=>null,"cretae_time"=>$tgTime]);  
            } 
            
            
            $group = Db::name('bot_group')->where("plugin",$this->plugin)->where('bot',$this->tobot)->where('groupid',$chatId)->find(); 
            
            $bot_set = Db::name('bot_set')->where('plugin',$this->plugin)->where('name',"进群自动欢迎")->cache("{$this->tobot}_botset")->find();
            if(empty($bot_set['zt'])){ 
                
                return true;
            }
            if(!empty($group['welcome'])){
                $Temppath = "\plugin\\{$this->plugin}\app\controller\Template";
                $Template  =  new $Temppath;
                $Template = $Template->reply_markup("新用户进群","supergroup",2); 
                $username = $user['username']??"未设置";
                $namea = $user['last_name'] ?? "";
                $nameb = $user['first_name'] ?? ""; 
                $_text = "<b>新用户入群通知</b>
                <b>用户：</b>@{$username}
                <b>昵称：</b>{$namea}{$nameb}
                ￣￣￣￣￣￣￣￣￣￣￣￣
                "; 
                    
                if(empty($group['hyimg'])){ 
                   $this->send("/sendMessage?chat_id={$chatId}&text={$_text}{$group['welcome']}&reply_markup={$Template['reply_markup']}");    
                }else{
                    $this->send("/sendPhoto?chat_id={$chatId}&caption={$_text}{$group['welcome']}&photo={$group['hyimg']}&reply_markup={$Template['reply_markup']}");     
                } 
                
            } 
            
            
            // $Temppath = "\plugin\\{$this->plugin}\app\controller\Template";
            // $Template  =  new $Temppath;
            // $Template = $Template->reply_markup("用户进群","supergroup",2); 
            // if($Template['text']){ 
            //     $username = $user['username']??"未设置";
            //     $namea = $user['last_name'] ?? "";
            //     $nameb = $user['first_name'] ?? ""; 
            //     $_text = "
            //     ✳️<b>热烈欢迎·老板入群</b>✳️ 
            //     <b>用户：</b>@{$username}
            //     <b>昵称：</b>{$namea}·{$nameb}
            //     ￣￣￣￣￣￣￣￣￣￣￣￣
            //     ";
            //     $this->send("/sendMessage?chat_id={$chatId}&text={$_text}{$Template['text']}&reply_markup={$Template['reply_markup']}");  
            // }
            
                 
            
            
        }else if($type == "left" ){//被踢出群或退群
             Db::name('bot_group_user')->where('qunid', $chatId)->where('userid', $userId)->update(["del"=>1,"tfrom"=>json_encode($chat_member['from'],JSON_UNESCAPED_UNICODE),"exit_time"=>$tgTime]);
        
            
            
        }else if($type == "member" && $old=="administrator"){//成员权限变更为普通成员 
        
        
        
        }else if($type == "administrator"){//成员权限变更为管理员 
        
        
        } 
        
    }
    
}