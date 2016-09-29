<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/orders.class.php';



$ordersClass=new ordersClass();


$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 

$status='已完成';
while (true) {
	usleep(100);
	echo date("Y-m-d H:i:s");
	echo "\n";
	
	$orderid=$redis->rPop('K');
	if($orderid){
		
		$ordersClass->update($orderid,$status);
				
	}


}


echo '初始化完成';
echo "\n";
