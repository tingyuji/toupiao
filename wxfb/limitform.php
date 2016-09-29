<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");


require_once 'class/user.class.php';

$pid = isset($_POST['pid']) ? intval($_POST['pid']) : '';
$num = isset($_POST['num']) ? intval($_POST['num']) : '';


session_start();
$username=$_SESSION['username'];

require_once 'class/task.class.php';
$taskClass=new taskClass();


$taskClass->update18($pid,$num);



require_once 'class/history.class.php';
$historyClass=new historyClass();

$action='任务限速';
$fee=0;


$historyClass->add($username,$pid,$action,$fee);




$data=array();
$data['status']=1;
$data['msg']='限速成功';
$data['url']='task.php';


$json=json_encode($data);
echo $json;	



?>