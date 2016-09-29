<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/worker.class.php';


$password = isset($_POST['txtOldPassword']) ? $_POST['txtOldPassword'] : ''; 
$txtPassword = isset($_POST['txtPassword']) ? $_POST['txtPassword'] : '';  
$txtPassword1 = isset($_POST['txtPassword1']) ? $_POST['txtPassword1'] : '';  


session_start();
$username=$_SESSION['username'];

$workerClass = new workerClass();
$total=$workerClass->getCount2($username,$password);

$result["total"] = $total;  

$items = $workerClass->getAll2($username,$password);
$result["rows"] = $items;  
if($total==0){
	$data=[];
	$data['status']=1;
	$data['msg']='原始密码输入错误，请重新输入';
	$data['url']='pwd.php';
}
if($total>0){
	$workerClass->update($username,$txtPassword);
	$data=[];
	$data['status']=1;
	$data['msg']='密码修改成功';
	$data['url']='index.php';
} 


$json=json_encode($data);
echo $json;	

?>