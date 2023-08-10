<?php
namespace plugin\trxbot\app\controller;

use Webman\RedisQueue\Client; #redis queue 队列
use think\facade\Db;#mysql https://www.kancloud.cn/manual/think-orm/1258003
use think\facade\Cache;#Cache https://www.kancloud.cn/manual/thinkphp6_0/1037634
use support\Redis;//redis缓存
use Hashids\Hashids; //数字加密 
// use TNTma\TronWeb\Address;
// use TNTma\TronWeb\Account;
// use TNTma\TronWeb\Tron;

use GuzzleHttp\Pool;
use GuzzleHttp\Client as Guzz_Client;
use GuzzleHttp\Psr7\Request as Guzz_Request; 
use GuzzleHttp\Promise as Guzz_Promise;
use app\model;
//负责处理：游戏game 按钮点击事件
class callback_game extends Base{
    
    public function index($message){ 
        $chatId = $message['from']['id'];
        //$game = $message['game_short_name'];
        #$this->send("/answerCallbackQuery?callback_query_id={$message['id']}&text=很好&show_alert=0");
        $this->send("/answerCallbackQuery?callback_query_id={$message['id']}&url=https://bot.jizhangbot.com/?uid={$chatId}");
        return;
        
    }
}