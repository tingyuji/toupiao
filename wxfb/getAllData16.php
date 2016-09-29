<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");
$pid = isset($_GET['pid']) ? intval($_GET['pid']) : '';

require_once 'class/history.class.php';
$historyClass= new historyClass();

require_once 'class/task.class.php';
$taskClass=new taskClass();
$items=$taskClass->getAll3($pid);
$item=array();

$num=$items[0]['num'];
$orgNum=$items[0]['orgNum'];
$price=$items[0]['price'];
$item['createTime']=$items[0]['createTime'];
$item['action']='发布('.$orgNum.'*'.$price.')';
$item['fee']=(-1)*($orgNum*$price);


$total=$historyClass->getCount2($pid);


//$row = mysql_fetch_row($rs);  
$data["total"] = $total+1;  

$items = $historyClass->getAll2($pid);
array_push($items, $item);

$data["rows"] = $items;   
$json= json_encode($items); 
echo $json; 
?>