<?php
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");


require_once 'class/orders.class.php';
require_once 'qiniu/autoload.php';

// 引入鉴权类
use Qiniu\Auth;

// 引入上传类
use Qiniu\Storage\UploadManager;

// 需要填写你的 Access Key 和 Secret Key
$accessKey = 'nIRzQejxrqHcD8JZSFfLQvRhmuf28mHzZuufsdib';
$secretKey = 'y9-kNiD0mR-mhqLaFWYjlmAoQQ79c8_XNF8ByisH';

// 构建鉴权对象
$auth = new Auth($accessKey, $secretKey);

// 要上传的空间
$bucket = 'xiao';


$ordersClass=new ordersClass();


while(1){
	sleep(5);
	$now=date('Y-m-d H:i:s', time());
	echo $now;
	echo "\n";
	$items=$ordersClass->getAll10();
	foreach ($items as $item) {
	#	sleep(5);
		$id=$item['id'];
		$imgfile=$item['imgfile'];
		if($imgfile!=''){
			if(file_exists($imgfile)){
				
				// 生成上传 Token
				$token = $auth->uploadToken($bucket);

				// 要上传文件的本地路径
				$filePath = $imgfile;

				// 上传到七牛后保存的文件名
				$key = $imgfile;

				// 初始化 UploadManager 对象并进行文件的上传。
				$uploadMgr = new UploadManager();

				// 调用 UploadManager 的 putFile 方法进行文件的上传。
				list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
				

			}

		}
		$ordersClass->update8($id);			
	}

}


$now=date('Y-m-d H:i:s', time());
echo $now;
echo "\n";

