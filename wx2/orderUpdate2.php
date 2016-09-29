<?php
header("Content-Type:text/html;charset=utf-8");
setlocale(LC_ALL, 'zh_CN.utf-8');


require_once 'class/orders.class.php';


$orderid = isset($_POST['orderid']) ? $_POST['orderid'] : '';
$time = isset($_POST['orderDate']) ? $_POST['orderDate'] : '';

$orderDate=date("Y-m-d", $time);

$ordersClass=new ordersClass();


$ordersClass->update2($orderid,$orderDate);


echo '添加成功';