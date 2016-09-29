<?php
header("Content-Type:text/html;charset=utf-8");
setlocale(LC_ALL, 'zh_CN.utf-8');


require_once 'class/orders.class.php';
require_once 'class/memo.class.php';
require_once 'class/orderItems.class.php';


$arrItems = isset($_POST['arrItems']) ? $_POST['arrItems'] : '';


$orderid = isset($_POST['orderid']) ? $_POST['orderid'] : '';
$fee = isset($_POST['fee']) ? $_POST['fee'] : '';


$name = isset($_POST['name']) ? $_POST['name'] : '';
$female = isset($_POST['female']) ? $_POST['female'] : '';
$addr = isset($_POST['addr']) ? $_POST['addr'] : '';
$birthday = isset($_POST['orderid']) ? $_POST['birthday'] : '';


$ordersClass=new ordersClass();
$ordersClass->update($orderid,$fee);

$memoClass=new memoClass();
$memoClass->add($orderid,$name,$female,$addr,$birthday);

$arr=explode("|",$arrItems);
$orderItemsClass=new orderItemsClass();
foreach ($arr as $items) {
	$arrItem=explode("￥",$items);
	$name=$arrItem[0];
	$price=$arrItem[1];
	$orderItemsClass->add($orderid,$name,$price);

}


echo '添加成功';