<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/orders.class.php';



$ordersClass=new ordersClass();


$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 

$status='已放弃';
while (true) {

	//usleep(100000);
	echo date("Y-m-d H:i:s");
	echo "\n";
	$orderid=$redis->rPop('N');
	if($orderid){
		
		//$ordersClass->update($orderid,$status);

		$ordersClass->del3($orderid);
				
	}


}


echo '初始化完成';
echo "\n";
