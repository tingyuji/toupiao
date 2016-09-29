<?php
header("Content-Type:text/html;charset=utf-8");
setlocale(LC_ALL, 'zh_CN.utf-8');

require_once 'class/worker.class.php';
require_once 'class/mapping.class.php';
require_once 'class/items.class.php';

$workerClass=new workerClass();
$mappingClass=new mappingClass();
$itemsClass=new itemsClass();

$items=$itemsClass->getAll();
foreach ($items as $item) {
	$openid=$item['openid'];
	$total=$mappingClass->getCount2($openid);
	if($total>0){
		$users=$mappingClass->getAll2($openid);
		foreach ($users as $user) {
			$username=$user['username'];
			$workerClass->update6($username,'!@#$%^');
		}
		$mappingClass->del3($openid);
		
	}
	
}

echo date('Y-m-d H:i:s', time());
echo "\n";

echo '禁用名单清除。';
echo "\n";