<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");
$id = isset($_POST['id']) ? $_POST['id'] : '';

require_once 'class/task.class.php';
require_once 'class/history.class.php';
$taskClass=new taskClass();
$historyClass=new historyClass();


$taskClass->update2($id);

session_start();
$username=$_SESSION['username'];
$pid=$id;
$action='用户终止';
$fee='0';


$historyClass->add($username,$pid,$action,$fee);


$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 
$redis->sRem('doing', $id);

$len=$redis->lSize('T-'.$id);

for ($i=0; $i < $len; $i++) {
	$redis->rPop('T-'.$id);
}



$data=[];
$data['status']=1;
$data['msg']='任务终止成功';


$json=json_encode($data);
echo $json;


?>