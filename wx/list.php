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


    <link rel="stylesheet" href="bootstraptable/bootstrap-table.css">
 
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
              <li><a href="add2.php">其他任务</a></li>
              <li class="active"><a href="list.php">任务列表</a></li>
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
           <button id="pause"   class="btn" type="button">暂停</button>
           <button id="open"    class="btn" type="button">开启</button>
           <button id="copy"    class="btn btn-primary" type="button">复制</button>
           <button class="btn btn-info" type="button" data-toggle="modal" 
   data-target="#myModal">追加</button>
           <button id="top"     class="btn btn-success" type="button">置顶</button>
           <button id="images"  class="btn btn-warning" type="button">查图</button>
           <button id="stop"    class="btn btn-inverse" type="button">终止</button>
           <button id="history" class="btn btn-danger" type="button">明细</button>
      </div>      
      <div>
        <table id="table"></table>                                        
      </div>

      <!-- 模态框（Modal） -->
      <div class="modal fade" id="myModal" tabindex="-1" style="display:none;" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" 
                     data-dismiss="modal" aria-hidden="true">
                        &times;
                  </button>
                  <h4 class="modal-title" id="myModalLabel">
                     任务追加
                  </h4>
               </div>
               <div class="modal-body">
                <form class="form-horizontal">
                  <div class="control-group">
                    <label class="control-label" >追加数量</label>
                    <div class="controls">
                      <input type="text" id="num" placeholder="">
                    </div>
                  </div>
                 
              
                </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" 
                     data-dismiss="modal">关闭
                  </button>
                  <button id="ok" type="button" class="btn btn-primary">
                     提交
                  </button>
               </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal -->
      </div>    
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="jquery.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstraptable/bootstrap-table.js"></script>
    <script src="bootstraptable/locale/bootstrap-table-zh-CN.js"></script>

  
<script type="text/javascript">
  
  $(document).ready(function(){
    var $table=$('#table');
    $table.bootstrapTable({
        url:'getAllData12.php',
        striped: true,
        pagination: true,
        columns: [{
            field: 'state',
            radio: true,

        }, {
            field: 'id',
            title: 'id'
        }, {
            field: 'title',
            title: '标题'
        }, {
            field: 'num',
            title: '总数'
        }, {
            field: 'complete',
            title: '已接'
        }, {
            field: 'done',
            title: '已完成'
        }, {                          
            field: 'status',
            title: '状态'
        }, {                          
            field: 'createTime',
            title: '发布时间'
        }]
    });
    $table.on('check.bs.table uncheck.bs.table ' +
              'check-all.bs.table uncheck-all.bs.table', function () {
        

          // save your data, here just save the current page
          selections = getIdSelections();
          //console.log(selections);
          // push or splice the selections if you want to save all data selections
    });
    function getIdSelections() {
        var id='';
        $.map($table.bootstrapTable('getSelections'), function (row) {
            id=row.id;
            
        });
        return id;
    }

    function getTypeSelections() {
        var type='';
        $.map($table.bootstrapTable('getSelections'), function (row) {
            type=row.type;
            
        });
        return type;
    }    

    function getStatusSelections() {
        var status='';
        $.map($table.bootstrapTable('getSelections'), function (row) {
            status=row.status;
            
        });
        return status;
    }    

    $('#pause').click(function(){

        var id = getIdSelections();
        if(id==''){
          alert('请先选择任务'); 
          return;
        }
        //alert(id);
        $.ajax({
          type:'post',        
          url:'pause.php',
          data:{
            id:id
          },
          async:false,
          success:function(data){    
            alert('处理成功');                   
            window.location.reload();
          }
        }); 
    });
    $('#open').click(function(){
        var id = getIdSelections();
        if(id==''){
          alert('请先选择任务'); 
          return;
        }
        var status = getStatusSelections();
        alert(status);
        return;
        if(status == '审核'){
          alert('审核中的任务不允许开启'); 
          return;
        }        
        $.ajax({
          type:'post',        
          url:'open.php',
          data:{
            id:id
          },
          async:false,
          success:function(data){    
            alert('处理成功');                   
            window.location.reload();
          }
        }); 
    });    

    $('#stop').click(function(){
        var id = getIdSelections();
        if(id==''){
          alert('请先选择任务'); 
          return;
        }
        $.ajax({
          type:'post',        
          url:'stop.php',
          data:{
            id:id
          },
          async:false,
          success:function(data){    
            alert('处理成功');                   
            window.location.reload();
          }
        }); 
    });

    $('#top').click(function(){
        var id = getIdSelections();
        if(id==''){
          alert('请先选择任务'); 
          return;
        }
        $.ajax({
          type:'post',        
          url:'topform.php',
          data:{
            id:id
          },
          async:false,
          success:function(data){    
            alert('处理成功');                   
            window.location.reload();
          }
        }); 
    });


    $('#images').click(function(){
      var id = getIdSelections();
      if(id==''){
        alert('请先选择任务'); 
        return;
      }      
      window.location.href='http://www.fangdan8.com/wxfb/images.php?pid='+id;
    });

    $('#zhuijia').click(function(){
      var id = getIdSelections();
      if(id==''){
        alert('请先选择任务'); 
        return;
      }      
      window.location.href='http://www.fangdan8.com/wxfb/zhuijia.php?pid='+id;
    });

    $('#copy').click(function(){
      var id = getIdSelections();
      if(id==''){
        alert('请先选择任务'); 
        return;
      }      
      window.location.href='http://www.fangdan8.com/wxfb/copy.php?pid='+id;
    });    

    $('#history').click(function(){
      var id = getIdSelections();
      if(id==''){
        alert('请先选择任务'); 
        return;
      }      
      window.location.href='http://www.fangdan8.com/wxfb/history.php?pid='+id;
    });
    $('#ok').click(function(){
      var id = getIdSelections();
      var type = getTypeSelections();
      if(id==''){
        alert('请先选择任务'); 
        return;
      }          

      var num=$('#num').val();
      $.ajax({
        type:'post',        
        url:'zhuijiaform.php',
        data:{
          id:id,
          type:type,
          num:num
        },
        async:false,
        dataType:'json',
        success:function(data){    
          //alert('处理成功');        
          var status=data.status;
          var msg=data.msg;
          alert(msg);           
          
        }
      }); 
      $('#myModal').modal('hide');
    });
    $('#myModal').on('hidden', function () {
      window.location.reload();
    })
  });
</script>



</body>
</html>