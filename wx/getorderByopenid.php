<?php
header("Content-Type:text/html;charset=utf-8");
setlocale(LC_ALL, 'zh_CN.utf-8');


require_once 'class/orders.class.php';

$openid = isset($_POST['openid']) ? $_POST['openid'] : '';


$ordersClass=new ordersClass();

$total=$ordersClass->getCount5($openid);
$items=$ordersClass->getAll2($openid);

$result["total"] = $total;  
$result["rows"] = $items;   
$jsonresult= json_encode($result); 
echo $jsonresult; 