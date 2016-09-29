<?php
session_start();
$username=$_SESSION['username'];

if(!isset($_SESSION['username'])){
    header("Location:index.php"); //重新定向到其他页面
    exit();
}
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>赚米吧</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="bootstrap/css/bootstrap-responsive.css" rel="stylesheet">


 
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#">赚米吧</a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li><a href="index2.php">首页</a></li>
              <li><a href="pay.php">在线充值</a></li>
              <li><a href="wx.php">微信充值</a></li>
              <li><a href="add.php">MP任务</a></li>
              <li><a href="add4.php">扫码关注</a></li>
              <li><a href="add5.php">直投任务</a></li>
              <li class="active"><a href="add2.php">普通任务</a></li>
              <li><a href="add3.php">综合任务</a></li>
              <li><a href="task.php">任务列表</a></li>
              <li><a href="paylist.php">充值记录</a></li>
              <li><a href="balance.php">账户余额</a></li>
              <li><a href="setpwd.php">修改密码</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
      
      <div class="page-header" style="text-align:center;">
          <p class="panel-title">
            如何利用赚米吧图床生成图片链接，请猛戳<a target="_blank" href="http://www.fangdan8.com/simpleuploader/index.php">赚米吧图床</a>
          </p>
      </div>
      <div>

           
      <form class="form-horizontal" action="addtask2.php" method="post">
        <div class="control-group">
          <label class="control-label" for="title">标题</label>
          <div class="controls">
            <textarea name="title" id="title" style="height:20px;width:100%;"></textarea>
          </div>
        </div>


        <div class="control-group">
          <label class="control-label" for="url">链接</label>
          <div class="controls">
            <textarea name="url" id="url" style="height:50px;width:100%;"></textarea>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="price">单价</label>
          <div class="controls">
            <input type="text" name="price" id="price" value="0.14" disabled="disabled">
          </div>
        </div>   

        <div class="control-group">
          <label class="control-label" for="price">数量</label>
          <div class="controls">
            <input type="text" name="num" id="num" placeholder="">
          </div>
        </div>  

        <div class="control-group">
          <label class="control-label" for="img1">样图链接</label>
          <div class="controls">
            <textarea name="img1" id="img1" style="height:20px;width:100%;"></textarea>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="title"></label>
          <div class="controls">
            <p><span style="color:#F00;">关注类任务，请尽量提交二维码图片链接</span></p>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="img2">二维码图片链接</label>
          <div class="controls">
            <textarea name="img2" id="img2" style="height:20px;width:100%;"></textarea>
          </div>
        </div>

        <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn">提交</button>
          </div>
        </div>
      </form>

                                              
      </div>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>
