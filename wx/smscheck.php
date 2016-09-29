<?php
session_start();
$openid = isset($_POST['openid']) ? $_POST['openid'] : '';
$tel = isset($_POST['tel']) ? $_POST['tel'] : '';
$pass = isset($_POST['pass']) ? $_POST['pass'] : '';
require_once 'class/user.class.php';
$userClass=new userClass();

if($_POST['yzm']!=$_SESSION['send_code'] or empty($_POST['yzm'])){
    echo '手机验证码输入错误!';
}else{
	$total=$userClass->getCountByTel($tel);
	if($total==0){
		$userClass->add($openid,$tel,$pass);
    	$_SESSION['mobile'] = '';
    	$_SESSION['mobile_code'] = '';  
    	echo '注册成功';  
	}
	if($total>0){
		echo '该手机号已注册，请直接登录'; 
	}

}
?>