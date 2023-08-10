<?php 
namespace app\bootstrap;

use Webman\Bootstrap;
use think\facade\Db;
use support\Redis;//redis缓存
use think\facade\Cache;
use Webman\RedisQueue\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Client as Guzz_Client;
use GuzzleHttp\Psr7\Request as Guzz_Request; 
use GuzzleHttp\Promise as Guzz_Promise;

	use TNTma\TronWeb\Address;
	use TNTma\TronWeb\Account;
	use TNTma\TronWeb\Tron;
	
	
 

class Loading implements Bootstrap {
    
    #protected static $data = [];
    
    public static function start($worker){
        
        
        // Is it console environment ?
        $is_console = !$worker;
        if ($is_console) {
            // 其它命令行不执行该函数. 
            return;
        } 
        
        // if($worker->name == "webman"){
        //     Redis::DEL("blockNumber");  
        //     Redis::DEL("blockPage");   
        // } 
        
        switch ($worker->name) { 
            default:
                // code...
                break;
                
                
                
                
            case 'monitor':     
                Redis::del("blockLoad"); 
                Redis::del("group_adtext"); 
                Redis::del("{redis-queue}-failed"); 
                
                
                
               
 
                 
                #static::$data = array_flip(Db::table('tb_account')->column("username")); 
                // if (isset(static::$data["ggqpmy207"])) {
                //     echo "存在\n";
                // }
                
                 
                
                
                // $count_num = Db::name("account")->order('id', 'desc')->find(); 
                
                
                // echo $count_num['id'];
                
                
                // $hexdata="a9059cbb000000000000000000000000430876d05c7f8eea51865f9b3f34823e707d85a50000000000000000000000000000000000000000000000002b5e3af16b188000";
                // $rawAmount =substr($hexdata, 72, 64);
                // echo $rawAmount."\n";
 
    
    // $Base58 = Address::encode("41a614f803b6fd780986a42c78ec9c7f77e6ded13c");  
    // echo $Base58;
           
                 
                
                
                #检查监听usdt任务是否启动
                $plugin = json_encode(array_keys(config('plugin'))); 
  
                if(preg_match('/trxbot/', $plugin, $return)){
                    $lock = run_path() . DIRECTORY_SEPARATOR . 'runtime/ins_trxbot.lock'; 
                    if(!is_file($lock)){
                        echo "\033[33;41m提示：TRX兑换机器人【未配置】点击下方地址进行配置 \033[0m\n";  
                        echo "\033[0;32mhttp://".localIP().":8686/app/install/trxbot\033[0m\n\n"; 
                    } 
                    
                    $task =  Db::table('sys_crontab')->whereIn('id',"2,3,4")->where('status',1)->count();
                    if($task != 3 ){ 
                        Db::table('sys_crontab')->whereIn('id',"2,3,4")->update(['status' => 1]);   
                        echo "\033[0;31m系统任务检查异常：\033[0m\033[0;32m[已修复]\033[0m\n";
                        echo "\033[33;41m提示：看到此消息·请重新启动项目 \033[0m\n\n";  
                    }
 
                }
                
                
                #缓存定时广告群数据
                $qunlist = Db::name('bot_group')->where('adtime',">",0)->select(); 
                foreach ($qunlist as $qunval) {  
                    $bot = Db::name('bot_list')->where("plugin",$qunval['plugin'])->where("API_BOT",$qunval['bot'])->cache("{$qunval['plugin']}_{$qunval['bot']}")->find();
                    if(empty($qunval['adtext']) || empty($bot)){
                        continue; 
                    }
                    $qdata['API_URL']= $bot['API_URL'];
                    $qdata['API_TOKEN']= $bot['API_TOKEN'];
                    $qdata['adtime']= $qunval['adtime'];
                    $qdata['adtext']= $qunval['adtext']; 
                    $qdata['images']= $qunval['images']; 
                    Redis::hset("group_adtext",$qunval['groupid'], serialize($qdata));  
                }
                
 
                
                
                
                #获取TRX价格 
                $client = new Guzz_Client(['timeout' => 5,'http_errors' => false,'verify' => false]);
                try {
                    $res = json_decode($client->request('GET', "https://openapi.sun.io/v2/allpairs?page_size=1&page_num=0&token_address=TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t&orderBy=price")->getBody()->getContents(),true); 
                    if(!empty($res['data']['0_TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t'])){
                        $price = round($res['data']['0_TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t']['price'],2); 
                        Redis::SETEX("TRXprice",600,$price);//trx实时价格 过期时间 redis
                        echo "TRX实时价格获取成功：\033[1;32m{$price}\033[0m\n";  
                    }
                } catch (\Throwable $e) {   
                    echo "\033[33;41m异常：获取TRX实时价格失败 \033[0m\n"; 
                    echo "\033[0;31m请确认服务器能访问：\033[0m";
                    echo "\033[0;32mhttps://openapi.sun.io/v2/allpairs?page_size=1&page_num=0&token_address=TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t&orderBy=price\033[0m\n\n";
                }
                
 
 
                
                
                
                break; 
        } 


    }

}
