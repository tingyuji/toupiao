<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");


require_once 'class/orders.class.php';
$ordersClass= new ordersClass();

$pid=158;
$items=$ordersClass->getAll11($pid);


foreach ($items as $item) {

	$id=$item['id'];
	$imgfile=$item['imgfile'];
	$url='http://7xsomq.com2.z0.glb.clouddn.com/'.$imgfile;
	echo $url;
	echo '<br>';



}


