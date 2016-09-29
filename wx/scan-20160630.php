<?php
header("Content-Type:text/html;charset=utf-8");
setlocale(LC_ALL, 'zh_CN.utf-8');


$img = isset($_GET['img']) ? $_GET['img'] : '';

$url='http://www.fangdan8.com/wxfb/'.$img;

header("Location: ".$url);
exit();