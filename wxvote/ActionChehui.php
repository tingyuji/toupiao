<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/ordersdone.class.php';
require_once 'class/images.class.php';



$ordersdoneClass=new ordersdoneClass();
$imagesClass=new imagesClass();


$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 


echo date("Y-m-d H:i:s");
echo "\n";

echo '撤回脚本启动';
echo "\n";


while (true) {

	sleep(2);
	echo date("Y-m-d H:i:s");
	echo "\n";
	$total=$redis->lsize("H");
	if($total==0){
		sleep(10);
	}
	
	if($total>0){
		$orderid=$redis->rPop('H');

		echo $orderid;
		echo "\n";

		$ordersdoneClass->del2($orderid);

		$imagesClass->del3($orderid);

		$id=substr($orderid,8,5);
		$id=intval($id);

		echo $id;
		echo "\n";
		$M=$redis->get('M-'.$id);


		$num1=$M+1;
		$num2=$M+2;

		$redis->set('M-'.$id, $num1);

		$pid=str_pad($id,5,'0',STR_PAD_LEFT);
		for($i=$num1;$i<$num2;$i++){

			
			$sortcode = str_pad($i,5,'0',STR_PAD_LEFT);
			$orderid=date('Ymd').str_pad($id,5,'0',STR_PAD_LEFT).$sortcode;
			//$queueClass->add($pid,$sortcode,$orderid);

			echo $orderid;
			echo "\n";
			$redis->lPush('T-'.$id, $orderid);
		}

	}



}


echo '初始化完成';
echo "\n";
