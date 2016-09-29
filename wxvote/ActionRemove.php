<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");



$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 

/*
$items = $redis->keys('done-*'); 
foreach ( $items as $item) { 
	echo $item;
	echo "\n";
  $redis->del($item);
}


$items = $redis->keys('img-*'); 
foreach ( $items as $item) { 
	echo $item;
	echo "\n";
  $redis->del($item);
}

*/

$items = $redis->keys('done-*'); 
foreach ( $items as $item) { 
	echo $item;
	echo "\n";
  $redis->sRem($item, '10013');
  $redis->sRem($item, '10018');
  $redis->sRem($item, '10019');
  $redis->sRem($item, '10023');

}


echo '清理完成';
echo "\n";
