<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/problem.class.php';
require_once 'class/images.class.php';


$problemClass=new problemClass();
$imagesClass= new imagesClass();


$status='投诉';
$items=$problemClass->getAll5();
foreach ($items as $item) {

	$orderid=$item['oid'];
	$imagesClass->update8($orderid,$status);

	
}













