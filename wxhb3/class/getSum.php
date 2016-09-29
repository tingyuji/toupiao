<?php
header("Content-Type:text/html;charset=utf-8");
setlocale(LC_ALL, 'zh_CN.utf-8');

session_start();
$username=$_SESSION['username'];

require_once 'class/alipay.class.php';
$alipayClass = new alipayClass();
$sum=$alipayClass->getAll4();
$fee=[];
foreach ($items as $item) {
	$username=$item['username'];
	$sum=$item['sum'];
	$fee[$username]=$sum;
}

//$data=[];
//$data['sum']=$sum;
//$json= json_encode($data); 

$json=json_encode($fee);
echo $json; 