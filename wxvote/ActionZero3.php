<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/items.class.php';

$itemsClass= new itemsClass();


$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 


$items=$itemsClass->getAll();
foreach ($items as $item) {
    usleep(10000);

	$openid=$item['openid'];
	
	echo $openid;
	echo "\n";

	$queue='queue-'.$openid;	
	$redis->set($queue,'0'); 

	$time=time()+24*60*60;
	//$time=time()-20;
	$redis->set($openid,$time); 
}

echo date('Y-m-d H:i:s', time());
echo "\n";

echo '禁用用户操作处理';
echo "\n";





