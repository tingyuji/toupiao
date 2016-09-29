<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/price.class.php';


$priceClass= new priceClass();

$total=$priceClass->getCount();


//$row = mysql_fetch_row($rs);  
$result["total"] = $total;  

$items = $priceClass->getAll();
$result["rows"] = $items;   
$jsonresult= json_encode($result); 
echo $jsonresult; 
?>