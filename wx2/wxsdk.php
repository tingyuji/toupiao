<?php

class wechatCallbackapiTest{
    private $appId;
    private $appSecret;
 
    public function __construct($appId, $appSecret) {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }    
  public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
          echo $echoStr;
          exit;
        }
    }

    public function responseMsg()
    {
    //get post data, May be due to the different environments
    $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
    if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $msgType=strtolower($postObj->MsgType);
                $event=strtolower($postObj->Event);                
                $time = time();
                $textTpl = "<xml>
              <ToUserName><![CDATA[%s]]></ToUserName>
              <FromUserName><![CDATA[%s]]></FromUserName>
              <CreateTime>%s</CreateTime>
              <MsgType><![CDATA[%s]]></MsgType>
              <Content><![CDATA[%s]]></Content>
              <FuncFlag>0</FuncFlag>
              </xml>";  

                switch($msgType){
                   case "event":
                          switch (strtolower($postObj->Event)){
                            case "subscribe":
                                    $msgType2 = "text";
                                    $contentStr="欢迎关注一杆称麻辣烫香格礼店\n";
                                    $contentStr.="回复（1）领取优惠劵。\n";
                                    $contentStr.="回复（2）领取会员积分卡。\n";
                                    $contentStr.="回复（3）查看本店地址。\n";
                                    $contentStr.="回复（4）查看wifi密码。\n";
                                    $contentStr.="其他功能正在开发~~~~~";
                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType2, $contentStr);
                                    echo $resultStr; 
                                    break;
                            case "unsubscribe":
                                    $content = "";
                                    break;
                            case "click":

                                    $key=strtolower($postObj->EventKey);
                                    $msgType2 = "text";
                                    
                                    switch ($key) {
                                        case 'key001':
                                            $contentStr ="一杆称麻辣烫香格礼店\n";
                                            $contentStr.="地址：北二环文苑街香格礼小区东门南侧\n";
                                            $contentStr.="电话：18032210767";
                                            break;
                                        case 'key002':
                                            $contentStr =$key;
                                            break;
                                        case 'key003':
                                            $contentStr =$key;
                                            break;                                                                                    
                                        default:
                                            # code...
                                            break;
                                    }
                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType2, $contentStr);
                                    echo $resultStr;
                                    break;                            
                            default:
                                    $msgType2 = "text";
                                    $contentStr="欢迎关注一杆称麻辣烫香格礼店\n";
                                    $contentStr.="回复（1）领取优惠劵。\n";
                                    $contentStr.="回复（2）领取会员积分卡。\n";
                                    $contentStr.="回复（3）查看本店地址。\n";
                                    $contentStr.="回复（4）查看wifi密码。\n";
                                    $contentStr.="其他功能正在开发~~~~~";
                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType2, $contentStr);
                                    echo $resultStr;                             
                           }

                   breadk;
                   case "text":
                           
                            switch ($keyword) {
                                case 1:
                                    $contentStr='领取优惠劵';
                                    break;
                                case 2:
                                    $contentStr='领取会员积分卡';
                                    break;
                                case 3:
                                    $contentStr ="一杆称麻辣烫香格礼店\n";
                                    $contentStr.="地址：北二环文苑街香格礼小区东门南侧\n";
                                    $contentStr.="电话：18032210767";
                                    break;
                                case 4:
                                    $contentStr="WiFi账号：WXyigancheng \n";
                                    $contentStr.="密   码：malatang \n ";
                                    break;                                                                                                        
                                default:

                                     $template=array(
                                               'touser'=>$fromUsername,
                                               'template_id'=>"ApKBq7oZIWElefRytQx4vaG9EmgTph1iJJkD757kdII",
                                               'url'=>"http://weixin.qq.com/download",            
                                               'data'=>array(
                                                       'first'=> array(
                                                           'value'=>urlencode("您好，您已成功进行会员卡充值。"),
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
                                                       )
                                                )
                                        );
                                      
                                     //$contentStr=$this->send_template_message(urldecode(json_encode($template));
                                     $contentStr=$fromUsername;
                                    break;
                            }
                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                            echo $resultStr;        
                   break;
                }                                        
        //if(!empty( $keyword ))
                //{
                //  $msgType = "text";
                //  $contentStr = "Welcome to wechat world!";
                //  $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                //  echo $resultStr;
                //}else{
                //  echo "Input something...";
                //}

        }else {
          echo "";
          exit;
        }
    }

    public function sendGetData($url){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
        // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
    }
    public function sendPostData($url,$curlPost){

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        $return_str = curl_exec($curl);
        curl_close($curl);
        return $return_str;
    }
    public function send_template_message($template){
             $token=$this->getAccessToken();
             $url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$token;        
             $res=$this->sendPostData($url,$template);
             return  json_decode($res,true);

    }

    public function send_kefu_message($data){
      $token=$this->getAccessToken();
      $url='https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$token;
      $res=$this->sendPostData($url,$data);
      return  json_decode($res,true);      
    }


    public function create_qrcode($data){
      $token=$this->getAccessToken();
      $url='https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$token;
      $res=$this->sendPostData($url,$data);
      return  json_decode($res,true);      
    }

    public function showqrcode($ticket){
      $url='https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.$ticket;
      $res=$this->httpGet($url);
      header("Content-type: image/jpeg");
      echo $res;
    }
     
    
    public function createMenu($menu){
             $token=$this->getAccessToken();
             $url='https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$token;        
             $res=$this->sendPostData($url,$menu);
             return  json_decode($res,true);

    }    
    public function writeFile($filename,$img){
      $file=fopen($filename,'w');
      if(false!==$file){
        if(false!==fwrite($file, $img)){
          fclose($file);
        }
      }
    }

    //用于对图片进行缩放
    function thumb($filename,$width=200,$height=200){
        //获取原图像$filename的宽度$width_orig和高度$height_orig
        list($width_orig,$height_orig) = getimagesize($filename);
        //根据参数$width和$height值，换算出等比例缩放的高度和宽度
        if ($width && ($width_orig<$height_orig)){
            $width = ($height/$height_orig)*$width_orig;
        }else{
            $height = ($width / $width_orig)*$height_orig;
        }
 
        //将原图缩放到这个新创建的图片资源中
        $image_p = imagecreatetruecolor($width, $height);
        //获取原图的图像资源
        $image = imagecreatefromjpeg($filename);
 
        //使用imagecopyresampled()函数进行缩放设置
        imagecopyresampled($image_p,$image,0,0,0,0,$width,$height,$width_orig,$height_orig);
 
        //将缩放后的图片$image_p保存，100(质量最佳，文件最大)
        imagejpeg($image_p,$filename);
 
        imagedestroy($image_p);
        imagedestroy($image);
    }
  // 获取图片地址
    public function getmedia($media_id){
        $foldername='images';
        $access_token=$this->getAccessToken();
        $url = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=".$access_token."&media_id=".$media_id;
        if (!file_exists("./Uploads/".$foldername)) {
            mkdir("./Uploads/".$foldername, 0777, true);
        }
        $targetName = './Uploads/'.$foldername.'/'.date('YmdHis').rand(1000,9999).'.jpg';
        $ch = curl_init($url); // 初始化
        $fp = fopen($targetName, 'wb'); // 打开写入
        curl_setopt($ch, CURLOPT_FILE, $fp); // 设置输出文件的位置，值是一个资源类型
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
        fclose($fp);
        $this->thumb($targetName,800,600);
        echo $targetName;
    }      
    public function updateImg($data){

            $token=$this->getAccessToken();
            echo $token;
            echo '<br>';
            $type='image';
            //$url='http://file.api.weixin.qq.com/cgi-bin/media/upload?access_token='.$token.'&type='.$type;        
            $url='https://api.weixin.qq.com/cgi-bin/material/add_material?access_token='.$token;  
            $url='https://api.weixin.qq.com/cgi-bin/material/get_material?access_token='.$token;
            $url='https://api.weixin.qq.com/cgi-bin/material/batchget_material?access_token='.$token;
            
            $res=$this->sendPostData($url,$data);
            return  json_decode($res,true);

    }  
    public function downloadImg($id){
            $token=$this->getAccessToken();

            $url='http://file.api.weixin.qq.com/cgi-bin/media/get?access_token='.$token.'&media_id='.$id;        
            $data=$this->httpGet($url);
            return  $data;

    }         
  private function checkSignature()
  {
        // you must define TOKEN by yourself
      if (!defined("TOKEN")) {
          throw new Exception('TOKEN is not defined!');
      }
        
      $signature = $_GET["signature"];
      $timestamp = $_GET["timestamp"];
      $nonce = $_GET["nonce"];
            
      $token = TOKEN;
      $tmpArr = array($token, $timestamp, $nonce);
          // use SORT_STRING rule
      sort($tmpArr, SORT_STRING);
      $tmpStr = implode( $tmpArr );
      $tmpStr = sha1( $tmpStr );
      
      if( $tmpStr == $signature ){
        return true;
      }else{
        return false;
      }
    }

      public function getSignPackage() {
        $jsapiTicket = $this->getJsApiTicket();

        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        //$url='http://tel.xsdcm.cn/sample.php';

        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        $signature = sha1($string);

        $signPackage = array(
          "appId"     => $this->appId,
          "nonceStr"  => $nonceStr,
          "timestamp" => $timestamp,
          "url"       => $url,
          "signature" => $signature,
          "rawString" => $string
        );
        return $signPackage; 
      }

      private function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
          $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
      }

      private function getJsApiTicket() {
        // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
        $data = json_decode($this->get_php_file("jsapi_ticket.php"));
        if ($data->expire_time < time()) {
          $accessToken = $this->getAccessToken();
          // 如果是企业号用以下 URL 获取 ticket
          // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
          $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
          $res = json_decode($this->httpGet($url));
          $ticket = $res->ticket;
          if ($ticket) {
            $data->expire_time = time() + 7000;
            $data->jsapi_ticket = $ticket;
            $this->set_php_file("jsapi_ticket.php", json_encode($data));
          }
        } else {
          $ticket = $data->jsapi_ticket;
        }

        return $ticket;
      }

      public function getAccessToken() {
        // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
        $data = json_decode($this->get_php_file("access_token.php"));
        if ($data->expire_time < time()) {
          // 如果是企业号用以下URL获取access_token
          // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
          $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
          $res = json_decode($this->httpGet($url));
          $access_token = $res->access_token;
          if ($access_token) {
            $data->expire_time = time() + 7000;
            $data->access_token = $access_token;
            $this->set_php_file("access_token.php", json_encode($data));
          }
        } else {
          $access_token = $data->access_token;
        }
        return $access_token;
      }

      private function httpGet($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
        // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);

        $res = curl_exec($curl);
        curl_close($curl);

        return $res;
      }

      private function get_php_file($filename) {
        return trim(substr(file_get_contents($filename), 15));
      }
      private function set_php_file($filename, $content) {
        $fp = fopen($filename, "w");
        fwrite($fp, "<?php exit();?>" . $content);
        fclose($fp);
      }    
}

?>