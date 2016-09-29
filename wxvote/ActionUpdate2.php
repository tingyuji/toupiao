<?php
header("Content-Type:text/html;charset=utf-8");
setlocale(LC_ALL, 'zh_CN.utf-8');
ini_set("memory_limit","-1");

require_once 'class/delta.class.php';
require_once 'class/problem.class.php';

require_once 'class/alipay.class.php';


$deltaClass=new deltaClass();
$problemClass=new problemClass();
$alipayClass=new alipayClass();


$items=$deltaClass->getAll16();
foreach ($items as $item) {

	$orderid=$item['orderid'];
	$username=$item['username'];

	$problemClass->update3($orderid,$username);
	$alipayClass->update5($orderid,$username);

}

echo date('Y-m-d H:i:s', time());
echo "\n";

echo '更新每个用户的完成任务数量。';
echo "\n";