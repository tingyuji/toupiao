<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/task.class.php';



$taskClass=new taskClass();


$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 

$status='已完成';
while (true) {
	$pid=$redis->sPop('done');
	if($pid){
		
		$taskClass->update3($pid,$status);
				
	}


}


echo '初始化完成';
echo "\n";
