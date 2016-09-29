<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");
$pid = isset($_POST['pid']) ? $_POST['pid'] : '';

require_once 'class/orders.class.php';


$ordersClass= new ordersClass();

$total=$ordersClass->getCount4($pid);

$status='已上传';
//$total2=$ordersClass->getCount7($pid);

//$row = mysql_fetch_row($rs);  
$result["total"] = $total;  


//$items = $ordersClass->getAll7($pid);
$items = $ordersClass->getAll8($pid);
$total2=count($items);
$result["total2"] = $total2;  

$result["rows"] = $items;   
$jsonresult= json_encode($result); 
echo $jsonresult; 
?>