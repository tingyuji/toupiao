<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

session_start();
$username=$_SESSION['username'];

if(!isset($_SESSION['username'])){
    header("Location:index.php"); //重新定向到其他页面
    exit();
}

$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 



$orderid = isset($_POST['orderid']) ? $_POST['orderid'] : '';

$redis->lPush('XXOO', $orderid);

require_once 'class/orders.class.php';
require_once 'class/images.class.php';

$ordersClass= new ordersClass();
$imagesClass= new imagesClass();

$ordersClass->update2($orderid);
$imagesClass->update2($orderid);



$data["rows"] = array();   
$json= json_encode($items); 
echo $json; 
?>