<?php
namespace plugin\trxbot\app\controller;

use Webman\RedisQueue\Client; #redis queue 队列
use think\facade\Db;#mysql https://www.kancloud.cn/manual/think-orm/1258003
use think\facade\Cache;#Cache https://www.kancloud.cn/manual/thinkphp6_0/1037634
use support\Redis;//redis缓存
use Hashids\Hashids; //数字加密 
use TNTma\TronWeb\Address;
use TNTma\TronWeb\Account;
use TNTma\TronWeb\Tron;

use GuzzleHttp\Pool;
use GuzzleHttp\Client as Guzz_Client;
use GuzzleHttp\Psr7\Request as Guzz_Request; 
use GuzzleHttp\Promise as Guzz_Promise;
//负责处理：消息下方的按钮点击事件
class tgapi_callback_query extends Base{
    
    public function index($message){   
        $type = $message['data'];
        $value = ""; 
        $tgid = $message['from']['id'];   
        
        preg_match('/(.+)_(\w+)/i', $message['data'], $return); 
        if(count($return) == 3){
            $type=$return[1];
            $value=$return[2];  
        }
        
        
        switch ($type) {
            default: 
                $this->send("/answerCallbackQuery?callback_query_id={$message['id']}&text={$type},未支持&show_alert=0");
                break;
                
                
                
                
            case 'NotifyMsg':   
                
                $res = json_encode($this->get("/getChatAdministrators?chat_id={$message['message']['chat']['id']}"));    
                
                
                if(preg_match("/({$message['from']['id']})/i", $res)){  
                       
                        $reply_markup = json_encode([
                            "inline_keyboard"=>[   
                                [["text"=>'❌关闭兑换消息通知',"callback_data"=>"CloseNotifyMsg"]],
                                [["text"=>'🔍试一试查询钱包',"switch_inline_query_current_chat"=>""]] 
                                ]
                        ]);  
                         Db::name('bot_group')->where("groupid",$message['message']['chat']['id'])->where("bot",$this->BOT['API_BOT'])->update(['del'=>0,'send'=>1]); 
                         $this->send("/editMessageText?chat_id={$message['message']['chat']['id']}&message_id={$message['message']['message_id']}&text=<b>本群是否接收兑换通知?</b>\n\n当前状态：接收✅&reply_markup={$reply_markup}"); 
                         $this->send("/answerCallbackQuery?callback_query_id={$message['id']}&text=已允许兑换消息通知&show_alert=1"); 
                    
                }else{
                    $this->send("/answerCallbackQuery?callback_query_id={$message['id']}&text=您无权操作&show_alert=1");
                }
                break;
                
                
            case 'CloseNotifyMsg':  
                $res = json_encode($this->get("/getChatAdministrators?chat_id={$message['message']['chat']['id']}"));   
                echo $res;
                
                if(preg_match("/({$message['from']['id']})/i", $res)){  
                    $reply_markup = json_encode([
                        "inline_keyboard"=>[   
                            [["text"=>'✅接收兑换消息通知',"callback_data"=>"NotifyMsg"]],
                            [["text"=>'🔍试一试查询钱包',"switch_inline_query_current_chat"=>""]] 
                            ]
                    ]);
                    Db::name('bot_group')->where("groupid",$message['message']['chat']['id'])->where("bot",$this->BOT['API_BOT'])->update(['del'=>0,'send'=>0]);
                    $this->send("/editMessageText?chat_id={$message['message']['chat']['id']}&message_id={$message['message']['message_id']}&text=<b>本群是否接收兑换通知?</b>\n\n当前状态：拒绝✖️&reply_markup={$reply_markup}");  
                    $this->send("/answerCallbackQuery?callback_query_id={$message['id']}&text=已禁止兑换消息通知&show_alert=1");
                }else{
                    $this->send("/answerCallbackQuery?callback_query_id={$message['id']}&text=您无权操作&show_alert=1");
                }
                 
                break;
                
            
            case '推广链接':
                $hashid = new Hashids();
                $user = Db::name('account_tg')->where('del', 0)->where('bot', $this->BOT['API_BOT'])->where('tgid', $message['from']['id'])->find();
                if(empty($user)){
                    $this->send("/answerCallbackQuery?callback_query_id={$message['id']}&text=请先关注启用机器人&show_alert=1"); 
                    break;  
                } 
                $hid = $hashid->encode($user['id']); 
                $text = " 
                你的邀请链接: \n<code>https://t.me/{$this->BOT['API_BOT']}?start={$hid}</code>
                \n<b>点击以上地址自动复制</b>\n邀请他人使用本机器人兑换TRX,你将获得分成（当然您会收到详细的分成数量通知!）";
                $this->send("/sendMessage?chat_id={$message['message']['chat']['id']}&text={$text}&disable_web_page_preview=true&reply_to_message_id={$message['message']['message_id']}");  
                $this->send("/answerCallbackQuery?callback_query_id={$message['id']}&text=获取推广链接成功&show_alert=0");
                break;
            
            
            case '查看TRX余额':
                
                try {
                    $PrivateKey = Account::SetPrivateKey($this->setup['PrivateKey']);
                    $address = $PrivateKey->address()->__toString();
                    $tron = new Tron(1,$PrivateKey,$this->setup['TRON_API_KEY']); 
                    $TRXbalance = $tron->getTrxBalance($address) / 1000000;  
                    $this->send("/answerCallbackQuery?callback_query_id={$message['id']}&text=当前TRX余额：{$TRXbalance}&show_alert=1");
                    break;
                    
                } catch (\Exception $e) {  
                    $this->send("/answerCallbackQuery?callback_query_id={$message['id']}&text=错误：".$e->getMessage()."&show_alert=1"); 
                    break;
                } 
            
 
            
            case '补发TRX':    
                if(empty($value)){
                    $this->send("/answerCallbackQuery?callback_query_id={$message['id']}&text=您无权操作&show_alert=1");
                    break;
                }
                #检查订单数据是否存在
                $bot_usdt_list = Db::name('bot_usdt_list')->where("id",$value)->find();  
                if(empty($bot_usdt_list)){
                    $this->send("/answerCallbackQuery?callback_query_id={$message['id']}&text=订单数据不存在&show_alert=1");
                    break;
                }
                
                if(!Redis::SETNX("bufa_{$value}",1)){  
                    $this->send("/answerCallbackQuery?callback_query_id={$message['id']}&text=该订单正在回币中..&show_alert=1");
                    break;
                }else{
                    Redis::EXPIRE("bufa_{$value}",60);
                }
                
                #时间定义
                $time = $bot_usdt_list['time'];
                $dated = date("Ymd",$time);
                $dateh = date("YmdH",$time);
                
                #判断订单是否已成功
                if($bot_usdt_list['okzt'] == 3){
                    $this->send("/answerCallbackQuery?callback_query_id={$message['id']}&text=禁止补发,该订单已成功&show_alert=1");
                    break;
                }   
                
                
                #计算汇率
                $price = Redis::GET("TRXprice");
                if(empty($price)){
                    $this->send("/answerCallbackQuery?callback_query_id={$message['id']}&text=补发失败,TRX汇率获取失败&show_alert=1");
                    break;
                }else{
                    $dec =  round($price * $this->setup['Rate'] / 100,2);
                    $price = $price -$dec;
                }
                
                #初始化钱包节点 
                try {
                    $PrivateKey = Account::SetPrivateKey($this->setup['PrivateKey']);
                    $address = $PrivateKey->address()->__toString();
                    $tron = new Tron(1,$PrivateKey,$this->setup['TRON_API_KEY']); 
                    $TRXbalance = $tron->getTrxBalance($address) / 1000000;   
                    
                } catch (\Exception $e) {  
                    $this->send("/answerCallbackQuery?callback_query_id={$message['id']}&text=错误：".$e->getMessage()."&show_alert=1"); 
                    break;
                } 
                
                
                
                #计算应回TRX数量    
                $huiTrx = $price * $bot_usdt_list['value']; 
                if($TRXbalance * 1000000 < $huiTrx){ 
                    $this->send("/answerCallbackQuery?callback_query_id={$message['id']}&text=补发失败,账户TRX不足&show_alert=1");
                    break;
                }
                
                
                 #查询地址是否有预支
                $total_trc20 = Db::name('bot_total_trc20')->where('bot',$this->BOT['API_BOT'])->where('trc20',$bot_usdt_list['ufrom'])->find(); 
                 if(!empty($total_trc20) && $total_trc20['loan'] > 0){
                    $huiTrx =  $huiTrx - $total_trc20['loan'] * 1000000;
                 }
                 
                #查询最终还需要回多少TRX 是否为正数
                if($huiTrx < 1){ 
                    $this->send("/answerCallbackQuery?callback_query_id={$message['id']}&text=补发阻断,该地址预支：{$total_trc20['loan']}未还,本订单尚不足偿还欠款&show_alert=1");
                    break;
                }
                
                
                
                #执行转TRX操作
                $zret = $tron->sendTrx($bot_usdt_list['ufrom'],$huiTrx);
                if(empty($zret->result) || empty($zret->txid)){
        		     $txid = $zret->txid ?? "no"; 
        		     Db::name('bot_usdt_list')->where('id',$bot_usdt_list['id'])->update(['okzt'=>2,'huilv'=>$price,'oktxid'=>$txid,'oktrx'=>$huiTrx/1000000,'oktime'=>$time,"msg"=>"交易失败"]);   
        		     $this->send("/sendMessage?chat_id={$message['message']['chat']['id']}&text=补发订单失败,请查看哈希结果\n\n<code>{$txid}</code>");   
                     break;
                 } 
                
                
                 #转账成功
                 $txid = $zret->txid ?? "no";
                 Db::name('bot_usdt_list')->where('id',$bot_usdt_list['id'])->update(['okzt'=>1,'huilv'=>$price,'oktxid'=>$txid,'oktrx'=>$huiTrx/1000000,'oktime'=>$time,"msg"=>"回币中.."]);  
                
                
                
                // //---------日 时 记录更新------- 
                // $totalh = Db::name('bot_total_h')->where('bot',$this->BOT['API_BOT'])->where('dateh',$dateh)->find();
                // if(empty($totalh)){ 
                //     $total_h = ["bot"=>$this->BOT['API_BOT'],"dateh"=>$dateh,"time"=>$time];
                //     $totalh['id'] = Db::name('bot_total_h')->insertGetId($total_h); //时 
                    
                //     //没有小时数据时 检查有没有天数据
                //     $totald = Db::name('bot_total_d')->where('bot',$this->BOT['API_BOT'])->where('dated',$dated)->find();
                //     if(empty($totald)){
                //         $total_d = ["bot"=>$this->BOT['API_BOT'],"dated"=>$dated,"time"=>$time];
                //         $totald['id'] = Db::name('bot_total_d')->insertGetId($total_d); 
                //     } 
                // } 
                // #更新 时,日 统计
                // Db::name('bot_total_h')->where('id',$totalh["id"])->inc("trx",$huiTrx)->update();
                // Db::name('bot_total_d')->where('bot',$this->BOT['API_BOT'])->where('dated',$dated)->inc("trx",$huiTrx)->update(); 
                 
                 
        		      
                #如果该地址有预支进行还款
                if(!empty($total_trc20) && $total_trc20['loan'] > 0){  
                    Db::name('bot_usdt_list')->where('id',$bot_usdt_list['id'])->inc("huan",$total_trc20['loan'])->update();  
                    // Db::name('bot_total_trc20')->where('id',$total_trc20['id'])->update(['loan'=>0]);  //直接还清
                    // Db::name('bot_total_h')->where('id',$totalh["id"])->inc("huan",$total_trc20['loan'])->update();
                    // Db::name('bot_total_d')->where('bot',$this->BOT['API_BOT'])->where('dated',$dated)->inc("huan",$total_trc20['loan'])->update();    
                }
                
                echo "\n\033[1;33m向{$bot_usdt_list['ufrom']}转账TRX：". $huiTrx/1000000 ." 完成,监听结果中..\033[0m\n";
                
                
                $this->send("/answerCallbackQuery?callback_query_id={$message['id']}&text=补发成功,数量：". $huiTrx/1000000 ."&show_alert=1"); 
                Redis::hset("OK_".$this->BOT['API_BOT'],$zret->txid,time());
                Redis::EXPIRE("OK_".$this->BOT['API_BOT'],$this->setup['Ttime']);
        
        
        
        
        
        
        
        
        
            
            break; 
        }//switch end
        
        
        
    }
    
    
}
