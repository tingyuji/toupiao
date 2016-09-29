<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");


require_once 'class/ecode.class.php';


$ecodeClass= new ecodeClass();

for($i=0;$i<100;$i++){
	$code=random(6,0);
	$ecodeClass->add2($code);
}


$data=[];
$data['success']=1;
$data['msg']='生成100个邀请码成功';

$json=json_encode($data);
echo $json;

function random($length = 6 , $numeric = 0) {
    PHP_VERSION < '4.2.0' && mt_srand((double)microtime() * 1000000);
    if($numeric) {
        $hash = sprintf('%0'.$length.'d', mt_rand(0, pow(10, $length) - 1));
    } else {
        $hash = '';
        $chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ0123456789';
        $max = strlen($chars) - 1;
        for($i = 0; $i < $length; $i++) {
            $hash .= $chars[mt_rand(0, $max)];
        }
    }
    return $hash;
}

