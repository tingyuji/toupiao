<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");



$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 

$items = $redis->keys('done-*'); 
foreach ( $items as $item) { 
  $redis->del($item);
}


echo '清理完成';
echo "\n";
