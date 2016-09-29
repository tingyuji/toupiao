<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");


require_once 'class/orders.class.php';

$ordersClass= new ordersClass();



$status='已放弃';
$items=$ordersClass->del5();


