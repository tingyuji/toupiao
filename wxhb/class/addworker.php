<?php
session_start();
//print_r($_POST);
//exit();
$newcode = isset($_POST['InviteCode']) ? $_POST['InviteCode'] : '';
$username = isset($_POST['Mobile']) ? $_POST['Mobile'] : '';


$password = isset($_POST['Password']) ? $_POST['Password'] : '';
$txtPassword1 = isset($_POST['Password']) ? $_POST['Password'] : '';



$name = isset($_POST['txtTrueName']) ? $_POST['txtTrueName'] : '';
$email = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : '';
$tel = isset($_POST['Mobile']) ? $_POST['Mobile'] : '';
$QQ = isset($_POST['txtQQ']) ? $_POST['txtQQ'] : '';

require_once 'class/worker.class.php';
$workerClass=new workerClass();


$total=$workerClass->getCount5($username);
if($total>0){
	$data=[];
	$data['Status']=0;
	$data['Message']='该用户名已经存在,请重试';
	$data['url']='';

}
if($total==0){
	$workerClass->add($username,$password,$name,$email,$tel,$QQ,$newcode);

	$data=[];
	$data['Status']=1;
	$data['Message']='注册成功,请登录';
	$data['RedirectUrl']='login.php';	
}


//$json=json_encode($data,JSON_UNESCAPED_UNICODE);
$json=json_encode($data);
echo $json;


?>