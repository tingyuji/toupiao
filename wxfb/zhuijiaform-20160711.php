<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/user.class.php';

$id = isset($_POST['id']) ? intval($_POST['id']) : '';
$type = isset($_POST['type']) ? $_POST['type'] : '';
$num = isset($_POST['num']) ? intval($_POST['num']) : '';


session_start();
$username=$_SESSION['username'];
	
require_once 'class/task.class.php';
$taskClass=new taskClass();

$items=$taskClass->getAll3($id);
$username2=$items[0]['username'];

if($username!=$username2){
    header("Location:index.php"); //重新定向到其他页面
    exit();
}


require_once 'class/alipay.class.php';
$alipayClass=new alipayClass();



$price  =0.13;
$price2 =0.12;

if($type=='MP'){
	$price=0.12;
}
$amount=$price*$num;
require_once 'class/alipay.class.php';
$alipayClass=new alipayClass();
$total=$alipayClass->getCount3($username);

if($amount>$total){
	$data=array();
	$data['status']=1;
	$data['msg']='追加失败，余额不足';
	$data['url']='note2.php';


	$json=json_encode($data);
	echo $json;	
	exit();
}


$status='执行中';
$taskClass->update10($id,$num,$status);

$fee=(-1)*$price*$num;
$orderNo='';
$action='追加任务';
$remarks='';
$alipayClass->add($username,$fee,$orderNo,$action,$remarks);



require_once 'class/history.class.php';
$historyClass=new historyClass();
$pid=$id;
$action='追加';


$historyClass->add($username,$pid,$action,$fee);




$data=array();
$data['status']=1;
$data['msg']='追加成功';
$data['url']='mywork.php';


$json=json_encode($data);
echo $json;	



?>