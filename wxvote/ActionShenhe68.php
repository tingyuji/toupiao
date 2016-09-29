<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/task.class.php';
require_once 'class/queue.class.php';



$taskClass=new taskClass();
$queueClass=new queueClass();



$items=$taskClass->getAll20();
//echo '<pre>';
//echo "\n";
//print_r($items);



$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 
foreach ($items as $item) {
	$id=$item['id'];
	$addNum=$item['addNum'];
	$times=$item['times'];

	$status='执行中';
	$taskClass->update3($id,$status);

	$redis->sAdd('doing' , $id);

	$M=$redis->get('M-'.$id);

	$num1=$M+1;
	$num2=$M+$addNum;

	$redis->set('M-'.$id, $num2);

	$pid=str_pad($id,5,'0',STR_PAD_LEFT);
	for($i=$num1;$i<=$num2;$i++){

		
		$sortcode = str_pad($i,5,'0',STR_PAD_LEFT);
		$orderid=date('Ymd').str_pad($id,5,'0',STR_PAD_LEFT).$sortcode;
		$queueClass->add($pid,$sortcode,$orderid);

		$redis->lPush('T-'.$id, $orderid);
		sleep($times);
	}

	
	
	


}


echo '审核完成';
echo "\n";
