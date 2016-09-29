<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/task.class.php';



$taskClass=new taskClass();

$items=$taskClass->getAll15();
//echo '<pre>';
//echo "\n";
//print_r($items);

$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 
$redis->del('doing');

foreach ($items as $item) {
	$id=$item['id'];

	echo $id;
	echo "\n";
		
	$redis->sAdd('doing', $id);


}


echo '初始化完成';
echo "\n";
