<?php 
session_start();

?>
<!DOCTYPE html>
<!-- saved from url=(0036)mywork.php -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><title>
	我的任务
</title>
     <!-- start: META -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"><meta name="apple-mobile-web-app-capable" content="yes"><meta name="apple-mobile-web-app-status-bar-style" content="black"><meta name="description"><meta name="author">
    <!-- end: META -->
    <!-- start: MAIN CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="table/src/bootstrap-table.css"> 


    <link rel="stylesheet" href="http://www.toupiaopt.com/assets/plugins/bootstrap/css/bootstrap.min.css"><link rel="stylesheet" href="http://www.toupiaopt.com/assets/plugins/font-awesome/css/font-awesome.min.css"><link rel="stylesheet" href="http://www.toupiaopt.com/assets/fonts/style.css"><link rel="stylesheet" href="http://www.toupiaopt.com/assets/css/main.css"><link rel="stylesheet" href="http://www.toupiaopt.com/assets/css/main-responsive.css"><link rel="stylesheet" href="http://www.toupiaopt.com/assets/plugins/iCheck/skins/all.css"><link rel="stylesheet" href="http://www.toupiaopt.com/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css"><link rel="stylesheet" href="http://www.toupiaopt.com/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css"><link id="skin_color" rel="stylesheet" href="./mywork_files/theme_light.css" type="text/css"><link rel="stylesheet" href="./mywork_files/print.css" type="text/css" media="print">
    <script src="./mywork_files/jquery-2.0.3.min.js"></script>
    <!--[if IE 7]>
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome-ie7.min.css" />
		<![endif]-->
    <!-- end: MAIN CSS -->
    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->


    <link rel="stylesheet" href="http://www.toupiaopt.com/assets/plugins/fullcalendar/fullcalendar/fullcalendar.css">
    <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
    <link href="http://www.toupiaopt.com/js/ui-dialog.css" rel="stylesheet"><link href="http://www.toupiaopt.com/css/jquery.datatables.css" rel="stylesheet"><link rel="stylesheet" href="http://www.toupiaopt.com/css/validate.css">
    <script src="./mywork_files/jquery-1.11.1.min.js"></script>
    <script src="./mywork_files/jquery.zclip.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="./mywork_files/dialog-plus-min.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#AspNetPager1 span").css("color", "#fff");
 $(".getvt").click(function () {

                var btn = $(this);

                btn.attr("disabled", true);
                var vid = $(this).attr("vid")
                $.post("/tools/submit_ajax.ashx?action=get_voteTask", { "vid": vid }, function (data) {

                    if (data.status == 1) {

                        location.href = data.url;

                    } else {

                        var d = dialog({
                            content: data.msg,
                        }).show();

                        setTimeout(function () {
                            d.close().remove();
                        }, 2000);
                        if (data.url != "" && data.url != null ) {
                            location.href = data.url;
                        }
                        btn.removeAttr("disabled");
                    }

                }, "json")


            })
        })
    </script>
<link type="text/css" rel="stylesheet" href="chrome-extension://kfgmnlgjmofpiicpgohgfpeabgpmhjdp/style.css"><script type="text/javascript" charset="utf-8" src="chrome-extension://kfgmnlgjmofpiicpgohgfpeabgpmhjdp/page_context.js"></script></head>
<body gtools_scp_screen_capture_injected="true">
    <form name="form1" method="post" action="mywork.php" id="form1">
