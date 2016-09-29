<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/wx.class.php';
require_once 'class/alipay.class.php';
require_once 'class/user.class.php';


$orderid = isset($_POST['orderid']) ? $_POST['orderid'] : '';

	

session_start();
$username=$_SESSION['username'];

$wxClass = new wxClass();

$alipayClass = new alipayClass();


$total=$wxClass->getCount2($orderid);


if($total==0){
	$url="http://www.fangdan8.com/wxwx/orderquery.php"; 
	$data['transaction_id']=$orderid;       
	$json=sendPostData($url,$data);
	//var_dump($json);
	//exit();
	$item=json_decode($json,true);
	//print_r($item);

	$trade_state=$item['trade_state'];

	$total_fee=$item['total_fee'];
	$amount=$total_fee*0.01;
	
	$data=array();
	$data['status']=0;
	$data['msg']='交易单号不存在，请重新核对。';
	$data['url']='pay.php';	
	
	if($trade_state=='SUCCESS'){
		$action='在线充值';
		$alipayClass->add($username,$amount,$orderid,$action,'');
		$wxClass->add($orderid,$trade_state,$total_fee);

		$data=array();
		$data['status']=1;
		$data['msg']='充值成功';
		$data['url']='pay.php';		
	}

	$json=json_encode($data);
	echo $json;
	exit();
}


if($total>0){


	$data=array();
	$data['status']=0;
	$data['msg']='该订单号已提取';
	$data['url']='wx.php';	

	$json=json_encode($data);
	echo $json;
	exit();	

}



function sendPostData($url,$curlPost){

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_NOBODY, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
    $return_str = curl_exec($curl);
    curl_close($curl);
    return $return_str;
}

?>