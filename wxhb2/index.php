<?php 
//入口文件

require_once 'class/zhifu.class.php';
$zhifuClass=new zhifuClass();

require_once 'class/fee.class.php';
$feeClass=new feeClass();

require_once 'class/dailyitem.class.php';
$dailyitemClass=new dailyitemClass();

@require "pay.php";
$packet = new Packet();

//注册任务佣金发放
$items=$feeClass->getAll2();

//不满一元佣金发放
//$items=$dailyitemClass->getAll2();

foreach ($items as $item) {
	$id=1;
	$orderdate='2016-08-27';
	$openid2=$item['openid'];
	echo $openid2;
	echo "\n";	
	$amount=$item['money'];
	$total=$zhifuClass->getCount2($openid2);
	echo $total;
	echo "\n";	
	if($total==0){
		//$dailyitemClass->update($openid2,2);

		$feeClass->update3($openid2,2);
	}
	if(($total>0)&&($amount>0.99)){
		$elems=$zhifuClass->getAll2($openid2);


		
		$openid1=$elems[0]['openid1'];
		echo $openid1;
		echo "\n";
		//$openid1='oS2iHxDnuaAqSSjPIAyWZsZai4ds';
		$packet->_route('wxpacket',array('openid1'=>$openid1,'openid2'=>$openid2,'fee'=>$amount,'orderdate'=>$orderdate,'id'=>$id));
	}
	//exit();
}


