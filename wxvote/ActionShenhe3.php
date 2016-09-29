<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");


require_once 'class/orders.class.php';
require_once 'class/alipay.class.php';


$ordersClass= new ordersClass();
$alipayClass=new alipayClass();



$items=$alipayClass->getAll5();
foreach ($items as $item) {
	$orderid=$item['orderNo'];
	$status='已审核';
	$data='投诉扣款';
	$ordersClass->update3($orderid,$status,$data);

}


$data=array();
$data['success']=1;
$data['msg']='处理成功';

$json=json_encode($data);
echo $json;

