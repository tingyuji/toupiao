<?php
header("Content-Type:text/html;charset=utf-8");
setlocale(LC_ALL, 'zh_CN.utf-8');


require_once 'class/orders.class.php';


$orderid = isset($_POST['orderid']) ? $_POST['orderid'] : '';
$orderTime = isset($_POST['orderTime']) ? $_POST['orderTime'] : '';


$ordersClass=new ordersClass();


$ordersClass->update3($orderid,$orderTime);




echo '添加成功';