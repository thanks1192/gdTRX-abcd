<?php
namespace plugin\trxbot\app\controller;

use support\Redis;//redis缓存
use Webman\RedisQueue\Client; #redis queue 队列 
use think\facade\Db;#mysql https://www.kancloud.cn/manual/think-orm/1258003
use support\Request;
#负责处理：机器人所在的群标题名称改变时触发 
class tgapi_group_newTitle extends Base{
    
    public function index($message){
        $tgTime = $message['date']; 
        $datem = date("Ym",$tgTime);
        $dated = date("Ymd",$tgTime);
        $chatType = $chatId = $message['chat']['type']; 
        $chatId = $message['chat']['id']; 
        $newTitle = $message['new_chat_title'];
        
        
        if($chatType == "group"){
            $chatType = "supergroup";  
        } 
        
        
        switch ($chatType) {
            default:
                echo "不支持的群频道修改标题消息类型\n";
                break;
                
            case 'supergroup':
                Db::name('bot_group')->where('groupid', $chatId)->update(["grouptitle"=>$newTitle]); 
                break;
            
            
            case 'channel':
                Db::name('bot_channel')->where('pid', $chatId)->update(["title"=>$newTitle]); 
                break; 
        }
         
        #Db::name('bot_group_user')->where('qunid', $chatId)->update(["quninfo"=>json_encode($message['chat'],JSON_UNESCAPED_UNICODE)]);
        
        
        // $group_user = Db::name('bot_group_user')->where('qunid',$chatId)->where('userid',$userId)->find();
        // if(empty($group_user)){
        //     $sql['qunid']=$chatId;
        //     $sql['quninfo']=json_encode($message['chat'],JSON_UNESCAPED_UNICODE);
        //     $sql['userid']=$userId;
        //     $sql['userinfo']=json_encode($user,JSON_UNESCAPED_UNICODE);
        //     $sql['cretae_time']=$tgTime;
        //     $totald['id']=Db::name('bot_group_user')->insert($sql);   
        // }else{
        //     Db::name('bot_group_user')
        //         ->where('id', $group_user['id'])
        //         ->update(["del"=>0,"userinfo"=>json_encode($user,JSON_UNESCAPED_UNICODE),"cretae_time"=>$tgTime]);  
        // }  
        // return;
        
    }
    
}