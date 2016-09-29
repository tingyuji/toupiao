<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/task.class.php';



$taskClass=new taskClass();

$items=$taskClass->getAll12();
echo '<pre>';
echo "\n";
print_r($items);

$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 
foreach ($items as $item) {
	$id=$item['id'];
		
	$redis->sRem('doing', $id);


}


echo '初始化完成';
echo "\n";
