<?php

namespace app\command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

// use GuzzleHttp\Pool;
// use GuzzleHttp\Client as Guzz_Client;
// use GuzzleHttp\Psr7\Request as Guzz_Request; 
// use GuzzleHttp\Promise as Guzz_Promise;

// use TNTma\TronWeb\Address;
// use TNTma\TronWeb\Account;
// use TNTma\TronWeb\Tron; 

use support\Redis;//redis缓存 
use think\facade\Db;


class deldata extends Command{
    protected static $defaultName = 'deldata';
    protected static $defaultDescription = '清理出干净数据库';

 
    protected function execute(InputInterface $input, OutputInterface $output){    
        $sql = "
        DELETE FROM `tb_bot_vip_paylog`; 
        alter table `tb_bot_vip_paylog` auto_increment =1; 
        DELETE FROM `tb_bot_vip_setup`; 
        alter table `tb_bot_vip_setup` auto_increment =1; 
        DELETE FROM `tb_bot_vip_userlist`; 
        alter table `tb_bot_vip_userlist` auto_increment =1; 
        DELETE FROM `tb_trx_setup`; 
        alter table `tb_trx_setup` auto_increment =1; 
        DELETE FROM `tb_bot_xufei_log`; 
        alter table `tb_bot_xufei_log` auto_increment =1; 
        DELETE FROM `tb_bot_group_user`;
        alter table `tb_bot_group_user` auto_increment =1; 
        DELETE FROM `tb_bot_list`;
        alter table `tb_bot_list` auto_increment =1; 
        DELETE FROM `tb_bot_group`;
        alter table `tb_bot_group` auto_increment =1; 
        DELETE FROM `tb_bot_total_tg`;
        alter table `tb_bot_total_tg` auto_increment =1; 
        DELETE FROM `tb_keep_log`;
        alter table `tb_keep_log` auto_increment =1; 
        DELETE FROM `tb_keep_logc`;
        alter table `tb_keep_logc` auto_increment =1; 
        DELETE FROM `tb_keep_setup`;
        alter table `tb_keep_setup` auto_increment =1; 
        DELETE FROM `tb_keep_total`;
        alter table `tb_keep_total` auto_increment =1; 
        DELETE FROM `tb_keep_totalz`;
        alter table `tb_keep_totalz` auto_increment =1;  
        DELETE FROM `tb_keep_user`;
        alter table `tb_keep_user` auto_increment =1;
        DELETE FROM `tb_bot_channel`;
        alter table `tb_bot_channel` auto_increment =1;
        DELETE FROM `tb_bot_commands`;
        alter table `tb_bot_commands` auto_increment =1;
        DELETE FROM `tb_bot_markup`;
        alter table `tb_bot_markup` auto_increment =1;
        DELETE FROM `tb_bot_total_h`;
        alter table `tb_bot_total_h` auto_increment =1;
        DELETE FROM `tb_bot_total_d`;
        alter table `tb_bot_total_d` auto_increment =1;
        DELETE FROM `sys_theme`;
        alter table `sys_theme` auto_increment =1; 
        DELETE FROM `tb_account` WHERE `id` >100003;
        alter table `tb_account` auto_increment =100004; 
        DELETE FROM `tb_bot_log_jie`;
        alter table `tb_bot_log_jie` auto_increment =1;
        DELETE FROM `tb_bot_log_sunswap`;
        alter table `tb_bot_log_sunswap` auto_increment =1;
        DELETE FROM `tb_account_tg`;
        alter table `tb_account_tg` auto_increment =1;
        DELETE FROM `tb_bot_usdt_list`;
        alter table `tb_bot_usdt_list` auto_increment =1;
        ";  
        
        $sql_query = splitSqlFile($sql, ';');
         foreach ($sql_query as $sql) { 
             Db::query($sql);
             $output->writeln("\033[0;32m{$sql}\033[0m");
         }   
         $output->writeln("\n\033[1;33m数据库清理成功！\033[0m\n");
         
         
        shell_exec("rm -rf ".run_path() . DIRECTORY_SEPARATOR ."runtime/cache");
        $output->writeln("\033[1;33m缓存文件清理成功！\033[0m\n");
        shell_exec("rm -rf ".run_path() . DIRECTORY_SEPARATOR ."runtime/*.lock");
        $output->writeln("\033[1;33m安装文件清理成功！\033[0m\n");
        
        Redis::del("blockLoad"); 
        Redis::del("group_adtext"); 
        Redis::del("{redis-queue}-failed"); 
        $output->writeln("\033[1;33mRedis数据清理成功！\033[0m\n");  
        
        shell_exec("rm -rf ".run_path() . DIRECTORY_SEPARATOR ."vendor"); 
        $output->writeln("\033[1;33m依赖目录vendor清理成功！\033[0m\n");
        
        $output->writeln("\033[1;32m请重新运行启动项目命令：docker compose up \033[0m\n"); 
        return self::SUCCESS;
    }

}
