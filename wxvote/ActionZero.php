<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/mapping.class.php';

$mappingClass= new mappingClass();


$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 

$time=time();
$items=$mappingClass->getAll();
foreach ($items as $item) {
        usleep(10000);
	$username=$item['username'];
	$openid=$item['wxusername'];
	echo $username;
	echo "\n";
	
	//$redis->set($username,"0"); 
	$redis->set($openid,$time); 
}




