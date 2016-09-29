<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/orders.class.php';



$ordersClass=new ordersClass();


$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 
while (true) {
	sleep(1);
	echo date("Y-m-d H:i:s");
	echo "\n";

	$orders=$redis->rPop('orders');
	if($orders){
		$arr=explode("#",$orders);
		$pid=$arr[0];
		$orderid=$arr[1];
		$openid=$arr[2];

		print_r($arr);
		echo "\n";


		$title='';
		$ordersClass->add3($openid,$orderid,$pid,$title);


		//$redis->lPush('orders', $pid.'#'.$orderid.'#'.$openid);
				
	}


}


echo '初始化完成';
echo "\n";
