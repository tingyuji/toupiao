<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");
$id = isset($_POST['id']) ? $_POST['id'] : '';

require_once 'class/task.class.php';
require_once 'class/history.class.php';
$taskClass=new taskClass();
$historyClass=new historyClass();

$status='暂停';
$taskClass->update5($id,$status);

session_start();
$username=$_SESSION['username'];
$pid=$id;
$action='暂停';
$fee='0';


$historyClass->add($username,$pid,$action,$fee);


$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 
$redis->sRem('doing', $id);



$data=[];
$data['status']=1;
$data['msg']='任务开启成功';


$json=json_encode($data);
echo $json;


?>