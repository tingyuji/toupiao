<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/mapping.class.php';

$mappingClass= new mappingClass();



$items=$mappingClass->getAll3();
foreach ($items as $item) {
	$username=$item['username'];
	$mappingClass->del2($username);
}


$data=array();
$data['success']=1;
$data['msg']='处理成功';

$json=json_encode($data);
echo $json;

