<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");


require_once 'class/orders.class.php';
$ordersClass= new ordersClass();


$items=$ordersClass->getAll9();


foreach ($items as $item) {

	$id=$item['id'];
	$imgfile=$item['imgfile'];

	if(!empty($imgfile)){
		$file='/home/wwwroot/default/wx/'.$imgfile;
		//$file=$imgfile;

		if(file_exists($file)){
			echo $file;
			echo "\n";
			//unlink($imgfile);
			if (!unlink($file)){
			  echo ("Error deleting $file");
			  echo "\n";
			}
			else{
			  echo ("Deleted $file");
			  echo "\n";
			}
		}		
	}

	


}


$data=[];
$data['success']=1;
$data['msg']='处理成功';

$json=json_encode($data);
echo $json;