<div>
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwULLTE4NDk2Mzc4NDkPZBYCAgQPZBYEAgUPFgIeC18hSXRlbUNvdW50AgMWBmYPZBYCZg8VBgExT+WFs+azqGJicjU1MuW+ruS/oeWQju+8jOaJk+W8gOaKleelqOmTvuaOpe+8jOWLvumAieOAkDTlj7fpgInmiYvoooHllobjgJHmipXnpagDMC4yATIJ5pyq5LiK5LygxQI8dGQgY2xhc3M9ImNlbnRlciIgc3R5bGU9InBhZGRpbmc6IDZweCI+PGEgc3R5bGU9InBhZGRpbmc6IDhweCAxMnB4OyIgIG9uY2xpY2s9InJldHVybiBjb25maXJtKCfor6Xku7vliqHkuLrlpJrmjqXku7vliqHvvIzmgbbmhI/kuIrkvKDlkIzkuIDkuKrlm77niYflsIblsIHlj7flpITnkIbvvIzlkIzkuIDkuKrku7vliqHkuIDkuKrlvq7kv6Hlj7flj6rlj6/ku6XlgZrkuIDmrKHjgIInKSIgIGNsYXNzPSJidG4gYnRuLXN1Y2Nlc3MiIGhyZWY9ImRvV29ya3MuYXNweD9pZD1EMzA1NjM3MUVBRjc1MTc4QkIzRjUxM0YyNkE4NUM0MSI+57un57ut5Lu75YqhPC9hPjwvdGQ+ZAIBD2QWAmYPFQYBMjggICAgIOS4jeWFs+azqCAgICAgICAgICAgICAgIOeOi+i/qu+8iOW5v+W3nuagoeS7o+ihqO+8iQQwLjI1ATEJ5pyq5LiK5LygqwE8dGQgY2xhc3M9ImNlbnRlciIgc3R5bGU9InBhZGRpbmc6IDZweCI+PGEgc3R5bGU9InBhZGRpbmc6IDhweCAxMnB4OyIgY2xhc3M9ImJ0biBidG4tc3VjY2VzcyIgaHJlZj0iZG9Xb3Jrcy5hc3B4P2lkPThGNUMxM0JBOUUwRUNEODZCMUE0NkU0NTZBN0ZFRDFDIj7nu6fnu63ku7vliqE8L2E+PC90ZD5kAgIPZBYCZg8VBgEzHueugOWNleaJq+egge+8jOenkumAgee6ouWMheOAggQwLjI1ATEJ5pyq5LiK5LygqwE8dGQgY2xhc3M9ImNlbnRlciIgc3R5bGU9InBhZGRpbmc6IDZweCI+PGEgc3R5bGU9InBhZGRpbmc6IDhweCAxMnB4OyIgY2xhc3M9ImJ0biBidG4tc3VjY2VzcyIgaHJlZj0iZG9Xb3Jrcy5hc3B4P2lkPTM4N0RDMUM5MUY1RjBBMUQ5MDcyOTAyQzFEMkUzM0NBIj7nu6fnu63ku7vliqE8L2E+PC90ZD5kAgcPDxYEHhBDdXJyZW50UGFnZUluZGV4AgEeC1JlY29yZGNvdW50AgNkZGQRFlsCgyBQdsNvbjwIH50YuyIf0W+XsnfbFaAotxOVmg==">
</div>

<div>

	<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="E5B9E7CC">
</div>
     

<style type="text/css">
    .nava {
        margin-left: 30px;
        font-size: 20px;
        line-height:42px;
    }
</style>
<script src="./mywork_files/dialog-plus-min.js"></script>
<link href="http://www.toupiaopt.com/js/ui-dialog.css" rel="stylesheet">
<!-- start: HEADER -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <!-- start: TOP NAVIGATION CONTAINER -->
    <div class="container">
        <div class="navbar-header">
            <!-- start: RESPONSIVE MENU TOGGLER -->
            <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="clip-list-2"></span>
            </button>
            <!-- end: RESPONSIVE MENU TOGGLER -->
            <!-- start: LOGO -->
            <a class="navbar-brand" href="index.php">[微信投票平台]
            </a>

            <!-- end: LOGO -->
        </div>
        <div class="navbar-tools">
            
              
              
              <script type="text/javascript">

                $(function () {
                    var isShowError = 0;
                      if (isShowError > 0) {
                          var d = dialog({
                              title: '投票教学视频',
                              content: '由于您在近期的投票中出现了严重的失误<br/>让店小二带你去学习学习最新的投票教程吧O(∩_∩)O~',
                              ok: function () {
                                  window.location.href = "/learn.php";
                              },
                              cancel: function () {
                                 
                                  return false;
                              },
                              okValue: "前去学习",
                              cancelDisplay: false
                   
                          }).showModal();
           
                      }
                  })
            </script>
            <!-- start: TOP NAVIGATION MENU -->
            <ul class="nav navbar-right">

                <!-- start: USER DROPDOWN -->
                <li class="dropdown current-user">
                    <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="mywork.php#">

                        <span class="username"><?php echo $_SESSION['username'] ?></span>
                        <i class="clip-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="info.php">
                                <i class="clip-user-2"></i>
                                &nbsp;个人信息
                            </a>
                        </li>

                        <li class="divider"></li>
                        <li>
                            <a href="pwd.php"><i class="clip-locked"></i>
                                &nbsp;修改密码 </a>
                        </li>
                        <li>
                            <a href="exit.php">
                                <i class="clip-exit"></i>
                                &nbsp;注销
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- end: USER DROPDOWN -->
            </ul>
            <!-- end: TOP NAVIGATION MENU -->
            
        </div>
    </div>
    <!-- end: TOP NAVIGATION CONTAINER -->
