<?php
session_start();
$username=$_SESSION['username'];

if(!isset($_SESSION['username'])){
    header("Location:index.php"); //重新定向到其他页面
    exit();
}


$pid = isset($_POST['pid']) ? intval($_POST['pid']) : '';
$num = isset($_POST['num']) ? intval($_POST['num']) : '';

require_once 'class/task.class.php';
$taskClass=new taskClass();

$items=$taskClass->getAll3($pid);

$price=$items[0]['price'];
$price2=$items[0]['price2'];


if($num<10){
	$data=array();
	$data['status']=0;
	$data['msg']='您好，单次发布任务最少10票！';
	$data['url']='add.php';

	$json=json_encode($data);
	echo $json;
	exit();
}

$amount=$price*$num;
require_once 'class/alipay.class.php';
$alipayClass=new alipayClass();
$total=$alipayClass->getCount3($username);

if($amount>$total){
	$data=array();
	$data['status']=1;
	$data['msg']='复制任务失败，余额不足，请及时充值';
	$data['url']='http://www.fangdan8.com/wxfb/wx.php';


	$json=json_encode($data);
	echo $json;	
	exit();
}





//$taskClass->add($type,$username,$wx,$title,$url,$img1,$img2,$price,$num,$onetime,$time1,$time2,$area,$xiansu,$minute,$intro,$memo);
$taskClass->copy($pid,$num);


$fee=(-1)*$price*$num;
$orderNo='';
$action='发布任务';
$remarks='';
$alipayClass->add($username,$fee,$orderNo,$action,$remarks);


$data=array();
$data['status']=1;
$data['msg']='提交成功';
$data['url']='list.php';

$json=json_encode($data);
echo $json;


?>