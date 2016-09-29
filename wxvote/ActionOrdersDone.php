<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/ordersdone.class.php';



$ordersdoneClass=new ordersdoneClass();


$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 
while (true) {
	usleep(100000);
	echo date("Y-m-d H:i:s");
	echo "\n";
	$orders=$redis->rPop('done');
	if($orders){
		$arr=explode("#",$orders);
		$pid=$arr[0];
		$orderid=$arr[1];
		$openid=$arr[2];

		print_r($arr);
		echo "\n";

		$ordersdoneClass->add($openid,$pid,$orderid);
				
	}else{
		sleep(2);
	}


}


echo '初始化完成';
echo "\n";
