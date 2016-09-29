<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/user.class.php';


$username = isset($_POST['username']) ? $_POST['username'] : '';  
$password = isset($_POST['password']) ? $_POST['password'] : '';  
$username=filter($username);
$password=filter($password);

session_start();

$userClass = new userClass();
$total=$userClass->getCount2($username,$password);

$result["total"] = $total;  

$items = $userClass->getAll2($username,$password);
$result["rows"] = $items;  
if($total>0){
	$_SESSION['username']=$items[0]['username'];
	$_SESSION['name']=$items[0]['name'];
	$_SESSION['tel']=$items[0]['tel'];
	$_SESSION['QQ']=$items[0]['QQ'];
	$_SESSION['email']=$items[0]['email'];
	$_SESSION['newcode']=$items[0]['newcode'];
	$_SESSION['fee']=$items[0]['fee'];
	$_SESSION['balance']=$items[0]['balance'];
	$_SESSION['level']=$items[0]['level'];
	
	$status=$items[0]['status'];
	if($status=='封号'){
		$data=array();
		$data['status']=0;
		$data['msg']='该账号已封号，请联系管理员';
		$data['url']='index.php';	
	}

	if($status!='封号'){
		$data=array();
		$data['status']=1;
		$data['msg']='登录成功';
		$data['url']='index2.php';	
    $url='index2.php';
    header('Location:'.$url);
    exit();
	}
	

} 
if($total==0){

	$data=array();
	$data['status']=0;
	$data['msg']='登陆失败';
	$data['url']='note8.php';	
  $url='note8.php';
  header('Location:'.$url);
  exit();
} 



function filter($value) {
	$sql = array('drop','select', 'insert', 'update', 'delete' );
	$sql_re = array('','','','','');
	return str_ireplace($sql, $sql_re, $value);
}
?>