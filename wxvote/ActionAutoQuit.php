<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/task.class.php';
require_once 'class/done.class.php';



$taskClass=new taskClass();
$doneClass= new doneClass();



$status='执行中';
$items=$taskClass->getAll16($status);
foreach ($items as $item) {
	$pid=$item['id'];
	echo $pid;
	echo "\n";
	//已放弃
	$num1=$doneClass->getCount2($pid);
	echo $num1;
	echo "\n";
	
	//已完成
	$num2=$doneClass->getCount3($pid);
	echo $num2;
	echo "\n";

	$rate=$num1/$num2;
	echo $rate;
	echo "\n";
	$rate=intval($rate);
	if($rate>5){
		$taskClass->update9($pid);
	}
	echo "***********************";
	echo "\n";
	
}




