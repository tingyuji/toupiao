<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$folder = date('Ymd').'/'; // Relative to the root

$image = isset($_POST['image'])? $_POST['image'] : '';  
  
// 获取图片  
list($type, $data) = explode(',', $image);  
  
// 判断类型  
if(strstr($type,'image/jpeg')!==''){  
    $ext = '.jpg';  
}elseif(strstr($type,'image/gif')!==''){  
    $ext = '.gif';  
}elseif(strstr($type,'image/png')!==''){  
    $ext = '.png';  
}  
  

if (!file_exists("Uploads/".$folder)) {
    mkdir("Uploads/".$folder, 0777, true);
}
$photo = 'Uploads/'.$folder.date('YmdHis').rand(1000,9999).$ext;
// 生成的文件名  
//$photo = time().$ext;  
  
// 生成文件  
file_put_contents($photo, base64_decode($data), true);  

$data=array();
$data['path']=$photo;
$data['status']=1;
$data['msg']='上传文件成功';

$json=json_encode($data);
echo $json;

?>