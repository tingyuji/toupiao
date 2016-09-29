<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/task.class.php';
require_once 'class/queue.class.php';



$taskClass=new taskClass();
$queueClass=new queueClass();

/*
$items=$taskClass->getAll();
foreach ($items as $item) {
	$id=$item['id'];
	$code=str_pad($id,5,'0',STR_PAD_LEFT);
	$taskClass->update4($id,$code);
}
*/

$items=$taskClass->getAll18();
echo '<pre>';
echo "\n";
print_r($items);

$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 
foreach ($items as $item) {
	$id=$item['id'];
	$sortCode=1;

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
	$note=$item['intro'];
	
	//$redis->sAdd('doing',$id);

	$redis->hSet($id, 'type', $type);
	$redis->hSet($id, 'title', $title);

	$redis->hSet($id, 'url', $url);
	$redis->hSet($id, 'price2', $price2);

	$redis->hSet($id, 'img1', $img1);
	$redis->hSet($id, 'img2', $img2);
	
	$redis->hSet($id, 'intro', $intro);


	$num=$item['num'];
	$times=$item['times'];

	$pid=str_pad($id,5,'0',STR_PAD_LEFT);
	$taskClass->update4($id,$pid);
	//$taskClass->update18($id);


	$redis->set('M-'.$id, $num);
	for($i=1;$i<=$num;$i++){

		$sortcode = str_pad($i,5,'0',STR_PAD_LEFT);
		$orderid=date('Ymd').str_pad($id,5,'0',STR_PAD_LEFT).$sortcode;
		$queueClass->add2($pid,$sortcode,$orderid,$type,$url,$img1,$img2,$title,$note);

		echo $orderid;
		echo "\n";
		$redis->lPush('T-'.$id, $orderid);

		echo date("Y-m-d H:i:s");
		echo "\n";
		sleep($times);
		echo date("Y-m-d H:i:s");
		echo "\n";
	}


	
	
	


}


echo '审核完成';
echo "\n";
