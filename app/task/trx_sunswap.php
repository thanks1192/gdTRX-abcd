<?php

namespace app\task;
use support\Redis;//redis缓存
use Webman\RedisQueue\Client; #redis queue 队列
use Webman\RedisQueue\Redis as RedisDuiLie;
use support\Log;//日志
use think\facade\Db;#mysql https://www.kancloud.cn/manual/think-orm/1258003
use think\facade\Cache;#Cache https://www.kancloud.cn/manual/thinkphp6_0/1037634
 

use GuzzleHttp\Pool;
use GuzzleHttp\Client as Guzz_Client;
use GuzzleHttp\Psr7\Request as Guzz_Request; 
use GuzzleHttp\Promise as Guzz_Promise;
#检查trx闪兑 链上兑换结果
class trx_sunswap{
    public function  execute(): string{ 
        $BOT = Db::name('bot_list')->where("plugin","trxbot")->order('id desc')->cache("trxbot")->find(); 
        if(empty($BOT)){
            return 'no bot';
        }
        $BotInfo = Db::name('trx_setup')->where("plugin",$BOT['plugin'])->where("bot",$BOT['API_BOT'])->cache("trx_{$BOT['API_BOT']}_setup")->find();
        if(empty($BotInfo)){
           return 'no botinfo'; 
        }
        
        
        $promises=[]; 
        $client = new Guzz_Client(['timeout' => 8,'http_errors' => false,'headers' => ['TRON-PRO-API-KEY' => getenv('TRONSCAN_APIKEY')]]);  
        
        $SunsWapList = Redis::HGETALL("SunsWap");  
        
        foreach ($SunsWapList as $key=>$Value) {  
            $promises["{$key}"] = $client->getAsync("https://apilist.tronscanapi.com/api/transaction-info?hash={$Value}");   
        }
        $results = Guzz_Promise\unwrap($promises); 
        
        $amount= 0;
        foreach ($results as $rkey=>$rval) {  //$rkey = $key  = suswap表的ID ，$rval  = 返回内容
            if(empty($rval['contractRet'])){
                echo "定时任务sunswap,请求数据返回异常\n";
                continue;
            }
            if($rval['confirmed'] == true){ 
                Redis::Hdel("SunsWap",$rkey);  
                
                $bot_log_sunswap = Db::name('bot_log_sunswap')->where("id",$rkey)->find();
                if(empty($bot_log_sunswap)){
                    echo "定时任务sunswap,匹配数据失败\n";
                    continue;  
                }
                if($bot_log_sunswap['zt'] != 0){
                    echo "定时任务sunswap,匹配数据:{$rkey},状态已处理跳过\n";
                    continue;  
                }
                
                
                foreach ($rval['transfersAllList'] as $tkey=>$tval) {
                    if($tkey['contract_address'] == 'TQn9Y2khEsLJW1ChVWFMSMeRDow5KcbLSE'){
                        $amount = $tval['amount_str'];//拿到兑换获得的trx数量
                    } 
                } 
                 
                
                if($rval['contractRet'] == "SUCCESS"){//兑换成功  
                    Db::name('trx_setup')->where('id',$BotInfo['id'])->inc("okshandui",$amount)->update();
                    Db::name('bot_log_sunswap')->where('id',$rkey)->update(['zt'=>1,'trx'=>$amount,"msg"=>"交易完成"]); 
                     
                    
                }else{
                    #失败或其它情况 
                    Db::name('bot_log_sunswap')->where('id',$rkey)->update(['zt'=>2,'trx'=>$amount,"msg"=>$rval['contractRet']]); 
                }
                
            }
            
        
            
        }
        
        return "ok"; 
    }
}