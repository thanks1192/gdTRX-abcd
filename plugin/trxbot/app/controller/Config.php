<?php

namespace plugin\trxbot\app\controller;

 
use support\Request;
use support\Response;
use Webman\RedisQueue\Client; #redis queue 队列
use TNTma\TronWeb\Address;
use TNTma\TronWeb\Account;
use TNTma\TronWeb\Tron;

use GuzzleHttp\Pool;
use GuzzleHttp\Client as Guzz_Client;
use GuzzleHttp\Psr7\Request as Guzz_Request; 

use think\facade\Db;#mysql https://www.kancloud.cn/manual/think-orm/1258003
use think\facade\Cache;#Cache https://www.kancloud.cn/manual/thinkphp6_0/1037634
use support\Log;//日志
use app\model;
 

/**
 * 基础控制器
 */
class Config{ 
    
    protected $BOT = ""; 
    protected $addr = null;
    protected $cre = null; 
    protected $plugin = 'trxbot';
    protected $setup = null;
    protected $tobot = null;
    public function __construct($bot = null){    
        $this->request = Request();  
        $this->tobot = $bot ?? $this->request->get("bot",null);    
        if(empty($this->tobot)){
            $this->tobot = $this->request->user->remark ?? null;  
        }  
        if(empty($this->tobot)){ 
            echo "\n缺少参数bot,调用文件失败\n";
            return true;   
        } 
        $this->BOT =  Db::name('bot_list')->where("plugin",$this->plugin)->where("API_BOT",$this->tobot)->cache("{$this->plugin}_{$this->tobot}")->find();   
        if(empty($this->BOT)){   
            echo "\n获取bot数据失败,请先配置机器人\n"; 
            return false;
        }  
        $this->setup = model\trx_setup::where("plugin",$this->plugin)->where("bot",$this->tobot)->cache("trx_{$this->tobot}_setup")->find();
        if(empty($this->setup['PrivateKey'])){  
            echo "\n尚未配置钱包数据·请登录后台配置钱包\n";
            return false;   
        }
        if(empty($this->setup['addr'])){
            $this->cre =Account::SetPrivateKey($this->setup['PrivateKey']);
            $this->addr = $this->cre->address()->__toString();  
            Db::name('trx_setup')->where("id",$this->setup["id"])->update(['addr'=>$this->addr]);  
            Cache::delete("trx_{$this->BOT['API_BOT']}_setup");
        }else{
            $this->addr = $this->setup['addr'];
        }
        
         
    }
   
 
 
 
    protected function send($api=null,$type = 'url',$data=null,$time=0){  
        if($type == 'url' && empty($api)){
            return '缺少Send参数1,api参数不能为空'; 
        }
        $api = preg_replace('/\n[^\S\n]*/i', "\n", $api);
        $queueData['plugin'] = $this->plugin; 
        $queueData['API_BOT'] = $this->tobot; 
        $queueData['type'] = $type; 
        $queueData['data'] = $data;
        $queueData['url']=$this->BOT['API_URL'].$this->BOT['API_TOKEN'].$api; 
        if($time > 0){
            Client::send('TG_queue',$queueData,$time); 
        }else{
            Client::send('TG_queue',$queueData);  
        }
        return true;
    } 
    
    
    protected function get($api=null){   
        if(empty($api)){ 
            return json(["code"=>0,"msg"=>"url地址不能为空"]);   
        } 
        $url =$this->BOT['API_URL'].$this->BOT['API_TOKEN'].$api; 
        try {
            $client = new Guzz_Client(['timeout' => 10,'http_errors' => false]);
            $res =json_decode($client->request('GET', $url)->getBody()->getContents(),true); 
            if(empty($res['ok'])){
                throw new \Exception("api请求失败：".$res['description']); 
            }
        } catch (\Throwable $e) {   
            throw new \Exception("请求Url失败".$e->getMessage());    
        } 
        return $res['result'];
    }
 
   
    protected function json(int $code, string $msg = 'ok', $data =null): Response{
        if(empty($this->BOT)){ 
            return json(["code"=>0,"msg"=>"请配置机器人数据"]);   
        }
        return json(['code' => $code, 'data' => $data, 'msg' => $msg]);
    }

}
