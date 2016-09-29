<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

require_once 'class/task.class.php';
require_once 'class/ordersdone.class.php';



$taskClass=new taskClass();
$ordersdoneClass=new ordersdoneClass();

$items=$taskClass->getAll58();


foreach ($items as $item) {
	$id=$item['id'];
	$price2=$item['price2'];

	$ordersdoneClass->update2($id,$price2);
	//exit();
	
	


}


echo '更新完成';
echo "\n";
