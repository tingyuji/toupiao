<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

$id = isset($_POST['id']) ? $_POST['id'] : '';

require_once 'class/task.class.php';
$taskClass= new taskClass();


$items = $taskClass->getAll2($id); 
$json= json_encode($items); 
echo $json; 
?>