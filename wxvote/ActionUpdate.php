<?php
header("Content-Type:text/html;charset=utf-8");
setlocale(LC_ALL, 'zh_CN.utf-8');

require_once 'class/orders.class.php';
require_once 'class/mapping.class.php';

$ordersClass=new ordersClass();
$mappingClass=new mappingClass();

$items=$mappingClass->getAll();
foreach ($items as $item) {
	$username=$item['username'];
	$num=$ordersClass->getCount3($username);
	$mappingClass->update5($username,$num);
}

echo date('Y-m-d H:i:s', time());
echo "\n";

echo '更新每个用户的完成任务数量。';
echo "\n";