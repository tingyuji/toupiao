<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/task.class.php';
require_once 'class/append.class.php';



$taskClass=new taskClass();
$appendClass= new appendClass();


$items=$appendClass->getAll();
foreach ($items as $item) {

	echo '<pre>';
	print_r($item);


	$id=$item['id'];
	$pid=$item['pid'];

	$tItems=$taskClass->getAll3($pid);
	$tItem=$tItems[0];
	echo '<pre>';
	print_r($tItem);

	$username=$tItem['username'];
	$price=$tItem['price'];
	$appendClass->update($id,$username,$price);

	
}



