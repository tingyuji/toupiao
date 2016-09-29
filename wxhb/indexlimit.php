<?php 
//入口文件

require_once 'class/zhifu.class.php';
$zhifuClass=new zhifuClass();

require_once 'class/daily.class.php';
$dailyClass=new dailyClass();


@require "pay.php";
$packet = new Packet();

//升序取100个
$items=$dailyClass->getAll2();
foreach ($items as $item) {
	//$openid='oS2iHxDnuaAqSSjPIAyWZsZai4ds';
	$id=$item['id'];
	$orderdate=$item['orderdate'];
	$openid2=$item['openid'];
	echo $openid2;
	echo "\n";	
	$fee=$item['fee'];
	$total=$zhifuClass->getCount2($openid2);
	echo $total;
	echo "\n";	
	if($total>0){
		$elems=$zhifuClass->getAll2($openid2);
		
		$openid1=$elems[0]['openid1'];
		echo $openid1;
		echo "\n";
		//$openid1='oS2iHxDnuaAqSSjPIAyWZsZai4ds';
		$packet->_route('wxpacket',array('openid'=>$openid1,'fee'=>$fee,'orderdate'=>$orderdate,'id'=>$id));
		
	}
}


