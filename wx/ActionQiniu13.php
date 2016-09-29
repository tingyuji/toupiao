<?php
set_time_limit(0);
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");


require_once 'class/images.class.php';
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
$bucketMgr = new BucketManager($auth);

// 要上传的空间
$bucket = 'xiao';

//sleep(10);
$now=date('Y-m-d H:i:s', time());
echo $now;
echo "\n";

// 要列取文件的公共前缀
$prefix = 'Uploads/c/';

$marker = '';
$limit = 100;

while (true) {

	echo date("Y-m-d h:i:s");
	echo "\n";
//	sleep(2);

	list($items, $marker, $err) = $bucketMgr->listFiles($bucket, $prefix, $marker, $limit);
	if ($err !== null) {
	    echo "\n====> list file err: \n";
	    var_dump($err);
	} else {
	    echo "Marker: $marker\n";
	    echo "\nList items====>\n";
	    var_dump($items);
	    $now=strtotime("2016-09-08");
	    echo $now;
	    echo "\n";
	    foreach ($items as $key => $item) {
		echo $key;
		echo "\n";
	    	$key=$item['key'];
	    	$putTime=$item['putTime'];
	    	$time=substr($putTime,0,10);
		    echo $time;
		    echo "\n";
	    	$date=date("Y-m-d h:i:s", $time);
	    	echo $date;
	    	echo "\n";
		     if($time<$now){
		    	//删除$bucket 中的文件 $key
		    	$err = $bucketMgr->delete($bucket, $key);	
		    	echo $key;
		    	echo "\n";     	
		     }    	
	    }
	}	
}



