<?php
header("Content-Type:text/html;charset=utf-8");
setlocale(LC_ALL, 'zh_CN.utf-8');


require_once 'class/orders.class.php';


$ordersClass=new ordersClass();

$hCode=$ordersClass->makeorderid();
echo $hCode;