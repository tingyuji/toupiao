<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/task.class.php';
require_once 'class/orders.class.php';

$time=date('Y-m-d H:i:s');
echo $time;
echo "\n";
$taskClass=new taskClass();
$ordersClass= new ordersClass();

$items=$ordersClass->getAll9();

foreach ($items as $item){
  $id=$item['pid'];
  $sum=$item['sum'];
  $taskClass->update($id,$sum);
}

$items=$taskClass->getAll();
foreach ($items as $item) {
	$id=$item['id'];
	$num=$item['num'];
	$complete=$item['complete'];
	$status=$item['status'];

	$diff=$num-$complete;
	if($diff<5){
		$time=60;
		$taskClass->update5($id,$times);
	}


	if(($status=='执行中')&&($complete>=$num)){
		$status='已完成';
		$taskClass->update3($id,$status);
	}
	if(($status=='已完成')&&($complete<$num)){
		$status='执行中';
		$taskClass->update3($id,$status);
	}	
}



