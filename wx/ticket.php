<?php

   function getAccessToken() {
    // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
    $data = json_decode(get_php_file("access_token.php"));
    if ($data->expire_time < time()) {
      // 如果是企业号用以下URL获取access_token
      // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=appId&corpsecret=appSecret";
      $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wxce3d90673ffbf8d0&secret=d785468bee4066104f11ba849012b7f8";
      $res = json_decode(httpGet($url));
      $access_token = $res->access_token;
      if ($access_token) {
        $data->expire_time = time() + 7000;
        $data->access_token = $access_token;
        set_php_file("access_token.php", json_encode($data));
      }
    } else {
      $access_token = $data->access_token;
    }
    return $access_token;
  } 

    // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
    $data = json_decode(get_php_file("api_ticket.php"));
    print_r($data);
    if ($data->expire_time < time()) {
      echo 'hello1';
      $accessToken = getAccessToken();
      echo $accessToken;
      // 如果是企业号用以下 URL 获取 ticket
      // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
      //$url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
      $url='https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token='.$accessToken.'&type=wx_card';
      $res = json_decode(httpGet($url));
      print_r($res);
      $ticket = $res->ticket;
      if ($ticket) {
        $data->expire_time = time() + 7000;
        $data->api_ticket = $ticket;
        set_php_file("api_ticket.php", json_encode($data));
      }
    } else {
      echo 'hello2';      
      $ticket = $data->api_ticket;
      echo $ticket;
    }

    echo $ticket;

   function httpGet($url) {
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

   function get_php_file($filename) {
    return trim(substr(file_get_contents($filename), 15));
  }
   function set_php_file($filename, $content) {
    $fp = fopen($filename, "w");
    fwrite($fp, "<?php exit();?>" . $content);
    fclose($fp);
  } 
?>