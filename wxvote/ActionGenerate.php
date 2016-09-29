<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/task.class.php';



$taskClass=new taskClass();



$items=$taskClass->getAll6();
echo '<pre>';
print_r($items);

foreach ($items as $item) {
	$id=$item['id'];
	$status='执行中';
	$taskClass->update3($id,$status);


}


$data=array();
$data['success']=1;
$data['msg']='处理成功';

$json=json_encode($data);
echo $json;

