<?php
header("Content-Type:text/html;charset=utf-8");
setlocale(LC_ALL, 'zh_CN.utf-8');


require_once 'class/orders.class.php';


$orderid = isset($_POST['orderid']) ? $_POST['orderid'] : '';
$status = isset($_POST['status']) ? $_POST['status'] : '';



$ordersClass=new ordersClass();

$ordersClass->update4($orderid,$status);




echo '添加成功';