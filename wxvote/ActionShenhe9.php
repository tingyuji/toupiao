<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

$id = 9986;


require_once 'class/task.class.php';
require_once 'class/queue.class.php';



$taskClass=new taskClass();
$queueClass=new queueClass();

$items=$taskClass->getAll6();

$items=$taskClass->getAll3($id);
//echo '<pre>';
//echo "\n";
//print_r($items);



$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 
foreach ($items as $item) {
	$id=$item['id'];
	$sortCode=$item['sortCode'];

	$status='执行中';
	$taskClass->update3($id,$status);


	$redis->set($id,$sortCode); 

	$redis->lPush('task', $id);

	$redis->sAdd('doing' , $id);


	$type=$item['type'];
	$url=$item['url'];
	$img1=$item['img1'];
	$img2=$item['img2'];
	$price2=$item['price2'];

	$title=$item['title'];
	//$note=$item['intro'];
	
	//$redis->sAdd('doing',$id);

	$redis->hSet($id, 'type', $type);
	$redis->hSet($id, 'title', $title);

	$redis->hSet($id, 'url', $url);
	$redis->hSet($id, 'price2', $price2);

	$redis->hSet($id, 'img1', $img1);
	$redis->hSet($id, 'img2', $img2);
	
	//$redis->hSet($id, 'intro', $intro);


	$num=$item['num'];
	$complete=$item['complete'];
	$done=$item['done'];

	$diff=$num-$done;
	$diff=300;

	$M=$redis->get('M-'.$id);


	$num1=$M+1;
	$num2=$M+$diff;

	$redis->set('M-'.$id, $num2);

	$pid=str_pad($id,5,'0',STR_PAD_LEFT);
	for($i=$num1;$i<=$num2;$i++){
		echo date('Y-m-d H:i:s');
		echo "\n";
	//	sleep(4);		
		$sortcode = str_pad($i,5,'0',STR_PAD_LEFT);
		$orderid=date('Ymd').str_pad($id,5,'0',STR_PAD_LEFT).$sortcode;
		$queueClass->add($pid,$sortcode,$orderid);
	
	
		echo $orderid;
		echo "\n\n";
		$redis->lPush('T-'.$id, $orderid);
	}

	
	
	


}


echo '审核完成';
echo "\n";
