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

$items=$taskClass->getAll6();
echo '<pre>';
print_r($items);

$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 
foreach ($items as $item) {
	$id=$item['id'];
	$type=$item['type'];
	$url=$item['url'];
	$img1=$item['img1'];
	$img2=$item['img2'];
	$title=$item['title'];
	$note=$item['intro'];

	$num=$item['num'];
	$pid=str_pad($id,5,'0',STR_PAD_LEFT);
	$taskClass->update4($id,$pid);
	for($i=1;$i<=$num;$i++){

		$sortcode = str_pad($i,5,'0',STR_PAD_LEFT);
		$orderid=date('Ymd').str_pad($id,5,'0',STR_PAD_LEFT).$sortcode;
		$queueClass->add2($pid,$sortcode,$orderid,$type,$url,$img1,$img2,$title,$note);

		$redis->lPush('order', $orderid);
		$redis->lPush($sortcode, $orderid);
	}
	$status='执行中';
	$taskClass->update3($id,$status);


}


$data=array();
$data['success']=1;
$data['msg']='处理成功';

$json=json_encode($data);
echo $json;

