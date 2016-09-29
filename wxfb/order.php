<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/taobao.class.php';
require_once 'class/alipay.class.php';
require_once 'class/user.class.php';


$orderid = isset($_POST['orderid']) ? $_POST['orderid'] : '';



session_start();
$username=$_SESSION['username'];

$taobaoClass = new taobaoClass();

$alipayClass = new alipayClass();


$total=$taobaoClass->getCount2($orderid);


if($total==0){
	$data=array();
	$data['status']=0;
	$data['msg']='该订单号不存在，可能数据同步有延迟，请联系管理员';
	$data['url']='pay.php';	

	$json=json_encode($data);
	echo $json;
	exit();
}


if($total>0){
	$items=$taobaoClass->getAll2($orderid);
	$item=$items[0];
	$amount=$item['amount'];
	$state=$item['state'];
	if($state=='未提取'){
		$action='在线充值';
		$alipayClass->add($username,$amount,$orderid,$action,'');
		$taobaoClass->update($orderid);
		

		$data=array();
		$data['status']=1;
		$data['msg']='充值成功';
		$data['url']='pay.php';		
	}
	if($state=='已提取'){
		$data=array();
		$data['status']=1;
		$data['msg']='该订单号已提取';
		$data['url']='pay.php';	
	}

}





$json=json_encode($data);
echo $json;

?>