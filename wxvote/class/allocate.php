<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/invitecode.class.php';
require_once 'class/worker.class.php';
require_once 'class/mapping.class.php';



$time=date('Y-m-d H:i:s');
echo $time;
echo "\n";
$invitecodeClass=new invitecodeClass();
$workerClass= new workerClass();
$mappingClass= new mappingClass();

$items=$invitecodeClass->getAll2();
$arr=array();
foreach ($items as $item) {
	$code=$item['code'];
	array_push($arr, $code);
}

$workerClass= new workerClass();
$items=$workerClass->getAll4();
foreach ($items as $item){
  $id=$item['id'];
  $inviteCode=array_shift($arr);
  $workerClass->update4($id,$inviteCode);

  $status='已用';
  $invitecodeClass->update2($inviteCode,$status);

}

$items=$workerClass->getAll();
foreach ($items as $item) {
	$username=$item['username'];
	$inviteCode=$item['inviteCode'];
	$mappingClass->update6($username,$inviteCode);
}
