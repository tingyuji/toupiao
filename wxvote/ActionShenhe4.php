<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");


require_once 'class/delta.class.php';
require_once 'class/alipay.class.php';


$deltaClass= new deltaClass();
$alipayClass=new alipayClass();


$status='已完成';
$items=$deltaClass->getAll15($status);
foreach ($items as $item) {
	$id=$item['id'];
	$orderid=$item['orderid'];
	$username=$item['username'];
	$status='已审核';
	$data='审核通过';
	$deltaClass->update2($id,$status,$data);


	$action='平台收益';
	$status='已确认';
	$fee=0.12;
	$status='已确认';
	$alipayClass->add6($username,$orderid,$fee,$action,$status);

}

