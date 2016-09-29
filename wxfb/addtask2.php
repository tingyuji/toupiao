<?php
session_start();
$username=$_SESSION['username'];

if(!isset($_SESSION['username'])){
    header("Location:index.php"); //重新定向到其他页面
    exit();
}

$type = '普通任务';
$title = isset($_POST['title']) ? $_POST['title'] : '';
$url = isset($_POST['url']) ? $_POST['url'] : '';


$num = isset($_POST['num']) ? intval($_POST['num']) : '';

$img1 = isset($_POST['img1']) ? $_POST['img1'] : '';

$img2 = isset($_POST['img2']) ? $_POST['img2'] : '';

$memo = isset($_POST['memo']) ? $_POST['memo'] : '';


$title=filter($title);

$img1=filter($img1);
$img2=filter($img2);


$memo=filter($memo);

if($num<10){
	$url='http://www.fangdan8.com/wxfb/note1.php';
	header('Location:'.$url);
	exit();
}

$amount=0.14*$num;
require_once 'class/alipay.class.php';
$alipayClass=new alipayClass();
$total=$alipayClass->getCount3($username);

if($amount>$total){
	$url='http://www.fangdan8.com/wxfb/note2.php';
	header('Location:'.$url);
	exit();
}


require_once 'class/task.class.php';
$taskClass=new taskClass();
$price1=0.14;
$price2=0.12;

$taskClass->add5($type,$username,$title,$url,$num,$img1,$img2,$price1,$price2,$memo);


$fee=(-1)*0.14*$num;
$orderNo='';
$action='发布任务';
$remarks='';
$alipayClass->add($username,$fee,$orderNo,$action,$remarks);

$data=array();
$data['status']=1;
$data['msg']='提交成功';
$data['url']='index2.php';

$json=json_encode($data);
echo $json;

$url='http://www.fangdan8.com/wxfb/task.php';
header('Location:'.$url);
exit();


function filter($value) {
	$sql = array('drop','select', 'insert', 'update', 'delete' );
	$sql_re = array('','','','','');
	return str_ireplace($sql, $sql_re, $value);
}
?>
