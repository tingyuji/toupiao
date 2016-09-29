<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/task.class.php';
require_once 'class/orders.class.php';
require_once 'class/ordersdone.class.php';

$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 

$time=date('Y-m-d H:i:s');
echo $time;
echo "\n";
$taskClass=new taskClass();
$ordersClass= new ordersClass();
$ordersdoneClass= new ordersdoneClass();

$items=$taskClass->getAll10();

foreach ($items as $item){
	$pid=$item['id'];
	$sum=$ordersClass->getCount2($pid);
	$taskClass->update($pid,$sum);

	$sum=$ordersdoneClass->getCount2($pid);
	$taskClass->update8($pid,$sum);

}

$status='执行中';
$items=$taskClass->getAll11($status);

foreach ($items as $item) {
	$id=$item['id'];
	$num=$item['num'];
	$complete=$item['complete'];
	$done=$item['done'];
	$status=$item['status'];

	if(($status=='执行中')&&($done>=$num)){
		$status='已完成';
		$taskClass->update3($id,$status);

		$redis->sRem('doing', $id);
	}
	if(($status=='已完成')&&($done<$num)){
		$status='执行中';
		$taskClass->update3($id,$status);

		$redis->sAdd('doing' , $id);
	}	
}



