<?php

namespace app\task;
use support\Redis;//redis缓存
use Webman\RedisQueue\Client; #redis queue 队列
use support\Log;//日志
use think\facade\Db;#mysql https://www.kancloud.cn/manual/think-orm/1258003
use think\facade\Cache;#Cache https://www.kancloud.cn/manual/thinkphp6_0/1037634
 

use GuzzleHttp\Pool;
use GuzzleHttp\Client as Guzz_Client;
use GuzzleHttp\Psr7\Request as Guzz_Request; 
use GuzzleHttp\Promise as Guzz_Promise;

class group_adtext{
    public function  execute(): string{    
        
        $bot_set = Db::name('bot_set')->where('plugin',"trxbot")->where('name',"群内定时广告")->cache("trxbot_botset")->find();
        if(empty($bot_set['zt'])){ 
            return "ok"; 
        }
        
        $client = new Guzz_Client(['timeout' => 5]); 
        $call = function ($POSTdata) {  
            #执行代码
            $qunlist = Redis::HGETALL("group_adtext"); 
            $ti = date("i") + 1; 
            #设置文件头
            $header = ['User-Agent'=>'@gd801','url'=>'www.telegbot.org']; 
            foreach($qunlist as $key=>$value){
                $json = unserialize($value);
                
                if(empty($json['API_TOKEN'])){
                    continue;
                }
                if((int)$json['adtime'] < 1){
                   continue; 
                }
                
                if ($ti % (int)$json['adtime'] == 0) {
                    $del_msg_id = Redis::hget("group_adtext_del",$key);
                    if($del_msg_id){
                        #echo $key . "删除上一条广告\n"; 
                        yield new Guzz_Request('GET',"{$json['API_URL']}{$json['API_TOKEN']}/deleteMessage?chat_id={$key}&message_id={$del_msg_id}",$header); 
                    }
                    
                    $BOT = Db::name('bot_list')->where("plugin","trxbot")->order('id desc')->cache("trxbot")->find();
                    if(empty($BOT)){
                        echo "定时广告：未配置机器人数据\n";
                        return 'no';
                    } 
                    $Template  =  new \plugin\trxbot\app\controller\Template($BOT['API_BOT']);
                    $Template = $Template->reply_markup("群定时广告","supergroup",2);  
            
                    if(empty($json['images'])){
                        yield new Guzz_Request('GET',"{$json['API_URL']}{$json['API_TOKEN']}/sendMessage?chat_id={$key}&text={$json['adtext']}&reply_markup={$Template['reply_markup']}&parse_mode=HTML&disable_web_page_preview=true&disable_notification=true",$header);
                    }else{
                        yield new Guzz_Request('GET',"{$json['API_URL']}{$json['API_TOKEN']}/sendPhoto?chat_id={$key}&caption={$json['adtext']}&photo={$json['images']}&reply_markup={$Template['reply_markup']}&parse_mode=HTML&disable_web_page_preview=true&disable_notification=true",$header); 
                    }
                }  
                 
            } 
        };
                
        $pool = new Pool($client, $call("post参数"), [
            'concurrency' => 10,
            'fulfilled' => function ($response, $index) { 
                $data = json_decode($response->getBody()->getContents(),true);  
                if(!empty($data['result']['message_id'])){
                    Redis::hset("group_adtext_del",$data['result']['chat']['id'], $data['result']['message_id']);
                }
                #echo "定时广告".$index." | ok\n";
                 
                     
            },
            'rejected' => function ($err, $index) {
                // 每个请求失败时执行   
                echo "定时广告".$index." | 发送失败\n";
                Log::info("定时广告：{$index}失败".$err->getMessage()."\n");
            },
        ]);
                
        // 开始传输并创建一个 promise
        $promise = $pool->promise();
        
        //等待请求池完成
        $promise->wait();  
        return "ok"; 

    }
    
}