<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/task.class.php';

session_start();
$username=$_SESSION['username'];

$taskClass= new taskClass();

$total=$taskClass->getCount8($username);


//$row = mysql_fetch_row($rs);  
$data["total"] = $total;  

$items = $taskClass->getAll38($username);
$data["rows"] = $items;   
$json= json_encode($items); 
echo $json; 
?>