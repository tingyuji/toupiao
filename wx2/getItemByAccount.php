<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/user.class.php';
require_once 'class/log.class.php';


$username = isset($_POST['user']) ? $_POST['user'] : '';  
$password = isset($_POST['password']) ? $_POST['password'] : '';  



$userClass = new userClass();
$total=$userClass->getCountByusername($username,$password);


//$row = mysql_fetch_row($rs);  
$result["total"] = $total;  

$items = $userClass->getAllItemsByusername($username,$password);
$result["rows"] = $items;  
if($total==1){
	session_start();
	// store session data
	$_SESSION['username']=$items[0]['username'];
	$_SESSION['name']=$items[0]['name'];
	$_SESSION['addr']=$items[0]['addr'];
	
} 

$logClass = new logClass();
$logClass->add($username);
$jsonresult= json_encode($result); 
echo $jsonresult; 	


?>