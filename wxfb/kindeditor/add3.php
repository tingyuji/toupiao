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
    <link rel="stylesheet" href="kindeditor/themes/themes/default/default.css" />
    <script src="kindeditor/kindeditor-min.js"></script>

 
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
              <li class="active"><a href="add.php">MP任务</a></li>
              <li><a href="add2.php">其他任务</a></li>
              <li><a href="add3.php">注册任务</a></li>
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
      
      <div class="page-header">
          <p class="panel-title">平台从2016年7月09号开始，平台推出注册任务</p>
      </div>
      <div>

           
      <form class="form-horizontal" action="addtask.php" method="post">
        
        <div class="control-group">
          <label class="control-label" for="title">标题</label>
          <div class="controls">
            <textarea name="title" id="title" style="height:50px;width:100%;"></textarea>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="url">链接</label>
          <div class="controls">
            <textarea name="url" id="url" style="height:50px;width:100%;"></textarea>
          </div>
        </div>

        <div class="control-group">
          <label class="control-label" for="url">链接</label>
          <div class="controls">
            <input class="ke-input-text" type="text" id="url" value="" readonly="readonly" /> 
            <input type="button" id="uploadButton" value="Upload" />
          </div>
        </div>

        
       
        <div class="control-group">
          <label class="control-label" for="price">单价</label>
          <div class="controls">
            <input type="text" name="price" id="price" value="" >
          </div>
        </div>   

        <div class="control-group">
          <label class="control-label" for="price">数量</label>
          <div class="controls">
            <input type="text" name="num" id="num" placeholder=""><span>(最少10个)</span>
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

    <script>
      KindEditor.ready(function(K) {
        var uploadbutton = K.uploadbutton({
          button : K('#uploadButton')[0],
          fieldName : 'imgFile',
          url : '../php/upload_json.php?dir=file',
          afterUpload : function(data) {
            if (data.error === 0) {
              var url = K.formatUrl(data.url, 'absolute');
              K('#url').val(url);
            } else {
              alert(data.message);
            }
          },
          afterError : function(str) {
            alert('自定义错误信息: ' + str);
          }
        });
        uploadbutton.fileBox.change(function(e) {
          uploadbutton.submit();
        });
      });
    </script>
</body>
</html>
