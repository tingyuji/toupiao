<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/alipay.class.php';
require_once 'class/append.class.php';



$alipayClass=new alipayClass();
$appendClass= new appendClass();

$action='追加任务';
$alipayClass->del3($action);

$items=$appendClass->getAll();
foreach ($items as $item) {

	echo '<pre>';
	print_r($item);

	$username=$item['username'];
	$fee=$item['fee'];
	$createTime=$item['createTime'];


	$fee=(-1)*$fee;
	
	$action='追加任务';
	$status='已确认';
	$alipayClass->add5($username,$fee,$action,$status,$createTime);

	
}













