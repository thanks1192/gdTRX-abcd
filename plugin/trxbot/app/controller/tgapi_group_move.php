<?php
namespace plugin\trxbot\app\controller;


use support\Redis;//redis缓存
use Webman\RedisQueue\Client; #redis queue 队列 
use think\facade\Db;#mysql https://www.kancloud.cn/manual/think-orm/1258003
use support\Request;
use think\facade\Cache;
use app\model;
//负责处理：机器人所在群普通群升级为超级群事件 （首次设置公开群链接触发）
class tgapi_group_move extends Base{ 
    public function index($message){ 
        $tgTime = $message['date']; 
        $datem = date("Ym",$tgTime);
        $dated = date("Ymd",$tgTime);
        #$chatType = $message['chat']['type'];
        $chatId = $message['chat']['id'];
        $chatTitle = $message['chat']['title']??"未设定标题";
        $move = $message['migrate_to_chat_id']; 
        
        $jsoninfo = json_encode($message['chat']);
        
        Db::name('bot_group')->where('groupid', $chatId)->update(['del'=>1]);
        Db::name('bot_group_user')->where('qunid', $chatId)->update(['qunid'=>$move,'quninfo'=>$jsoninfo]);
        
        // Db::name('bot_group')->where('groupid', $chatId)->update(['groupid'=>$move,'grouptitle'=>$chatTitle]);
        // Db::name('keep_setup')->where('qunid', $chatId)->update(['qunid'=>$move,'info'=>json_encode($message['chat'])]);
        // Db::name('keep_log')->where('qunid', $chatId)->update(['qunid'=>$move]);
        // Db::name('keep_logc')->where('qunid', $chatId)->update(['qunid'=>$move]);
        // Db::name('keep_total')->where('qunid', $chatId)->update(['qunid'=>$move,'info'=>json_encode($message['chat'])]);
        // Db::name('keep_totalz')->where('qunid', $chatId)->update(['qunid'=>$move,'info'=>json_encode($message['chat'])]); 
        // #清理老群号数据
        //  Cache::delete("{$this->BOT['API_BOT']}{$chatId}setup");
        //  Cache::delete("{$this->BOT['API_BOT']}{$chatId}totalz");
        //  Cache::delete("{$this->BOT['API_BOT']}{$chatId}{$datem}");
        //  Cache::delete("{$this->BOT['API_BOT']}{$chatId}{$dated}");
        //  Redis::del("{$this->BOT['API_BOT']}{$chatId}inc");
        //  Redis::del("{$this->BOT['API_BOT']}{$chatId}dec"); 
        //  Redis::del("{$this->BOT['API_BOT']}{$chatId}huilv"); 
        
        
        $text = "
        <b>注意：
        群升级为→超级群</b> 
        
        
        <b>为什么如此?： 
        首次设定：公开群组链接</b>
        
        只有群从来没有设置过公开群链接的群才会出现(只会出现1次)请重新设定机器人为管理员！
        ";
        $this->send("/sendMessage?chat_id={$move}&text={$text}"); 
         
        return;
        
        
    }
    
}