<?php
namespace plugin\trxbot\app\controller;

use Webman\RedisQueue\Client; #redis queue 队列
use think\facade\Db;#mysql https://www.kancloud.cn/manual/think-orm/1258003
use think\facade\Cache;#Cache https://www.kancloud.cn/manual/thinkphp6_0/1037634
use support\Redis;//redis缓存
use TNTma\TronWeb\Address;
use TNTma\TronWeb\Account;
use TNTma\TronWeb\Tron; 

use Webman\Push\Api as push; //push推送 

use GuzzleHttp\Pool;
use GuzzleHttp\Client as Guzz_Client;
use GuzzleHttp\Psr7\Request as Guzz_Request; 
use GuzzleHttp\Promise as Guzz_Promise; 
use plugin\trxbot\app\controller\tgapi_Command;
//负责处理所有用户 群 频道 消息事件
class tgapi_Message extends Base{
    
    public function index($message ,$lei="message"){   
        $chatType = $message['chat']['type'];
        $chatId = $message['chat']['id'];
        $userName = $message['from']['username']??"未设定"; 
        $userId = $message['from']['id'];
        $tgTime = $message['date']; 
        $time = time();  
        $datem = date("Ym",$time);
        $dated = date("Ymd",$time); 
        $dateh = date("YmdH",$time); 
        $reply = 'null'; 
        $type = "";
        $value = ""; 
        if($chatType == "group"){
            $chatType = "supergroup";  
        }
        if($lei == "photo"){ 
           $message['text'] =  $message['caption'];
        } 
        
        $event = Cache::pull("event_{$userId}");
         
    if(isset($event)){
        $type = $event;
        $value = $message['text'];
    }else{ 
        #前端消息推送
        $pushmsg['qunname'] = $message['chat']['title'] ?? "私聊消息";
        $pushmsg['qunuser'] = $userName;
        $pushmsg['username'] = $message['from']['first_name']??""; 
        $pushmsg['username'] .= $message['from']['last_name']??""; 
        $pushmsg['message'] = $message['text'];  
        Client::send('botqunmsg',$pushmsg);  
        #end
        
         
         
        //回复消息
        if(!empty($message['reply_to_message'])){ 
            $reply = json_encode($message['reply_to_message']['from'],JSON_UNESCAPED_UNICODE); 
            return true;  //回复类型消息阻断 不进行任何操作
        }
        
        if(substr($message['text'], 0,1) == "/"){  
            $Command = new tgapi_Command();
            $Command->index($message); 
            return true;      
        }
         
        
             
        if(preg_match('/^([zZ+-]{1})\s*([.0-9]+)\s*$/i', $message['text'], $return)){ 
            $type = strtolower($return[1]);
            $value = $return[2];  
            
        }else if(preg_match('/^T[\w]{33}$/i', $message['text'], $return)){ 
            $type = "查询地址";
            $value = $return[0]; 
            $cach = Redis::GET("{$value}_addr");
            if(!empty($cach)){  
                $this->send("/sendMessage?chat_id={$message['chat']['id']}&reply_to_message_id={$message['message_id']}&text=".unserialize($cach));  
                return true;
            } 
            
        }else if(preg_match('/^[0-9a-z]{64}$/', $message['text'], $return)){ 
            $type = "查询哈希";
            $value = $return[0]; 
        }else if(preg_match('/^@(\w+)$/', $message['text'], $return)){ 
            $type = "查tg信息";
            $value = $return[1]; 
        }else if(preg_match('/[\x{4e00}-\x{9fa5}]+[a-zA-Z]*/u', $message['text'], $return) && strlen($message['text']) < 20 ){  
            $type = $return[0];  
            
        }else{ 
            echo "其它内容阻断\n";
            return true;  
        } 
        
        
        #同类型type更替
        if($type == "币价"){
            $type = "z"; 
        }
    }//event end 
       
          
         
             
         
         
 
        
 
        
               
        
        switch ($type) {
            default: 
                echo "暂时不支持的消息type：{$type}\n";
                break;
                
            case '查tg信息'://这个功能是一个未完善的功能 查询任意指定TG用户的ID 也可以查任意群组 频道ID 不需要进别人群哦，删除92-106行  就去掉这个功能了
                $client = new Guzz_Client(['timeout' => 8,'http_errors' => false,'verify' => false]);
                
                try {
                    $res = json_decode($client->request('GET', "https://api.telegbot.org/api/gd/test/getPwrChat/?id={$value}")->getBody()->getContents(),true); 
                    if(empty($res['success'])){
                        echo '查询用户信息·解析失败';
                        break;   
                    } 
                    
                    if($res['success'] == false){
                        $this->send("/sendMessage?chat_id={$message['chat']['id']}&text=@{$value} 信息不存在"); 
                        break;    
                    }
                    
                    
                    if(empty($res['response'])){
                        echo '查询用户信息·解析失败';
                        break; 
                    }
                    
                    $c_type['user'] = '用户';
                    $c_type['bot'] = '机器人';
                    $c_type['supergroup'] = '群组';
                    $c_type['channel'] = '频道'; 
                    
                    if(!empty($res['response']['usernames'])){
                        $nftname = '';
                        if(count($res['response']['usernames']) > 1){
                            foreach ($res['response']['usernames'] as $NFTvalue) {
                            $nftname = "@".$NFTvalue['username'].' ' . $nftname;
                         }     
                        }
                         
                    }
                    
                    $text ="【<b>TG信息查询结果</b>】  
                    
                    <b>查询：</b>@{$value} 
                    
                    <b>类型：</b><code>{$c_type[$res['response']['type']]}</code>
                    
                    <b>{$c_type[$res['response']['type']]}ID：</b><code>{$res['response']['id']}</code>";  
                    
                    if(!empty($nftname)){
                      $text .="\n\n<b>多用户名：</b><code>{$nftname}</code>";  
                    } 
                    
                    if(!empty($res['response']['first_name'])){
                      $text .="\n\n<b>{$c_type[$res['response']['type']]}昵称：</b><code>{$res['response']['first_name']}</code>";  
                    }
                    if(!empty($res['response']['title'])){
                      $text .="\n\n<b>{$c_type[$res['response']['type']]}名称：</b><code>{$res['response']['title']}</code>";  
                    }
                    
                    
                    if(!empty($res['response']['about'])){
                      $text .="\n\n<b>{$c_type[$res['response']['type']]}介绍：</b><code>{$res['response']['about']}</code>";  
                    } 
                    
                    
                    $this->send("/sendMessage?chat_id={$message['chat']['id']}&text={$text}"); 
                    break; 
                    
                    
                    
                } catch (\Throwable $e) {   
                    echo '查询用户信息失败';
                    break; 
                    
                }    
                
                
                 
                    
                  
                
                
                
            case '查询哈希':   
                $data['bot'] = $this->BOT['API_BOT'];
                $data['chat'] = $message['chat'];
                $data['form'] = $message['from'];
                $data['message_id'] = $message['message_id'];
                $data['txid'] = $value;  
                $this->send(null,"查询哈希",$data);
                break;  
                
            case '查询地址':
                $data['bot'] = $this->BOT['API_BOT'];
                $data['admin'] = $this->BOT['Admin'];
                $data['chat'] = $message['chat'];
                $data['form'] = $message['from'];
                $data['message_id'] = $message['message_id'];
                $data['address'] = $value; 
                $this->send(null,"查询地址",$data); 
                break;    
                
            case '兑换汇率':    
                $client = new Guzz_Client(['timeout' => 8,'http_errors' => false]);
                $res = json_decode($client->request('GET', "https://openapi.sun.io/v2/allpairs?page_size=1&page_num=0&token_address=TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t&orderBy=price")->getBody()->getContents(),true); 
                if(!empty($res['data']['0_TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t'])){
                    $price = round($res['data']['0_TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t']['price'],2); 
                    Redis::SETEX("TRXprice",600,$price);//trx实时价格 过期时间 redis
                    $dec =  round($price * $this->setup['Rate'] / 100,2);
                    $price = $price -$dec;
                    $text ="【<b>兑换汇率 - 实时币价</b>】
                    \n<code>1   USDT = ".round($price,2)." TRX</code>
                    \n<code>10  USDT = ".round($price*10,2)." TRX</code>
                    \n<code>100 USDT = ".round($price*100,2)." TRX</code>
                    \n\n钱包地址(trc20)：\n<code>{$this->addr}</code>\n点击上面地址自动复制
                    ";
                    $this->send("/sendPhoto?chat_id={$message['chat']['id']}&photo=https://telegra.ph/file/caa1f5ee9a712397b3ad9.jpg&caption={$text}"); 
                     
                }
                
                
                break; 
                
            // case '绑定地址':  
            //     $Temppath = "\plugin\\{$this->plugin}\app\controller\Template";
            //     $Template  =  new $Temppath;
            //     $Template = $Template->reply_markup("群绑定地址",$chatType,2); 
            //     $this->send("/sendMessage?chat_id={$message['chat']['id']}&text={$Template['text']}&reply_markup={$Template['reply_markup']}"); 
            //     break;
                
            
            case '兑换地址':  
                $text ="【<b>兑换地址 - trc20</b>】
                \n <u><code>{$this->addr}</code></u>
                \n点击上面地址自动复制\n<b>请注意：\n不要使用交易所转账,无法兑换！ </b>
                "; 
                $this->send("/sendPhoto?chat_id={$message['chat']['id']}&photo=https://telegra.ph/file/caa1f5ee9a712397b3ad9.jpg&caption={$text}"); 
                
                break; 
                
                
                
            case '预支TRX': 
                
                $bot_set = Db::name('bot_set')->where('plugin',$this->plugin)->where('name',"自动预支TRX")->cache("{$this->tobot}_botset")->find();
                if(empty($bot_set['zt'])){
                    $text = "<b>系统关闭了预支功能</b>";
                    $this->send("/sendMessage?chat_id={$message['chat']['id']}&text={$text}&reply_to_message_id={$message['message_id']}"); 
                    break;  
                }
                
                $total_d = Db::name('bot_total_d')->where("dated",$dated)->where("bot",$this->tobot)->find(); 
                 
                $text = "
                <b>【TRX预支条件说明】</b>";
                $yzi = 1;
                if(empty($total_d['jie'])){
                    $total_d['jie'] = 0; 
                }
                
                if($this->setup['yuzhi']['xianzhitrx']){ 
                   $text .= "\n\n".numImg($yzi)." 今日预支限额剩余：<b>". $this->setup['yuzhi']['xianzhitrx'] - $total_d['jie'] . " TRX</b>"; 
                   $yzi++;
                } 
                
                if($this->setup['yuzhi']['tgvip']){
                   $text .= "\n\n".numImg($yzi)." 请注意·您必须是：<b>电报会员</b>"; 
                   $yzi++;
                } 
                if($this->setup['yuzhi']['duihuanlog']){
                   $text .= "\n\n".numImg($yzi)." 地址历史兑换记录大于：<b>{$this->setup['yuzhi']['duihuanlog']} U</b>"; 
                   $yzi++;
                } 
                if($this->setup['yuzhi']['usdtyue']){
                   $text .= "\n\n".numImg($yzi)." 地址 USDT余额 需大于：<b>{$this->setup['yuzhi']['usdtyue']} U</b>"; 
                   $yzi++;
                } 
                 
                $text .="
                ________________________________
                请在60秒内发送你的TRC20钱包地址
                "; 
                Cache::set("event_{$userId}","预支TRX地址接收", 60);
                $this->send("/sendMessage?chat_id={$message['chat']['id']}&photo=https://telegra.ph/file/caa1f5ee9a712397b3ad9.jpg&text={$text}&reply_to_message_id={$message['message_id']}");  
                break; 
            
            
            case '预支TRX地址接收':   
                if(preg_match('/^T[\w]{33}$/i', $value, $return)){ 
                    $total_d = Db::name('bot_total_d')->where("dated",$dated)->where("bot",$this->tobot)->find(); 
                    $total_trc20 = Db::name('bot_total_trc20')->where("trc20",$value)->where("bot",$this->tobot)->find(); 
                    if(empty($total_d['jie'])){
                        $total_d['jie'] = 0; 
                    }
                    #判断地址是否存在数据库中
                    if(empty($total_trc20)){
                        $total_trc20['bot'] = $this->tobot;
                        $total_trc20['trc20'] = $value;
                        $total_trc20['usdt'] = 0;
                        $total_trc20['time'] = $time;
                        $total_trc20['id'] = Db::name('bot_total_trc20')->insertGetId($total_trc20);  
                    }else if($total_trc20['loan'] > 0){
                        $text = "<b>很抱歉,该地址上一次预支未归还\n无法再次进行预支,欠款数量：{$total_trc20['loan']} TRX</b>";
                        $this->send("/sendMessage?chat_id={$message['chat']['id']}&text={$text}&reply_to_message_id={$message['message_id']}"); 
                        break;   
                    } 
                    
                    
                    if($this->setup['yuzhi']['xianzhitrx']>0){
                        $yznum = $this->setup['yuzhi']['xianzhitrx'] - $total_d['jie'];
                        if($yznum < 15){
                            $text = "<b>很抱歉,系统目前无法预支TRX\n今日预支TRX限额已达到最大上限：".$this->setup['yuzhi']['xianzhitrx']." TRX</b>";
                            $this->send("/sendMessage?chat_id={$message['chat']['id']}&text={$text}&reply_to_message_id={$message['message_id']}"); 
                            break;  
                        }
                        
                    } 
                    
                    if($this->setup['yuzhi']['tgvip']){
                        if(empty($message['from']['is_premium'])){
                            $text = "<b>很抱歉,预支失败</b>\n你不是电报VIP用户无法预支";
                            $this->send("/sendMessage?chat_id={$message['chat']['id']}&text={$text}&reply_to_message_id={$message['message_id']}"); 
                            break;  
                        }  
                    }
                    
                    
                    if($this->setup['yuzhi']['duihuanlog']){ 
                        if($total_trc20['usdt'] / 1000000 < $this->setup['yuzhi']['duihuanlog']){ 
                            $text = "<b>很抱歉,预支失败</b>\n该地址历史兑换记录：<b>". $total_trc20['usdt'] / 1000000 ." USDT</b>\n该地址兑换记录小于：".  $this->setup['yuzhi']['duihuanlog'] ." USDT,无法进行预支";
                            $this->send("/sendMessage?chat_id={$message['chat']['id']}&text={$text}&reply_to_message_id={$message['message_id']}"); 
                            break;  
                        }
                    }
                     
                    
                    
                    $client = new Guzz_Client(['timeout' => 8,'http_errors' => false,'headers' => ['TRON-PRO-API-KEY' => getenv('TRONSCAN_APIKEY')]]);
                    $TRONres = json_decode($client->request('GET', "https://apilist.tronscan.org/api/account?address={$value}")->getBody()->getContents(),true); 
                    
                    
                    if($this->setup['yuzhi']['usdtyue']){
                        if(empty($TRONres['trc20token_balances'])){
                            $text = "<b>很抱歉,预支失败</b>\n您的钱包地址似乎没有USDT,请联系老板手动给你预支";
                            $this->send("/sendMessage?chat_id={$message['chat']['id']}&text={$text}&reply_to_message_id={$message['message_id']}"); 
                            break;
                        }
                        
                        $Ru = 0; 
                        foreach ($TRONres['trc20token_balances'] as $Rval) { 
                            if($Rval['tokenId']  == "TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t"){
                                $Ru = $Rval['balance'] / 1000000; 
                                break;
                            }
                        }
                        if($Ru < $this->setup['yuzhi']['usdtyue']){
                            $text = "<b>很抱歉,预支失败</b>\n您的钱包USDT余额：<b>{$Ru} USDT</b>\n\n不符合本系统预支条件(<b> USDT > {$this->setup['yuzhi']['usdtyue']} </b>)";
                            $this->send("/sendMessage?chat_id={$message['chat']['id']}&text={$text}&reply_to_message_id={$message['message_id']}"); 
                            break;
                        }
                        
                    }
                    
        
                        #初始化钱包节点       
                        try {
                            $PrivateKey = Account::SetPrivateKey($this->setup['PrivateKey']);
                            $address = $PrivateKey->address()->__toString();
                            $tron = new Tron(1,$PrivateKey,$this->setup['TRON_API_KEY']); 
                            $TRXbalance = $tron->getTrxBalance($address) / 1000000;    
                        } catch (\Exception $e) {   
                            $this->send("/sendMessage?chat_id={$message['chat']['id']}&text=错误".$e->getMessage()."&reply_to_message_id={$message['message_id']}"); 
                            break;
                        } 
                                    
                                    
                        if($value == $address){
                            $text = "<b>很抱歉,预支失败</b>\n预支地址和钱包地址相同";
                            $this->send("/sendMessage?chat_id={$message['chat']['id']}&text={$text}&reply_to_message_id={$message['message_id']}"); 
                            break;
                        } 
                        
                        #判断钱包余额
                        if($TRXbalance < $this->setup['yuzhi']['yuzhitrx'] + 1){
                            $text = "<b>很抱歉,预支失败</b>\n机器人钱包余额不足暂时无法进行预支";
                            $this->send("/sendMessage?chat_id={$message['chat']['id']}&text={$text}&reply_to_message_id={$message['message_id']}"); 
                            break;
                        }
                         
                        
                        
                        #日 时  记录更新
                        $totalh = Db::name('bot_total_h')->where('bot',$this->tobot)->where('dateh',$dateh)->find();
                        if(empty($totalh)){ 
                            $total_h = ["bot"=>$this->tobot,"dateh"=>$dateh,"time"=>$time];
                            $totalh['id'] = Db::name('bot_total_h')->insertGetId($total_h); //时 
                            
                            //没有小时数据时 检查有没有天数据
                            $totald = Db::name('bot_total_d')->where('bot',$this->tobot)->where('dated',$dated)->find();
                            if(empty($totald)){
                                $total_d = ["bot"=>$this->tobot,"dated"=>$dated,"time"=>$time];
                                $totald['id'] = Db::name('bot_total_d')->insertGetId($total_d); 
                            } 
                        } 
                    
                        #进行TRX转账操作 
                        $zret = $tron->sendTrx($value,$this->setup['yuzhi']['yuzhitrx'] * 1000000);
                        
                        #记录数据
                        if(empty($zret->result) || empty($zret->txid)){
                		     $txid = $zret->txid ?? "no";
                		     $data['plugin'] =  $this->plugin;
                		     $data['bot'] =  $this->tobot;
                		     $data['auto'] =  1;
                		     $data['type'] =  1; 
                		     $data['zt'] =  2;
                		     $data['address'] =  $value;
                		     $data['money'] =  $this->setup['yuzhi']['yuzhitrx'];
                		     $data['hash'] =  $txid;
                		     $data['time'] =  $time; 
                		     Db::name('bot_log_jie')->insert($data); 
                		     $text="预支失败!\n数量：{$this->setup['yuzhi']['yuzhitrx']}\n地址：<code>{$value}</code>\n哈希：<code>{$txid}</code>"; 
                            $this->send("/sendMessage?chat_id={$message['chat']['id']}&text={$text}&reply_to_message_id={$message['message_id']}");
                            break;
                         }else{
                             $txid = $zret->txid ?? "no";
                		     $data['plugin'] =  $this->plugin;
                		     $data['bot'] =  $this->tobot;
                		     $data['auto'] =  1;
                		     $data['type'] =  1; 
                		     $data['zt'] =  1;
                		     $data['address'] =  $value;
                		     $data['money'] =  $this->setup['yuzhi']['yuzhitrx'];
                		     $data['hash'] =  $txid;
                		     $data['time'] =  $time; 
                		     Db::name('bot_log_jie')->insert($data);
                		      
                		     #记录结款数据    
                		     Db::name('bot_total_trc20')->where('id',$total_trc20['id'])->inc("loan",$this->setup['yuzhi']['yuzhitrx'])->inc("trx",$this->setup['yuzhi']['yuzhitrx'] * 1000000)->update();  
                		     
                		     #更新 时,日 统计
                		     Db::name('bot_total_h')->where('id',$totalh["id"])->inc("jie",$this->setup['yuzhi']['yuzhitrx'])->update();
                             Db::name('bot_total_d')->where('bot',$this->tobot)->where('dated',$dated)->inc("jie",$this->setup['yuzhi']['yuzhitrx'])->update();  
                		     
                		      
                         }
                    
                    
                    $text="预支成功!\n数量：{$this->setup['yuzhi']['yuzhitrx']} TRX\n地址：<code>{$value}</code>\n哈希：<code>{$zret->txid}</code>"; 
                    $this->send("/sendMessage?chat_id={$message['chat']['id']}&text={$text}&reply_to_message_id={$message['message_id']}");
                    break;
                    
                }else{
                    $text="请输入正确的TRC20钱包地址";
                    $this->send("/sendMessage?chat_id={$message['chat']['id']}&text={$text}"); 
                    break;
                }
                
                 
                
                
                
            case 'z':  
                $Temppath = "\plugin\\{$this->plugin}\app\controller\Template";
                $Template  =  new $Temppath;
                if(empty($value)){
                    $text = $Template = $Template->bijia("all");  
                }else if($value == 1){
                    $text = $Template = $Template->bijia("bank");  
                }else if($value == 2){
                    $text = $Template = $Template->bijia("aliPay");  
                }else if($value == 3){
                    $text = $Template = $Template->bijia("wxPay");  
                } 
                $inline_keyboard['inline_keyboard'] = []; 
                array_push($inline_keyboard['inline_keyboard'],$text['a11']);  
                $inline_keyboard = json_encode($inline_keyboard); 
                
                $this->send("/sendMessage?chat_id={$chatId}&text={$text['text']}&reply_to_message_id={$message['message_id']}&reply_markup={$inline_keyboard}"); 
                break;
                
                
                
            case '计算公式': 
                $this->send("/sendMessage?chat_id={$chatId}&text=<b>计算结果 = {$value}</b>&reply_to_message_id={$message['message_id']} "); 
                break;    
             
        }//switch end
        
 
        return true; 
    }//index end
    
}