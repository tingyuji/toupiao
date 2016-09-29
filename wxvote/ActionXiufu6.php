<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/task.class.php';
require_once 'class/alipay.class.php';
require_once 'class/delta.class.php';
require_once 'class/complain.class.php';


$alipayClass=new alipayClass();
$taskClass= new taskClass();
$deltaClass= new deltaClass();
$complainClass = new complainClass();



$data='投诉扣款';
$items=$complainClass->getAll();
foreach ($items as $item) {
	$orderid=$item['orderNo'];
	$deltaClass->update6($orderid,$data);
}

exit();

$day='2016-05-28';
$items=$deltaClass->getAll18($day);
foreach ($items as $item) {

	$orderid=$item['orderid'];
	$username=$item['username'];
	$complainClass->update5($orderid,$username);

	
}













