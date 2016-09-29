<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");


require_once 'class/orders.class.php';

$ordersClass= new ordersClass();


$items=$ordersClass->getAll8();

foreach ($items as $item){
  	$id=$item['id'];
  	$imgfile=$item['imgfile'];
  	$file=basename($imgfile);

  	$time=substr($file, 0, 14);
  	echo $time;
  	echo '<br>';
  	
  	$p=md5($time);
	$p1 = substr($p,0,1);
	$p2 = substr($p,1,1);
	$p3 = substr($p,2,1);

	$folder='Uploads'.'/'.$p1.'/'.$p2.'/'.$p3.'/';
	if (!file_exists($folder)) {
	    mkdir($folder, 0777, true);
	}
	$newfile=$folder.$file;

	
	$imgfile='Uploads'.'/'.$file;
	echo $imgfile;
	echo '<br>';
	echo $newfile;
	echo '<br>';

	copy($imgfile,$newfile);
	$ordersClass->update5($id,$newfile);



}


