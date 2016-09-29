<?php

//print_r($_POST);
//exit();
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$repassword = isset($_POST['repassword']) ? $_POST['repassword'] : '';

$inviteCode = isset($_POST['txtCode']) ? $_POST['txtCode'] : '';

$username=filter($username);
$password=filter($password);
$repassword=filter($repassword);
$inviteCode=filter($inviteCode);



$name = isset($_POST['txtTrueName']) ? $_POST['txtTrueName'] : '';
$email = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : '';
$tel = isset($_POST['txtMobile']) ? $_POST['txtMobile'] : '';
$QQ = isset($_POST['txtQQ']) ? $_POST['txtQQ'] : '';

if($password!=$repassword){
	$data=array();
	$data['status']=1;
	$data['msg']='两次输入密码不一致，请重新输入';
	$data['url']='note6.php';	
    $url='note6.php';
    header('Location:'.$url);
    exit();	
}

require_once 'class/ecode.class.php';
$ecodeClass= new ecodeClass();
$total=$ecodeClass->getCount4($inviteCode);
if($total==0){

	$data=array();
	$data['status']=1;
	$data['msg']='注册失败,邀请码不存在或已用';
	$data['url']='note5.php';	
    $url='note5.php';
    header('Location:'.$url);
    exit();	
}
if($total>0){
	require_once 'class/user.class.php';
	$userClass=new userClass();

	$ecodeClass->update($inviteCode);
	$items=$ecodeClass->getAll2();
	$item=$items[0];
	$newcode=$item['ecode'];

	$userClass->add($username,$password,$inviteCode,$name,$email,$tel,$QQ,$newcode);

	$ecodeClass->update2($newcode);

	
	$data=array();
	$data['status']=1;
	$data['msg']='注册成功';
	$data['url']='note7.php';	
  $url='note7.php';
  header('Location:'.$url);
  exit();
}

function filter($value) {
	$sql = array('drop','select', 'insert', 'update', 'delete' );
	$sql_re = array('','','','','');
	return str_ireplace($sql, $sql_re, $value);
}

?>