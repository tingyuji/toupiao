<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/task.class.php';
require_once 'class/orders.class.php';
require_once 'class/problem.class.php';

require_once 'class/income.class.php';
require_once 'class/alipay.class.php';
require_once 'class/profit.class.php';
require_once 'class/worker.class.php';
require_once 'class/mapping.class.php';


$taskClass=new taskClass();
$ordersClass= new ordersClass();
$problemClass= new problemClass();

$mappingClass= new mappingClass();
$workerClass=new workerClass();


/*
$items=$ordersClass->getAll10();

foreach ($items as $item){
  $username=$item['username'];
  $orderCount=$item['sum'];
  $mappingClass->update5($username,$orderCount);
}



$items=$problemClass->getAll2();

foreach ($items as $item){
  $id=$item['pid'];
  $sum=$item['sum'];
  $taskClass->update2($id,$sum);
}
*/

$incomeClass=new incomeClass();
$alipayClass=new alipayClass();
$profitClass=new profitClass();

$redis = new redis(); 
$redis->connect('127.0.0.1', 6379);

$items=$ordersClass->getAll4();
foreach ($items as $item) {
	$id=$item['id'];
	$orderid=$item['orderid'];
	$username=$item['username'];
	$redis->set($username,'0');

	$ordersClass->del($id);


}


$status='未上传';
$items=$ordersClass->del2($status);


$status='已放弃';
$items=$ordersClass->del2($status);


