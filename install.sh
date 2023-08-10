if [ ! -f "./vendor/autoload.php" ]; then 
  echo "更新composer版本"
  composer self-update 2.5.5
  echo "\n当前composer版本号："
  composer --version 
  echo "\n开始安装docker依赖包"
  composer install
fi