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
$items=$deltaClass->getAll18($data);
foreach ($items as $item) {

	$orderid=$item['orderid'];
	$username=$item['username'];
	$complainClass->update5($orderid,$username);

	
}













