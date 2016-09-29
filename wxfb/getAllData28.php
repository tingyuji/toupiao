<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/user.class.php';

session_start();
$newcode=$_SESSION['newcode'];



$userClass= new userClass();

$total=$userClass->getCount3($newcode);


//$row = mysql_fetch_row($rs);  
$data["total"] = $total;  

$items = $userClass->getAll3($newcode);
$data["rows"] = $items;   
$json= json_encode($items); 
echo $json; 
?>