<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/mapping.class.php';

$mappingClass= new mappingClass();


$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 


$items=$mappingClass->getAll();
foreach ($items as $item) {
    usleep(10000);
	
	$openid=$item['wxusername'];
	$queue='queue-'.$openid;
	echo $openid;
	echo "\n";
	
	
	$redis->set($queue,'0'); 
}




