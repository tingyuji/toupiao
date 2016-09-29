<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/task.class.php';
require_once 'class/alipay.class.php';



$alipayClass=new alipayClass();
$taskClass= new taskClass();

$action='终止任务返现';
$alipayClass->del3($action);


$status='用户终止';
$items=$taskClass->getAll7($status);
foreach ($items as $item) {

	echo '<pre>';
	print_r($item);

	$username=$item['username'];
	
	$price=$item['price'];

	$num=$item['num'];
	$complete=$item['complete'];
	$createTime=$item['createTime'];

	$fee=$price*($num-$complete);

	
	$action='终止任务返现';
	$status='已确认';
	$alipayClass->add5($username,$fee,$action,$status,$createTime);

	
}













