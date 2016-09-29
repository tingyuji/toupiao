<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/alipay.class.php';
require_once 'class/trade.class.php';



$alipayClass=new alipayClass();
$tradeClass= new tradeClass();

$action='发布任务';
$alipayClass->del3($action);

$items=$tradeClass->getAll();
foreach ($items as $item) {

	echo '<pre>';
	print_r($item);

	$username=$item['username'];
	$fee=$item['fee'];
	$createTime=$item['createTime'];

	if($fee>1){
		$fee=(-1)*$fee;
		
		$action='发布任务';
		$status='已确认';
		$alipayClass->add5($username,$fee,$action,$status,$createTime);		
	}


	
}













