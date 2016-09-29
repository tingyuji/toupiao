<?php


$pid = isset($_POST['pid']) ? $_POST['pid'] : '';
$orderid = isset($_POST['orderid']) ? $_POST['orderid'] : '';

$memo = isset($_POST['con']) ? $_POST['con'] : '';
$zdy = isset($_POST['zdy']) ? $_POST['zdy'] : '';



session_start();
$username=$_SESSION['username'];
require_once 'class/problem.class.php';
require_once 'class/orders.class.php';

$order=new ordersClass();
$items=$order->getAll6($pid,$orderid);

$item=$items[0];
$username2=$item['username'];
$title=$item['title'];
$imgfile=$item['imgfile'];

$problemClass=new problemClass();
$total=$problemClass->getCount3($orderid);
if($total==0){
	$problemClass->add2($pid,$orderid,$title,$imgfile,$memo,$zdy,$username,$username2);

	$data=[];
	$data['status']=1;
	$data['msg']='投诉成功';
	$data['url']='showWork.php?pid='.$pid;	
}
if($total>0){
	$data=[];
	$data['status']=0;
	$data['msg']='投诉已经提交,不能多次提交';
	$data['url']='showWork.php?pid='.$pid;		
}

$json=json_encode($data);
echo $json;


?>