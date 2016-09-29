<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/ranklist.class.php';



$ranklistClass=new ranklistClass();


$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 


echo date("Y-m-d H:i:s");
echo "\n";

echo '撤回脚本启动';
echo "\n";

for($i=0;$i<60;$i++){
	$value=60-$i;
	$ranklistClass->add($i,$value);
}

echo '初始化完成';
echo "\n";
