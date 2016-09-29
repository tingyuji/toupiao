<?php
header("Content-Type:text/html;charset=utf-8");
setlocale(LC_ALL, 'zh_CN.utf-8');

require_once 'class/mapping.class.php';
require_once 'class/orders.class.php';



$mappingClass=new mappingClass();
$ordersClass=new ordersClass();



//while (1) {
	sleep(5);
	echo date('Y-m-d H:i:s', time());
	echo "\n";

	$items=$mappingClass->getAll();
	foreach ($items as $item) {

		$id=$item['id'];
		$openid=$item['wxusername'];
		$username=$item['username'];

		if(!empty($openid)){
			echo $openid;
			echo "\n";

			echo $username;
			echo "\n";

			$ordersClass->update5($openid,$username);
		}


		
	}
//}


echo date('Y-m-d H:i:s', time());
echo "\n";

echo '更新每个用户的的任务数据。';
echo "\n";
