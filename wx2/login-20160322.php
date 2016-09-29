<?php
$openid = isset($_GET['openid']) ? $_GET['openid'] : '';
require_once 'class/user.class.php';
$userClass=new userClass();
$total=$userClass->getCount2($openid);

if($total>0){
    $items=$userClass->getAll2($openid);
    $item=$items[0];
    $name=$item['name'];
    $addr=$item['addr'];
    session_start();
    $_SESSION['name']=$name;
    $_SESSION['addr']=$addr;
    $url='http://www.xiaomutong.com.cn/wx2/step0.php?openid='.$openid;
    header('Location:'.$url);
    exit(); 
}
?>
<!DOCTYPE html>
<html data-dpr="1" style="font-size: 33.75px; min-height: 788px;"><head lang="en"><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1.0, user-scalable=0">
    <link href="http://cdn.haimati.cn/MobileStatic/css/dist/base.css" rel="stylesheet">
    
        <title>登录</title>
        <link href="login.css" rel="stylesheet">
    
<link type="text/css" rel="stylesheet" href="chrome-extension://kfgmnlgjmofpiicpgohgfpeabgpmhjdp/style.css"><script type="text/javascript" charset="utf-8" src="chrome-extension://kfgmnlgjmofpiicpgohgfpeabgpmhjdp/page_context.js"></script></head>
<body gtools_scp_screen_capture_injected="true" style="min-height: 788px; font-size: 12px;">
    
        <div class="container">
            <div class="header">
            </div>
            <div class="lg_content">
                <form>
                    <div class="user">
                        <div class="lg_img"></div>
                        <input class="lg_input" id="input-user" type="number" placeholder="请输入您的手机号码" value="">
                        <div class="clearfix"></div>
                    </div>
                    <div class="lg_border"></div>
                    <div class="password">
                        <div class="lg_img"></div>
                        <input class="lg_input" id="input-pass" type="password" placeholder="请输入您的密码" value="">
                        <div class="clearfix"></div>
                    </div>
                    <div class="lg_border"></div>
                    <input class="login_btn" id="btn-login" type="button" value="登录">
                </form>
                
                <div class="lg_txt">
                    <ul class="lg_txt_ul">
                        <li class="register"><a href="http://www.xiaomutong.com.cn/wx2/register.php">用户注册</a></li>
                        <li class="fg_pw"><a href="http://www.xiaomutong.com.cn/wx2/forget.php">忘记密码</a></li>
                    </ul>
                </div>
            </div>
            <!--
            <div class="footer">
                <p>All Rights Reserved.Design by MANTU</p>
            </div>
            -->
        </div>
    
    <script src="./login_files/hm.js"></script><script>
        var module = '';
        var m_static = 'http://cdn.haimati.cn/MobileStatic';
    </script>
    <script src="./login_files/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/Cookies/src/cookies.js"></script>
    <script src="./login_files/base.js"></script>
    <script src="./login_files/mbase.js"></script>

    <script src="./login_files/login.js"></script>
    <script src="js/purl.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){
        var url = $.url();
        var openid = url.param('openid');
        //alert(openid);
        $('#openid').val(openid);
        Cookies.set('openid',openid, { expires: 1*60*60 }); // Expires in 1天=24*60*60

        $('#btn-login').click(function(){

            var account = $('#input-user').val();
            var password=$('#input-pass').val();


            $.ajax({
                type:'post',        
                url:"getItemByAccount.php", 
                data:{ 
                    
                    user:account,
                    password:password
                },
                async:false,
                dataType:'json',
                success:function(data){ 
                  var total=data.total;
               
                  if(total==0){
                    alert('账号或者密码错误，请重新登录！');
                    return;
                  }         
                  if(total==1){
                      var row=data.rows[0];

                      Cookies.set('username',account, { expires: 1*60*60 }); // Expires in 1天=24*60*60
                     

                      window.location.href="step0.php";   
                  }


                }
              }); 
        });
    });
    </script>
<input type="hidden" id="openid" value=""/>	
</body>
</html>