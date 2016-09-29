<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/orders.class.php';
require_once 'class/ordersdone.class.php';



$ordersClass=new ordersClass();
$ordersdoneClass=new ordersdoneClass();


$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 

$status='已完成';
while (true) {
	//usleep(100000);
	echo date("Y-m-d H:i:s");
	echo "\n";
	
	$orderid=$redis->rPop('K');
	if($orderid){
		
		$ordersClass->update($orderid,$status);
		$ordersdoneClass->add($orderid);
		exit();
				
	}else{
		sleep(2);
	}


}


echo '初始化完成';
echo "\n";
