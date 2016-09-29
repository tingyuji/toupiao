<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");


require_once 'class/orders.class.php';
require_once 'qiniu/autoload.php';

// 引入鉴权类
use Qiniu\Auth;

// 引入上传类
use Qiniu\Storage\BucketManager;

// 需要填写你的 Access Key 和 Secret Key
$accessKey = 'nIRzQejxrqHcD8JZSFfLQvRhmuf28mHzZuufsdib';
$secretKey = 'y9-kNiD0mR-mhqLaFWYjlmAoQQ79c8_XNF8ByisH';

// 构建鉴权对象

$auth = new Auth($accessKey, $secretKey);
$bmgr = new BucketManager($auth);

// 要上传的空间
$bucket = 'xiao';


$ordersClass=new ordersClass();


while(1) {

	sleep(2);
	$now=date('Y-m-d H:i:s');
	echo $now;
	echo "\n";
	$items=$ordersClass->getAll10();


	foreach ($items as $item) {

		$id=$item['id'];
		$imgfile=$item['imgfile'];
		$imgurl=$item['imgurl'];
		if($imgfile!=''){


		$url = $imgurl;
		$bucket = 'xiao';
		$key = $imgfile;

		$bmgr->fetch($url, $bucket, $key);
					

			
		}
		$ordersClass->update8($id);	
		
	}

}

