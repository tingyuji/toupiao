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


$items=$ordersClass->getAll11();
foreach ($items as $item) {
	$id=$item['id'];
	$orderid=$item['orderid'];
	$status='已审核';
	$data='审核通过';
	$ordersClass->update2($id,$status,$data);

	$status='已确认';
	$alipayClass->update($orderid,$status);
}


$data=array();
$data['success']=1;
$data['msg']='处理成功';

$json=json_encode($data);
echo $json;

