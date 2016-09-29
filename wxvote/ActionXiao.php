<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/xiao.class.php';



$xiaoClass=new xiaoClass();

$items=$xiaoClass->getAll();
//echo '<pre>';
//echo "\n";
//print_r($items);

$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 
$redis->del('xiao');

foreach ($items as $item) {
	$id=$item['id'];
	$xiao=$item['xiao'];

	echo $id;
	echo "\n";


		
	$redis->sAdd('xiao', $xiao);


}


echo '初始化完成';
echo "\n";
