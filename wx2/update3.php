<?php
session_start();
$openid = isset($_POST['openid']) ? $_POST['openid'] : '';
$oldPass = isset($_POST['oldPass']) ? $_POST['oldPass'] : '';
$newPass = isset($_POST['newPass']) ? $_POST['newPass'] : '';



require_once 'class/user.class.php';
$userClass=new userClass();
$total=$userClass->getCount3($openid,$oldPass);
$data=[];
if($total==0){
	$data['message']='老密码输入错误';
	$data['success']='0';
}
if($total==1){
	$userClass->update3($openid,$newPass);
	$data['message']='密码修改成功';
	$data['success']='1';
}
$json= json_encode($data); 
echo $json; 
?>