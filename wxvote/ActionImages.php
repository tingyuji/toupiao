<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/images.class.php';



$imagesClass=new imagesClass();


$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 

while (true) {

	usleep(100000);
	echo date("Y-m-d H:i:s");
	echo "\n";
		
	$images=$redis->rPop('images');
	if($images){
		$arr=explode("#",$images);
		$pid=$arr[0];
		$orderid=$arr[1];
		$openid=$arr[2];
		$targetName=$arr[3];
		$PicUrl=$arr[4];

		print_r($arr);
		echo "\n";

		$imagesClass->add2($openid,$pid,$orderid,$targetName,$PicUrl);

		//$redis->lPush('images', $pid.'#'.$orderid.'#'.$openid.'#'.$targetName.'#'.$PicUrl);		
	}


}





echo '初始化完成';
echo "\n";
