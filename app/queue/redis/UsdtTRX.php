<?php
namespace app\queue\redis;

 
use Webman\RedisQueue\Consumer;
use Exception;
use think\facade\Db;
use think\facade\Cache;#Cache https://www.kancloud.cn/manual/thinkphp6_0/1037634
use support\Redis;//redis缓存
use Webman\Push\Api; //push推送 
use GatewayWorker\Lib\Gateway;
use Webman\RedisQueue\Client; #redis queue 队列

#不确定数量的请求
use GuzzleHttp\Pool;
use GuzzleHttp\Client as Guzz_Client;
use GuzzleHttp\Psr7\Request as Guzz_Request; 
use GuzzleHttp\Promise as Guzz_Promise;

use TNTma\TronWeb\Address;
use TNTma\TronWeb\Account;
use TNTma\TronWeb\Tron; 
#该文件负责 收到USDT后计算应该回的TRX数量,并转账回款TRX    
class UsdtTrx implements Consumer{ 
    public $queue = 'UsdtTrx';// 要消费的队列名 
    public $connection = 'usdttrx'; 

    #消费
    public function consume($data){   
         
        if(empty($data['bot']) || empty($data['plugin']) ){
            Db::name('bot_usdt_list')->where("txid",$data['txid'])->update(['msg'=>"缺少bot参数"]);
            echo "\033[1;31m回TRX失败,缺少bot参数\033[0m\n"; 
            return;
        }  
        $BOT = Db::name('bot_list')->where("plugin",$data['plugin'])->where("API_BOT",$data['bot'])->cache("{$data['plugin']}_{$data['bot']}")->find();   
        
        if(empty($BOT)){ 
            echo "\n回TRX失败·请配置机器人信息";
            return 'No Bot'; 
        }
        $setup = Db::name('trx_setup')->where("plugin",$BOT['plugin'])->where("bot",$BOT['API_BOT'])->cache("trx_{$BOT['API_BOT']}_setup")->find();
        if(empty($setup)){ 
            echo "\回TRX失败·机器人{$BOT['API_BOT']}：未设置钱包数据";
            return 'No addr'; 
        }
        
        $bot_usdt_list = Db::name('bot_usdt_list')->where("txid",$data['txid'])->find();  
        if(empty($bot_usdt_list)){
            echo "\回TRX失败,{$data['txid']} 数据不存在";
            return 'No txid no'; 
        }
        
        #echo "\n消费u换t\n"; 
        #var_export($data);
        
        #判断兑换模式
        if($setup['type'] == 1){
            #判断redis是否存在价格
            $price = Redis::GET("TRXprice");
            if(empty($price)){
                $client = new Guzz_Client(['timeout' => 8,'http_errors' => false]);  
                $res = json_decode($client->request('GET', "https://openapi.sun.io/v2/allpairs?page_size=1&page_num=0&token_address=TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t&orderBy=price")->getBody()->getContents(),true);   
                if(!empty($res['data']['0_TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t'])){
                    $price = round($res['data']['0_TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t']['price'],2); 
                    Redis::SETEX("TRXprice",600,$price);//trx实时价格 过期时间 redis
                }   
            }
            $dec =  round($price * $setup['Rate'] / 100,2);
            $price = $price -$dec;
            
            
        }else if($setup['type'] == 2){
            $price = $setup['Price'];
        }
        
        
        $total_trc20 = Db::name('bot_total_trc20')->where('bot',$BOT['API_BOT'])->where('trc20',$data['from'])->find(); #取得钱包地址
        
        if(empty($total_trc20)){
            $trx = $data['value'] / 1000000 * $price;
            
        }else{
            $trx = $data['value'] / 1000000 * $price - $total_trc20['loan']; //这里扣掉贷款额度
        }   
        
        if($trx < 1){
            $dated = date("Ymd",$data['time']);
            $dateh = date("YmdH",$data['time']);
            $huiTRX = $data['value'] / 1000000 * $price;
            Db::name('bot_usdt_list')->where("txid",$data['txid'])->update(['okzt'=>2,'huilv'=>$price,'huan'=>$total_trc20['loan'],'oktime'=>time(),"msg"=>"偿还预支"]);  
            Db::name('bot_total_trc20')->where('bot',$BOT['API_BOT'])->where('trc20',$data['from'])->dec("loan",$huiTRX)->update();  #下面写一条还款记录
            Db::name('bot_total_h')->where('bot',$BOT["API_BOT"])->where('dateh',$dateh)->inc("huan",$huiTRX)->update();
            Db::name('bot_total_d')->where('bot',$BOT["API_BOT"])->where('dated',$dated)->inc("huan",$huiTRX)->update();
            $Tipstext = "本次兑换终止\n偿还预支TRX：{$total_trc20['loan']}\n本次兑换的TRX数量不足以还清贷款\n\n对方地址：<code>{$data['from']}</code>"; 
            $queueData['type'] = "url"; 
            $queueData['url']= $BOT['API_URL'].$BOT['API_TOKEN']."/sendMessage?chat_id={$BOT['Admin']}&text={$Tipstext}";
            Client::send('TG_queue',$queueData);   
            return;  
        }
 
        
        $PrivateKey = Account::SetPrivateKey($setup['PrivateKey']);
        $address = $PrivateKey->address()->__toString();
        $tron = new Tron(1,$PrivateKey,$setup['TRON_API_KEY']); 
        $TRXbalance = $tron->getTrxBalance($address) / 1000000; 
        
         if($TRXbalance < 500 ){ //小于50TRX 可能会矿工费不足 闪兑失败浪费T所以进行终止 并通知管理员飞机
            $Tipstext = "提示消息：TRX余额小于500\n当前余额：{$TRXbalance}\n\n建议你尽快补充TRX"; 
            $queueData['type'] = "url"; 
            $queueData['url']= $BOT['API_URL'].$BOT['API_TOKEN']."/sendMessage?chat_id={$BOT['Admin']}&text={$Tipstext}";
            Client::send('TG_queue',$queueData);      
         }
         
        
        #该自动补TRX逻辑进行优化  更新时间：2023年6月30日20:54:07
        if($TRXbalance < $trx){  
            
            $bot_set = Db::name('bot_set')->where('plugin',"trxbot")->where('name',"TRX不足自动闪兑")->cache("{$BOT['API_BOT']}_botset")->find();
            if(empty($bot_set['zt'])){
                $reply_markup = json_encode([
                    "inline_keyboard"=>[   
                        [["text"=>'查看TRX余额',"callback_data"=>"查看TRX余额"],
                         ["text"=>'补发TRX',"callback_data"=>"补发TRX_{$bot_usdt_list['id']}"]
                        ],  
                        ]
                ]);  
                $Tipstext = "TRX余额不足·系统未开启自动闪兑补货\n请补充TRX后给该笔订单进行补发操作\n\n应回TRX数量：{$trx}\n对方地址：<code>{$data['from']}</code>"; 
                $queueData['type'] = "url"; 
                $queueData['url']= $BOT['API_URL'].$BOT['API_TOKEN']."/sendMessage?chat_id={$BOT['Admin']}&text={$Tipstext}&reply_markup={$reply_markup}";
                Client::send('TG_queue',$queueData);
                Db::name('bot_usdt_list')->where("txid",$data['txid'])->update(['msg'=>"余额不足",'okzt'=>2]); 
                return;   
            }
            
            
            $SunsWapList = Redis::HGETALL("SunsWap"); 
            if(count($SunsWapList) >=1){ #存在闪兑任务在进行,中断闪兑 
                $reply_markup = json_encode([
                    "inline_keyboard"=>[   
                        [["text"=>'查看TRX余额',"callback_data"=>"查看TRX余额"],
                         ["text"=>'补发TRX',"callback_data"=>"补发TRX_{$bot_usdt_list['id']}"]
                        ],  
                        ]
                ]);  
                $Tipstext = "TRX余额不足·闪兑任务进行中\n请补充TRX后给该笔订单进行补发操作\n\n应回TRX数量：{$trx}\n对方地址：<code>{$data['from']}</code>"; 
                $queueData['type'] = "url"; 
                $queueData['url']= $BOT['API_URL'].$BOT['API_TOKEN']."/sendMessage?chat_id={$BOT['Admin']}&text={$Tipstext}&reply_markup={$reply_markup}";
                Client::send('TG_queue',$queueData);
                Db::name('bot_usdt_list')->where("txid",$data['txid'])->update(['msg'=>"闪兑冲突",'okzt'=>2]); 
                return;  
            }
            
            
        
 
            
            
            if($TRXbalance < 50 ){ //小于50TRX 可能会矿工费不足 闪兑失败浪费T所以进行终止 并通知管理员飞机 
                $Tipstext = "闪兑任务终止\ntrx余额低于：50\n无法保证链上闪兑成功\n请补充TRX后给该笔订单进行补发操作\n\n应回TRX数量：{$trx}\n对方地址：<code>{$data['from']}</code>"; 
                $reply_markup = json_encode([
                    "inline_keyboard"=>[   
                        [["text"=>'查看TRX余额',"callback_data"=>"查看TRX余额"],
                         ["text"=>'补发TRX',"callback_data"=>"补发TRX_{$bot_usdt_list['id']}"]
                        ],  
                        ]
                ]); 
                $queueData['type'] = "url"; 
                $queueData['url']= $BOT['API_URL'].$BOT['API_TOKEN']."/sendMessage?chat_id={$BOT['Admin']}&text={$Tipstext}&reply_markup={$reply_markup}";
                Client::send('TG_queue',$queueData);   
                Db::name('bot_usdt_list')->where("txid",$data['txid'])->update(['msg'=>"TRX不足50",'okzt'=>2]); 
                return;   
                
            }else{ //大于50TRX进行闪兑
            
                $TRC20 = $tron->Trc20('TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t');//合约地址 - USDT合约
                $USDTbalance = $TRC20->balanceOf($address)->__toString() / 1000000;  
             
                if($data['value'] / 1000000 + $setup['maxusdt'] > $USDTbalance){//用户转账usdt + 设置U 大于钱包余额 ，则余额全部兑换为trx
                   $USDTbalance = floor($USDTbalance); 
                }else{
                   $USDTbalance = floor($data['value'] / 1000000  + $setup['maxusdt']);//否则闪兑usdt额度为：用户转账usdt + 最大设置U
                }
                
                
                $Sunwap = $tron->Trc20('TQn9Y2khEsLJW1ChVWFMSMeRDow5KcbLSE');//合约地址
                $amount = $USDTbalance*1000000;
                $ret = $Sunwap->SwapUsdtTrx($amount,$amount*$price,time() + 60); 
                
                $sdsql['plugin'] =  $data["plugin"];
                $sdsql['bot'] =  $data["bot"]; 
                $sdsql['time'] =  time(); 
                $sdsql['address'] =  $address;
                $sdsql['usdt'] =  $amount;
                $sdsql['hash'] =  $ret->tx->txID ?? "no";
                
                if(empty($ret->result)){  
                    $Tipstext = "链上闪兑trx失败\n请检查交易哈希：\n<code>".$ret->tx->txID."</code>\n\n请补充TRX后给该笔订单进行补发操作\n\n应回TRX数量：{$trx}\n对方地址：<code>{$data['from']}</code>";  
                    $reply_markup = json_encode([
                    "inline_keyboard"=>[   
                        [["text"=>'查看TRX余额',"callback_data"=>"查看TRX余额"],
                         ["text"=>'补发TRX',"callback_data"=>"补发TRX_{$bot_usdt_list['id']}"]
                        ],   
                        ]
                     ]); 
                    $queueData['type'] = "url"; 
                    $queueData['url']= $BOT['API_URL'].$BOT['API_TOKEN']."/sendMessage?chat_id={$BOT['Admin']}&text={$Tipstext}&reply_markup={$reply_markup}";
                    Client::send('TG_queue',$queueData);  
                    Db::name('bot_usdt_list')->where("txid",$data['txid'])->update(['oktxid'=>$ret->tx->txID,'msg'=>"闪兑失败"]);
                    
                    $sdsql['zt'] =  2; 
                    $sdsql['msg'] =  "链上闪兑失败"; 
                    Db::name('bot_log_sunswap')->insert($sdsql);  
                    return;
                }else{
                    $sunNums = roud($amount*$price/1000000,2);
                    $Tipstext = "TRX补货成功\nTRX补货数量：{$sunNums}\n请注意查看到账情况"; 
                    $queueData['type'] = "url"; 
                    $queueData['url']= $BOT['API_URL'].$BOT['API_TOKEN']."/sendMessage?chat_id={$BOT['Admin']}&text={$Tipstext}";
                    Client::send('TG_queue',$queueData);  
                    
                    
                    #把闪兑txid 丢入定时任务 检查闪兑结果
                    $sdsql['zt'] =  0; 
                    $sdsql['msg'] =  "下单成功";  
        		    $sid = Db::name('bot_log_sunswap')->insertGetId($sdsql);
        		    Redis::Hsetnx("SunsWap",$sid,$sdsql['hash']);
                    Redis::EXPIRE("SunsWap",80);
                    
                    
                    
                    #延迟30秒后重新处理这笔订单
                    Client::send('UsdtTrx',$data,30); 
                    
                    
                    
                }   
            }
             
            
        }
        
         
        
        
        #进行转账 回TRX  
        try {
            $zret = $tron->sendTrx($data['from'],$trx * 1000000);   
            if(empty($zret->result) || empty($zret->txid)){
                $txid = $zret->txid ?? "no";
                Db::name('bot_usdt_list')->where("txid",$data['txid'])->update(['msg'=>"回trx失败",'okzt'=>2,"oktxid"=>$txid]);//0收到 1已转TRX 2失败 3成功
               # throw new \Exception('回币失败·请检查txid数据·稍后重试');
            }else{ 
                 if($total_trc20['loan'] > 0){
                     Db::name('bot_usdt_list')->where("txid",$data['txid'])->update(['msg'=>"回币中..",'huilv'=>$price,'huan'=>$total_trc20['loan'],'oktrx'=>$trx,'okzt'=>1,"oktxid"=>$zret->txid]); 
                 }else{
                     Db::name('bot_usdt_list')->where("txid",$data['txid'])->update(['msg'=>"回币中..",'huilv'=>$price,'oktrx'=>$trx,'okzt'=>1,"oktxid"=>$zret->txid]);
                 } 
            } 
            
            echo "\n\033[1;33m向{$data['from']}转账TRX：{$trx} 完成,监听结果中..\033[0m\n";   
            Redis::hset("OK_".$data['bot'],$zret->txid,time());
            Redis::EXPIRE("OK_".$data['bot'],$setup['Ttime']);
            
        } catch (\Exception $e) {
            echo "回TRX失败,".$e->getMessage()."\n";
        }
   
 
         return true;      
    }
}