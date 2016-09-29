<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");


require_once 'class/orders.class.php';
require_once 'class/alipay.class.php';


$ordersClass= new ordersClass();
$alipayClass=new alipayClass();


$status='已完成';
$items=$ordersClass->getAll15($status);
foreach ($items as $item) {
	$id=$item['id'];
	$orderid=$item['orderid'];
	$username=$item['username'];
	$status='已审核';
	$data='审核通过';
	$ordersClass->update2($id,$status,$data);


	$action='平台收益';
	$status='已确认';
	$fee=0.15;
	$status='已确认';
	$alipayClass->add6($username,$orderid,$fee,$action,$status);

}

