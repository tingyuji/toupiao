<?php
header("Content-Type:text/html;charset=utf-8");
setlocale(LC_ALL, 'zh_CN.utf-8');


require_once 'class/orders.class.php';


$orderid = isset($_POST['orderid']) ? $_POST['orderid'] : '';
$openid = isset($_POST['openid']) ? $_POST['openid'] : '';


$ordersClass=new ordersClass();


$ordersClass->add($openid,$orderid);




echo '添加成功';