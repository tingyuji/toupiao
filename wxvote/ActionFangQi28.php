<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/orders.class.php';
require_once 'class/queue.class.php';


$ordersClass=new ordersClass();
$queueClass=new queueClass();

$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 

$status='已放弃';
while (true) {

	sleep(1);
	echo date("Y-m-d H:i:s");
	echo "\n";
	$orderid=$redis->rPop('N');
	if($orderid){
		
		//$ordersClass->update($orderid,$status);

		//$ordersClass->del3($orderid);

		//201608010546101592
		//01234567890
		$id=substr($orderid,8,5);
		$id=intval($id);
		echo $orderid;
		echo "\n";
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