</div>






<!-- headerbar -->

        <div class="main-container">
            


<div class="navbar-content">
    <!-- start: SIDEBAR -->
    <div class="main-navigation navbar-collapse collapse" style="min-height: 454px; height: 0px;">
        <!-- start: MAIN MENU TOGGLER BUTTON -->
        <div class="navigation-toggler">
            <i class="clip-chevron-left"></i>
            <i class="clip-chevron-right"></i>
        </div>
        <!-- end: MAIN MENU TOGGLER BUTTON -->
        <!-- start: MAIN NAVIGATION MENU -->
        <ul class="main-navigation-menu">

            
              
              
              
              
            <li class="open">
                <a href="javascript:void(0)"><i class="clip-screen"></i>
                    <span class="title">个人信息 </span><i class="icon-arrow"></i>
                    <span class="selected"></span>
                </a>
                <ul class="sub-menu" style="display: block;">
                    <li>
                        <a href="info.php">
                            <span class="title">个人资料</span>

                        </a>
                    </li>
                    <li>
                        <a href="pwd.php">
                            <span class="title">修改密码</span>
                        </a>
                    </li>
                    <li>
                        <a href="payinfo.php">
                            <span class="title">账户详情 </span>
                        </a>
                    </li>
                    <li>
                        <a href="xianxia.php">
                            <span class="title">推广下线 </span>
                        </a>
                    </li>
                   <li>
                        <a href="tixian.php">
                            <span class="title">提现记录 </span>
                        </a>
                    </li>
                    <li>
                        <a href="exit.php">
                            <span class="title">安全退出</span>
                        </a>
                    </li>

                </ul>
            </li>
            <li class="open">
                <a href="javascript:void(0)"><i class="clip-cursor"></i>
                    <span class="title">任务中心 </span><i class="icon-arrow"></i>
                    <span class="selected"></span>
                </a>
                <ul class="sub-menu" style="display: block;">
                    <li>
                        <a href="work.php">
                            <span class="title">进行中任务</span>

                        </a>
                    </li>
                    <li>
                        <a href="mywork.php">
                            <span class="title">做过的任务</span>
                        </a>
                    </li>
                      
                    <li>
                        <a href="tousu.php">
                            <span class="title">被投诉的任务 </span>
                        </a>
                    </li>
                     
                </ul>
            </li>
            <li>
                <a href="javascript:void(0)"><i class="clip-cog-2"></i>
                    <span class="title">帮助中心 </span><i class="icon-arrow"></i>
                    <span class="selected"></span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="help.php">
                            <span class="title">新手帮助</span>

                        </a>
                    </li>
                    <li>
                        <a href="introduce.php">
                            <span class="title">平台介绍</span>
                        </a>
                    </li>
                    <li>
                        <a href="contact.php">
                            <span class="title">联系方式 </span>
                        </a>
                    </li>
                </ul>
            </li>
            
        </ul>
        <!-- end: MAIN NAVIGATION MENU -->
    </div>
    <!-- end: SIDEBAR -->
