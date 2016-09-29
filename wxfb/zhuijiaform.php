<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 

require_once 'class/user.class.php';

$id = isset($_POST['id']) ? intval($_POST['id']) : '';
$type = isset($_POST['type']) ? $_POST['type'] : '';
$num = isset($_POST['num']) ? intval($_POST['num']) : '';


require_once 'class/queue.class.php';
$queueClass=new queueClass();

require_once 'class/task.class.php';
$taskClass=new taskClass();



session_start();
$username=$_SESSION['username'];






$items=$taskClass->getAll3($id);
$username2=$items[0]['username'];

$price=$items[0]['price'];
$price2=$items[0]['price2'];

$xiansu=$items[0]['xiansu'];


require_once 'class/alipay.class.php';
$alipayClass=new alipayClass();


$amount=$price*$num;
require_once 'class/alipay.class.php';
$alipayClass=new alipayClass();
$total=$alipayClass->getCount3($username);


if($amount>$total){
	$data=array();
	$data['status']=1;
	$data['msg']='追加失败，余额不足';
	$data['url']='note2.php';


	$json=json_encode($data);
	echo $json;	
	exit();
}


if($xiansu==0){
	$M=$redis->get('M-'.$id);

	$num1=$M+1;
	$num2=$M+$num;

	$redis->set('M-'.$id, $num2);

	$pid=str_pad($id,5,'0',STR_PAD_LEFT);
	for($i=$num1;$i<=$num2;$i++){

		
		$sortcode = str_pad($i,5,'0',STR_PAD_LEFT);
		$orderid=date('Ymd').str_pad($id,5,'0',STR_PAD_LEFT).$sortcode;
		$queueClass->add($pid,$sortcode,$orderid);

		$redis->lPush('T-'.$id, $orderid);
	}

	$redis->sAdd('doing' , $id);	
	$status='执行中';
	$taskClass->update10($id,$num,$status);
}

if($xiansu==1){
	$status='分发中';
	$taskClass->update20($id,$num,$status);
}

if($username!=$username2){
    header("Location:index.php"); //重新定向到其他页面
    exit();
}




// if($amount>$total){
// 	$data=array();
// 	$data['status']=1;
// 	$data['msg']='追加失败，余额不足';
// 	$data['url']='note2.php';


// 	$json=json_encode($data);
// 	echo $json;	
// 	exit();
// }




$fee=(-1)*$price*$num;
$orderNo='';
$action='追加任务';
$remarks='';
$alipayClass->add($username,$fee,$orderNo,$action,$remarks);



require_once 'class/history.class.php';
$historyClass=new historyClass();
$pid=$id;
$action='追加';


$historyClass->add($username,$pid,$action,$fee);




$data=array();
$data['status']=1;
$data['msg']='追加成功';
$data['url']='mywork.php';


$json=json_encode($data);
echo $json;	



?>