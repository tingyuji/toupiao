<?php
session_start();
$wx = isset($_POST['gzh']) ? $_POST['gzh'] : '';
$title = isset($_POST['name']) ? $_POST['name'] : '';
$url = isset($_POST['tpurl']) ? $_POST['tpurl'] : '';

$img1 = isset($_POST['imgfile']) ? $_POST['imgfile'] : '';
$img2 = isset($_POST['qrimgfile']) ? $_POST['qrimgfile'] : '';

$price = isset($_POST['danjia']) ? $_POST['danjia'] : '';
$num = isset($_POST['num']) ? $_POST['num'] : '';
$onetime = isset($_POST['GetNO']) ? $_POST['GetNO'] : '';

$endtime = isset($_POST['endtime']) ? $_POST['endtime'] : '';



$username=$_SESSION['username'];
require_once 'class/task.class.php';
$taskClass=new taskClass();
$taskClass->add($username,$wx,$title,$url,$img1,$img2,$price,$num,$onetime,$endtime);

$data=[];
$data['status']=1;
$data['msg']='提交成功';
$data['url']='index2.php';

$json=json_encode($data);
echo $json;


?>