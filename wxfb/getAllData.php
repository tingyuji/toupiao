<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/task.class.php';


$taskClass= new taskClass();

$total=$taskClass->getCount6();


//$row = mysql_fetch_row($rs);  
$data["total"] = $total;  


$status='执行中';
$items = $taskClass->getAll7($status);
$data["rows"] = $items;   
$json= json_encode($data); 
echo $json; 
?>