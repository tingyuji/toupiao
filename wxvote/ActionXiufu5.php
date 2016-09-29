<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/task.class.php';
require_once 'class/alipay.class.php';
require_once 'class/orders.class.php';



$alipayClass=new alipayClass();
$taskClass= new taskClass();
$ordersClass= new ordersClass();


$pid=1136;
$items=$ordersClass->getAll1($pid);
foreach ($items as $item) {

	$orderid=$item['orderid'];
	$fee=0.80;
	$alipayClass->update4($orderid,$fee);

	
}













