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
 


class del extends Command{
    protected static $defaultName = 'del';
    protected static $defaultDescription = '删除数据库 - 便于重新安装项目';

 
    protected function execute(InputInterface $input, OutputInterface $output){   
        
        try {
            $dsn = "mysql:host=".getenv('DB_HOST').";port=".getenv('DB_PORT').";";
            $params = [
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8mb4",
                    \PDO::ATTR_EMULATE_PREPARES => false,
                    \PDO::ATTR_TIMEOUT => 5,
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                ]; 
            $DB = new \PDO($dsn, getenv('DB_USER'), getenv('DB_PASSWORD'), $params); 
            
            $DB->exec("DROP DATABASE `".getenv('DB_NAME')."`");
            
        } catch (\Throwable $e) { 
           $output->writeln("\n\033[1;31m".$e->getMessage()."\033[0m\n");  
        }
        
        $output->writeln("\n\033[1;31m数据库删除成功！\033[0m\n"); 
        
        shell_exec("rm -rf ".run_path() . DIRECTORY_SEPARATOR ."runtime");   
        shell_exec("rm -rf ".run_path() . DIRECTORY_SEPARATOR ."vendor"); 
        
        $output->writeln("\n\033[1;33m1.请重新建个数据库,并修改.env文件内的数据库配置信息\033[0m\n");  
        $output->writeln("\033[1;32m2.然后重新运行安装项目命令：docker compose up \033[0m\n"); 
        return self::SUCCESS;
    }

}