</div>





            <div class="main-content">
                <div class="container" style="min-height: 760px;">
                    <div class="row">
                        <div class="col-sm-12">

                            <!-- start: PAGE TITLE & BREADCRUMB -->
                            <ol class="breadcrumb">
                                <li>
                                    <i class="clip-home-3"></i>
                                    <a href="index.php">主页
									</a>
                                </li>
                                <li class="active">我的任务
								</li>

                            </ol>
                            <div class="page-header">

                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- start: TEXT FIELDS PANEL -->

                            <div class="panel-body">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <!-- panel-btns -->
                            <h3 class="panel-title">我的任务</h3>
                          
                        </div>
                        <div class="panel-body">

                            <div class="table-responsive">
                                <div id="table1_wrapper" class="dataTables_wrapper no-footer">
                                <table id="table"></table>
                                    


                                 </div>
                                        </div>
                                    </div>


                                </div>
                                <!-- end: TEXT FIELDS PANEL -->




                                <!-- mainpanel -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
<div class="footer clearfix">
    <div class="footer-inner" style="text-align: center; float: none">
        2015 © 微信投票平台 备案号：<a href="http://www.miitbeian.gov.cn/state/outPortal/loginPortal.action">豫ICP备15000947号-2</a>
    </div>
    <div class="footer-items">
        <span class="go-top"><i class="clip-chevron-up"></i></span>
    </div>
</div>
<script src="./mywork_files/z_stat.php" language="JavaScript"></script><script src="./mywork_files/core.php" charset="utf-8" type="text/javascript"></script><a href="http://www.cnzz.com/stat/website.php?web_id=1256602797" target="_blank" title="站长统计" style="display: none;">站长统计</a>
<script type="text/javascript">
    $(function() {
    $("a[title='站长统计']").hide();
    })
</script>
        <script src="./mywork_files/jquery-ui-1.10.2.custom.min.js"></script>
        <script src="./mywork_files/bootstrap.min.js"></script>
        <script src="./mywork_files/bootstrap-hover-dropdown.min.js"></script>
        <script src="./mywork_files/jquery.blockUI.js"></script>
        <script src="./mywork_files/jquery.icheck.min.js"></script>
        <script src="./mywork_files/jquery.mousewheel.js"></script>
        <script src="./mywork_files/perfect-scrollbar.js"></script>
        <script src="./mywork_files/less-1.5.0.min.js"></script>
        <script src="./mywork_files/jquery.cookie.js"></script>
        <script src="./mywork_files/bootstrap-colorpalette.js"></script>
        <script src="./mywork_files/main.js"></script>
        <!-- end: MAIN JAVASCRIPTS -->
    
        <script>
            jQuery(document).ready(function () {
                Main.init();
               
            });
        </script>
    </form>


<script src="jquery-1.12.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="table/src/bootstrap-table.js"></script>
<script src="table/src/locale/bootstrap-table-zh-CN.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    function operateFormatter(value, row, index) {
        var id=row.id;
        return [
            '<a class="like btn btn-success " href="#" title="开始任务">',
            '继续任务',
            '</a>'
        ].join('');
    }
    window.operateEvents = {
        'click .like': function (e, value, row, index) {
           
            var id=row.id;
            var pid=row.pid;
            var orderid=row.orderid;
            window.location.href='vilidate.php?pid='+pid+'&orderid='+orderid;
            
        },
        'click .view': function (e, value, row, index) {
           
        },
        'click .remove': function (e, value, row, index) {
            $table.bootstrapTable('remove', {
                field: 'id',
                values: [row.id]
            });
        }
    };      
    $('#table').bootstrapTable({
    columns: [{
        field: 'orderid',
        title: '订单编号'
    }, {
        field: 'pid',
        title: '任务编号'
    }, {
        field: 'title',
        title: '任务名称'
    }, {
        field: 'price2',
        title: '单价(元)'
    }, {
        field: 'num',
        title: '剩余数量'
    }, {
        field: 'onetime',
        title: '可接次数'
    }, {
        field: 'tool',
        title: '操作',
        events: operateEvents,
        formatter: operateFormatter
    }],
    //pagination:true,
    url:'getAllData12.php'
});
});
</script>
</body>
</html>