<?php
header("Content-Type:text/html;charset=utf-8");
setlocale(LC_ALL, 'zh_CN.utf-8');

require_once 'class/orders.class.php';
require_once 'class/images.class.php';
require_once 'class/done.class.php';
require_once 'class/mapping.class.php';

$ordersClass=new ordersClass();
$imagesClass=new imagesClass();
$doneClass=new doneClass();

$mappingClass=new mappingClass();
while (1) {
	sleep(5);
	echo date('Y-m-d H:i:s', time());
	echo "\n";

	$items=$ordersClass->getAll13();
	foreach ($items as $item) {

		$id=$item['id'];
		$openid=$item['openid'];
		$total=$mappingClass->getCount2($openid);
		if($total){
			$users=$mappingClass->getAll2($openid);
			$user=$users[0];
			$username=$user['username'];
			if(!empty($username)){
				$ordersClass->update5($openid,$username);
				$imagesClass->update5($openid,$username);
				$doneClass->update5($openid,$username);				
			}

		}
		
	}
}


echo date('Y-m-d H:i:s', time());
echo "\n";

echo '更新每个用户的的任务数据。';
echo "\n";