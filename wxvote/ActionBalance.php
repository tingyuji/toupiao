<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/alipay.class.php';
require_once 'class/user.class.php';



$alipayClass=new alipayClass();
$userClass=new userClass();

$alipayClass->update3();
$items=$userClass->getAll();
echo '<pre>';
print_r($items);

foreach ($items as $item) {
	$id=$item['id'];
	$username=$item['username'];
	$total=$alipayClass->getCount2($username);

	if($total>0){
		$fees=$alipayClass->getAll7();
		$arr=array();
		foreach ($fees as $val) {
			$key=$val['username'];
			$fee=$val['fee'];
			$arr[$key]=$fee;
		}
		$balance=$arr[$username];
		$balance=round($balance ,2);
		echo $balance;
		echo "\n";
		$userClass->update4($id,$balance);	
	}

}


$items=$alipayClass->getAll6();
foreach ($items as $item) {
	
	$username=$item['username'];
	$fee=$item['fee'];
	$userClass->update5($username,$fee);

}

$data=array();
$data['success']=1;
$data['msg']='处理成功';

$json=json_encode($data);
echo $json;

