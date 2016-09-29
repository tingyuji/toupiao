<?php
session_start();
$username=$_SESSION['username'];
$id = isset($_POST['id']) ? $_POST['id'] : '';


$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 

require_once 'class/task.class.php';
require_once 'class/history.class.php';
$taskClass=new taskClass();
$historyClass=new historyClass();

$sortCode=99999;
$taskClass->update8($id,$sortCode);


session_start();
$username=$_SESSION['username'];
$pid=$id;
$action='置顶';
$fee='0';


$historyClass->add($username,$pid,$action,$fee);


$redis->set($id,9999); 

$data=[];
$data['status']=1;
$data['msg']='置顶成功';
$data['url']='mywork.php';

$json=json_encode($data);
echo $json;
exit();


?>