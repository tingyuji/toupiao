<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");
$orderid = isset($_POST['orderid']) ? $_POST['orderid'] : '';

require_once 'class/orders.class.php';
require_once 'class/images.class.php';
require_once 'class/items.class.php';

$ordersClass= new ordersClass();
$imagesClass= new imagesClass();
$itemsClass= new itemsClass();


$ordersClass->update2($orderid);
$imagesClass->update2($orderid);

$items=$ordersClass->getAll18($orderid);
$openid=$items[0]['openid'];

$itemsClass->add($openid,$orderid);



$data["rows"] = array();   
$json= json_encode($items); 
echo $json; 
?>