<?php

namespace app\queue\redis;

 
use Webman\RedisQueue\Consumer;
use Exception;
use think\facade\Db;
use support\Redis;//redis缓存
use Webman\Push\Api as push; //push推送 
use Hashids\Hashids; #ID加解密


#支付 新订单时推送 
    
class newdd implements Consumer
{
    // 要消费的队列名
    public $queue = 'botqunmsg';

    // 连接名，对应 config/redis_queue.php 里的连接`
    public $connection = 'bot_push_msg';

    // 消费
    public function consume($data){ 
        $BOT = Db::name('bot_list')->where("plugin","trxbot")->order('id desc')->cache("trxbot")->find();  
        if(empty($BOT)){
            return true;
        }
        $account = Db::name('account')->where("plugin","trxbot")->where("remark",$BOT['API_BOT'])->order('id desc')->cache("account_uid")->find();  
        if(empty($account)){
            return true;
        } 
        
        $push = new push('http://127.0.0.1:3012',config('plugin.webman.push.app.app_key'),config('plugin.webman.push.app.app_secret'));
        $push->trigger('user-'.$account['id'], 'botqunmsg', $data);
    }
}