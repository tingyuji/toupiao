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

$incomeClass=new incomeClass();
$alipayClass=new alipayClass();
$profitClass=new profitClass();

$redis = new redis(); 
$redis->connect('127.0.0.1', 6379);

$items=$ordersClass->getAll4();
foreach ($items as $item) {
	$id=$item['id'];
  $pid=$item['pid'];
	$orderid=$item['orderid'];


  $openid=$item['openid'];
  $queue='queue-'.$openid; 

  echo $queue;
  echo "\n";

	$username=$item['username'];
	//$redis->set($queue,'0');

	$ordersClass->del($id);

  //20160711
  //20160804
  $redis->lPush('T-'.$pid,$orderid);


}




