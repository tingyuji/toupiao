<?php
header("Content-Type:text/html;charset=utf-8");
setlocale(LC_ALL, 'zh_CN.utf-8');

require_once 'class/mapping.class.php';
require_once 'class/delta.class.php';
require_once 'class/images.class.php';
require_once 'class/done.class.php';


$mappingClass=new mappingClass();
$deltaClass=new deltaClass();
$imagesClass=new imagesClass();
$doneClass=new doneClass();

$mappingClass->clear();


//while (1) {
	sleep(5);
	echo date('Y-m-d H:i:s', time());
	echo "\n";

	$items=$mappingClass->getAll();
	$i=0;
	foreach ($items as $item) {
		$i++;
		echo $i;
		echo "\n";
		$id=$item['id'];
		$openid=$item['wxusername'];
		$username=$item['username'];

		if($openid!=''){
			echo $openid;
			echo "\n";

			echo $username;
			echo "\n";

			$deltaClass->update5($openid,$username);
			//$imagesClass->update5($openid,$username);
			//$doneClass->update5($openid,$username);	
		}


		
	}
//}


echo date('Y-m-d H:i:s', time());
echo "\n";

echo '更新每个用户的的任务数据。';
echo "\n";
