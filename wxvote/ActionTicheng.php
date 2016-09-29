<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");


require_once 'class/user.class.php';
require_once 'class/payment.class.php';
require_once 'class/alipay.class.php';


$userClass= new userClass();
$paymentClass=new paymentClass();
$alipayClass=new alipayClass();


$time='2016-05';
$items=$userClass->getAll();
print_r($items);
echo "\n";
foreach ($items as $item) {
	$id=$item['id'];	
	$username=$item['username'];
	$newcode=$item['newcode'];	

	$total=$alipayClass->getCount5($newcode,$time);
	if($total>0){
		$fee=$alipayClass->getCount6($newcode,$time);
		echo $fee;
		echo "\n";
		$fee=intval($fee);
		$fee=$fee/100;
		$fee=number_format($fee,2);
		if($fee>1){
			$paymentClass->add($username,$time,$fee);
		}		
	}


	

}

