<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");



require_once 'class/alipay.class.php';
$alipayClass=new alipayClass();


require_once 'class/task.class.php';
$taskClass=new taskClass();

require_once 'class/orders.class.php';
$ordersClass=new ordersClass();

require_once 'class/ordersdone.class.php';
$ordersdoneClass=new ordersdoneClass();


require_once 'class/history.class.php';
$historyClass=new historyClass();


$items=$taskClass->getAll38();
foreach ($items as $item) {
	$id=$item['id'];
	$total=$ordersdoneClass->getCount3($id);
	$taskClass->update28($id,$total);
}

$items=$taskClass->getAll38();
foreach ($items as $item) {
	$id=$item['id'];
	$username=$item['username'];
	$price=$item['price'];
	$num2=$item['num2'];

	$fee=$price*$num2;
	$orderNo='';
	$action='投诉返现';
	$status='已确认';
	$remarks='';
	$alipayClass->add4($username,$fee,$orderNo,$action,$status,$remarks);	
	

	$action='投诉返现';
	$historyClass->add($username,$id,$action,$fee);


	$taskClass->update38($id);
}







$now=date('Y-m-d H:i:s');
echo $now;
echo "\n";


?>
