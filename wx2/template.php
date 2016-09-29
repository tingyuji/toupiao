<?php
require_once('wxsdk.php');

define("TOKEN", "weixin");
$wechatObj = new wechatCallbackapiTest("wxce3d90673ffbf8d0","d785468bee4066104f11ba849012b7f8");

$template=array(
       'touser'=>"oXi3vs-od7bBi_gfsbQG3SacaYK4",
       'template_id'=>"ApKBq7oZIWElefRytQx4vaG9EmgTph1iJJkD757kdII",
       'url'=>"http://weixin.qq.com/download",            
       'data'=>array(
               'first'=> array(
                   'value'=>urlencode("您好，您已成功进行会员卡充值。"),
                   'color'=>"#173177"                                                        
                ),
               'accountType'=>array(
                   'value'=>urlencode("会员卡号"),
                   'color'=>"#173177"
               ),               
               'account'=>array(
                   'value'=>urlencode("11912345678"),
                   'color'=>"#173177"
               ),
               'amount'=> array(
                   'value'=>urlencode("50元"),
                   'color'=>"#173177"
               ),
               'result'=> array(
                   'value'=>urlencode("充值成功"),
                   'color'=>"#173177"
               ),
               'remark'=>array(
                   'value'=>urlencode("如有疑问，请致电13912345678联系我们。！"),
                   'color'=>"#173177"
               ),
        )
);
//print_r($template);
$token=$wechatObj->getAccessToken();
$url='https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token='.$token;

$data='template_id_short=TM00055';
//var_dump($wechatObj->sendPostData($url,$data));
$ret=$wechatObj->send_template_message(urldecode(json_encode($template)));                  
var_dump($ret);
?>








