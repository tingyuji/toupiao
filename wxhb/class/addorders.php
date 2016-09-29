<?php
session_start();
$pid = isset($_POST['pid']) ? $_POST['pid'] : '';
$imgfile = isset($_POST['imgfile']) ? $_POST['imgfile'] : '';

require_once 'class/task.class.php';
$taskClass=new taskClass();
$items=$taskClass->getAll2($pid);
$item=$items[0];
$title=$item['title'];
$price2=$item['price2'];


require_once 'class/orders.class.php';
$ordersClass=new ordersClass();


session_start();
$username=$_SESSION['username'];
$orderid=$ordersClass->makeorderid();
$memo=getRealIpAddr();
$ordersClass->add($username,$orderid,$pid,$title,$imgfile,$memo);

require_once 'class/alipay.class.php';
$alipayClass = new alipayClass();
$fee=$price2;
$orderNo=$orderid;
$action='平台收益';
$remarks='';
$alipayClass->add($username,$fee,$orderNo,$action,$remarks);


require_once 'class/income.class.php';
$incomeClass = new incomeClass();
$fee=$price2;


$action='平台收益';
$incomeClass->add($username,$fee,$orderid,$action);


require_once 'class/worker.class.php';
$workerClass = new workerClass();
$newcode=$_SESSION['newcode'];
$total=$workerClass->getCount6($newcode);
if($total>0){

  $items=$workerClass->getAll5($newcode);
  $item=$items[0];
  $username=$item['username'];

  $fee=0.01;
  $orderNo=$orderid;
  $action='平台收益';
  $remarks='';
  $alipayClass->add($username,$fee,$orderNo,$action,$remarks);

  $workerClass->update5($newcode);

  require_once 'class/profit.class.php';
  $profitClass = new profitClass();
  $fee=0.01;


  $action='平台收益';
  $profitClass->add($username,$fee,$orderid,$action);
}



$data=[];
$data['status']=1;
$data['msg']='接任务成功';
$data['orderid']=$orderid;

$json=json_encode($data);
echo $json;
//$url='work.php';

//header('Location:'.$url);
//exit();	


function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

?>