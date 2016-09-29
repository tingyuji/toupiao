<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/alipay.class.php';
$alipayClass=new alipayClass();


require_once 'class/task.class.php';
$taskClass=new taskClass();

require_once 'class/orders.class.php';
$ordersClass=new ordersClass();

require_once 'class/history.class.php';
$historyClass=new historyClass();


$items=$taskClass->getAll8();
foreach ($items as $item) {
	$pid=$item['id'];
	$sum=$ordersClass->getCount2($pid);   
    $taskClass->update($pid,$sum);

    $sum=$ordersClass->getCount4($pid);
    $taskClass->update8($pid,$sum);
}




$items=$taskClass->getAll8();
foreach ($items as $item) {
	$id=$item['id'];
	$username=$item['username'];
	$price=$item['price'];
	$num=$item['num'];
	$complete=$item['complete'];

	$fee=$price*($num-$complete);
	$orderNo='';
	$action='终止任务返现';
	$status='已确认';
	$remarks='';
	$alipayClass->add4($username,$fee,$orderNo,$action,$status,$remarks);	
	

	$action='终止任务返现';
	$historyClass->add($username,$id,$action,$fee);


	$taskClass->update7($id);
}







$now=date('Y-m-d H:i:s');
echo $now;
echo "\n";


?>