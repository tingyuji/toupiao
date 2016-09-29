<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/alipay.class.php';

session_start();
$username=$_SESSION['username'];

$alipayClass= new alipayClass();

$total=$alipayClass->getCount3($username);


//$row = mysql_fetch_row($rs);  
$data["total"] = $total;  

$items = $alipayClass->getAll2($username);
$data["rows"] = $items;   
$json= json_encode($items); 
echo $json; 
?>