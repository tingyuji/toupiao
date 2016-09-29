<?php

require_once 'detect/Mobile_Detect.php';
$detect = new Mobile_Detect;

$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
if($deviceType=='computer'){
  $url='http://www.fangdan8.com/wxfb/list.php';
  header("Location: http://www.fangdan8.com/wxfb/list.php");
  exit; 
}

if($deviceType!='computer'){
  $url='http://www.fangdan8.com/wxfb/list2.php';
  header("Location: http://www.fangdan8.com/wxfb/list2.php");
  exit; 
}

?>