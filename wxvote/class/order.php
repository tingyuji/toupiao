<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");


require_once 'class/orders.class.php';


$ordersClass= new ordersClass();

$total=$ordersClass->getCount4();
if($total==0){
	echo '没有新订单';
}
session_start();//初始化session
$fee=$_SESSION['fee'];
$username=$_SESSION['username'];
if($total>0){
	$items=$ordersClass->getAll2();	
	$item=$items[0];
	$orderid=$item['orderid'];
	$ordersClass->update3($orderid,$username);
	echo '接单成功';
}


?>