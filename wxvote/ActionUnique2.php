<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/mili.class.php';

$miliClass= new miliClass();



$items=$miliClass->getAll4();
foreach ($items as $item) {
	$username=$item['username'];
	$miliClass->del2($username);
}


echo date("Y-m-d H:i:s");
echo "\n";



