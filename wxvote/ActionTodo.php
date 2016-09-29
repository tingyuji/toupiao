<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");



$redis = new redis(); 
$redis->connect('127.0.0.1', 6379); 

//$id=2505;
//$redis->sRem('doing', $id);
$items=$redis->sMembers('doing');
echo "<pre>";
print_r($items);

$todo=array();
foreach ($items as $item) {
	$sortCode=$redis->get($item); 
	$pid=$item;
	$todo[$pid]=$sortCode;

}

echo "<pre>";
print_r($todo);

arsort($todo);
echo "<pre>";
print_r($todo);

$todo2=array_keys($todo);
echo "<pre>";
print_r($todo2);

$pid=array_shift($todo2);
echo $pid;
echo "\n";

echo '清理完成';
echo "\n";
