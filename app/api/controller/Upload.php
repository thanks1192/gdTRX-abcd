<?php

namespace app\api\controller;

use support\Request;

use Shopwwi\WebmanAuth\Facade\Auth;#jwt https://www.workerman.net/plugin/24
use think\facade\Db;#mysql https://www.kancloud.cn/manual/think-orm/1258003
use think\facade\Cache;#Cache https://www.kancloud.cn/manual/thinkphp6_0/1037634
use Respect\Validation\Exceptions\ValidationException;#字符验证器捕获错误

use Webman\Push\Api; //push推送
use support\Redis;//redis缓存
use Gregwar\Captcha\CaptchaBuilder;#Captcha 验证码
use Webman\RedisQueue\Client; #redis queue 队列

use Casbin\WebmanPermission\Permission;#casbin权限
use Vectorface\GoogleAuthenticator;#谷歌验证

use Tinywan\Storage\Storage;
use Tinywan\Storage\Exception\StorageException;

class upload{  


    public function  index(Request $request){    
      $uid = $request->user->id;
      $bot = $request->user->remark;     
      $Coulumn = $request->user->roleId==3?"upid":"myid";
      $data = $request->post();  
      
         try {
             Storage::config();  
             $res = Storage::uploadFile(); 
             if(empty($res[0])){
                 return json(['code' =>4,'msg'=>"未知错误"  ]);  
             } 
             unset($res[0]['save_path']); 
             
             if(empty($res[0]['key']) || empty($data['type'])){ 
                return json(['code' =>0,'msg'=>"上传失败缺少群组数据"  ]);   
             }
             $bot_list = Db::name('bot_list')->where("plugin",$request->user->plugin)->where('API_BOT',$bot)->cache("{$request->user->plugin}_{$bot}")->find();
             
             switch ($data['type']) {
                 default: 
                     break;
                     
                 case 'bot_group_images':
                     Db::name('bot_group')->where('bot',$bot_list["API_BOT"])->where('plugin',$bot_list['plugin'])->where('groupid',$res[0]['key'])->update(["images"=>$bot_list['WEB_URL'].$res[0]['url']]); 
                     break; 
                 case 'bot_group_hyimg':  
                     Db::name('bot_group')->where('bot',$bot_list["API_BOT"])->where('plugin',$bot_list['plugin'])->where('groupid',$res[0]['key'])->update(["hyimg"=>$bot_list['WEB_URL'].$res[0]['url']]); 
                     break; 
                     
                 case 'commands':
                     Db::name('bot_commands')->where('bot',$bot_list["API_BOT"])->where('id',$res[0]['key'])->update(["photo"=>$bot_list['WEB_URL'].$res[0]['url']]); 
                     break; 
                     
             }
                
              
              
             return json(['code' =>1,'msg'=>"完成","data"=>$res[0]  ]);
             
         }catch (StorageException $e){ 
           return json(['code' =>4,'msg'=>$e->getMessage()  ]);
         }       
     }
     
   
     
}