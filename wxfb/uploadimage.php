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
              <li><a href="index.php">首页</a></li>
              <li class="active"><a href="#">图片上传</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
        <div class="page-header">
          <p class="panel-title">文件上传</p>
        </div>
        <div>
        <form>
        <div class="form-group">
            <textarea name="imgfile" id="imgfile" style="height:50px;width:100%;"></textarea>
            <input id="uploadInput" class="btn btn-info" type="file" value="上传图片">

            <div class="page-header">
            </div>
            <p id="divimg"></p>
        </div>    
        </form>
        </div>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>


  
<script type="text/javascript">
  $(document).ready(function(){
            $('#uploadInput').change(function () {
                var file = this.files[0];
                //判断类型是不是图片  
                if (!/image\/\w+/.test(file.type)) {
                    alert("请确保文件为图像类型");
                    return false;
                }

                var reader = new FileReader();
                reader.onload = function () {
                    // 通过 reader.result 来访问生成的 DataURL
                    var url = reader.result;

                };
                reader.readAsDataURL(file);

                reader.onload = function (e) {
                    $.ajax({
                        url: "upload.php",
                        type: "POST",
                        data: { "image": "" + this.result + "", "imgtype": 1 },
                        beforeSend: function (e) {
                           
                        },
                        success: function (data) {

                            if (data.status == "1") {
                                $("#divimg").html("<img style='width:200px;height:300px;' src=\"http://www.fangdan8.com/wxfb/" + data.path + "\"/>");
                                $("#imgfile").val(data.path)
                                
                            } else {
                               
                            }




                        }, dataType: "json"
                    });
                }
            });

  });

</script>
</body>
</html>