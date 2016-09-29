<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/user.class.php';


session_start();
$username=$_SESSION['username'];

$password = isset($_POST['password']) ? $_POST['password'] : ''; 
$newpassword = isset($_POST['newpassword']) ? $_POST['newpassword'] : '';  
$username=filter($username);
$password=filter($password);
$newpassword=filter($newpassword);

$userClass = new userClass();
$total=$userClass->getCount2($username,$password);

if($total>0){
	$userClass->update($username,$newpassword);
	$data=array();
	$data['status']=0;
	$data['msg']='密码修改成功';
	$data['url']='note3.php';
  	$url='note3.php';
  	header('Location:'.$url);
  	exit();

} 
if($total==0){

	$data=array();
	$data['status']=0;
	$data['msg']='老密码输入错误';
	$data['url']='note4.php';
  	$url='note4.php';
  	header('Location:'.$url);
  	exit();
} 


function filter($value) {
	$sql = array('drop','select', 'insert', 'update', 'delete' );
	$sql_re = array('','','','','');
	return str_ireplace($sql, $sql_re, $value);
}
?>