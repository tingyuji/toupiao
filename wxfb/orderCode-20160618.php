<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location:home.php"); //重新定向到其他页面
    exit();
}
?>
<!DOCTYPE html>
<!-- saved from url=(0039)http://www.toupiaopingtai.com/help.php -->
<html xmlns="http://www.w3.org/1999/xhtml" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><title>
交易单号
</title><link href="css/style.default.css" rel="stylesheet">
    <script type="text/javascript" charset="utf-8" src="./help_files/jquery-1.11.1.min.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
<style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style><link type="text/css" rel="stylesheet" href="chrome-extension://kfgmnlgjmofpiicpgohgfpeabgpmhjdp/style.css"><script type="text/javascript" charset="utf-8" src="chrome-extension://kfgmnlgjmofpiicpgohgfpeabgpmhjdp/page_context.js"></script></head>
<body gtools_scp_screen_capture_injected="true">
    <section>


        


<div class="leftpanel">

    <div class="logopanel">
        <h1><span>[</span> 微信投票平台 <span>]</span></h1>
    </div>
    <!-- logopanel -->

    <br>

    
        <div class="panel panel-default">
            <div class="panel-heading">账户信息</div>
            <div class="panel-body">
                <ul class="nav nav-pills nav-stacked nav-bracket">
                    <li><a href="javascript:void(0)"><span>欢迎，<?php echo $_SESSION['username'] ?></span></a></li>
                    <li><a href="info.php"><span>个人资料</span></a></li>
                    <li><a href="pwd.php"><span>修改密码</span></a></li>
                    <li><a href="info.php"><span>账户详情</span></a></li>
                    
                    <li><a href="userbind.php"><span>代理详情</span></a></li>
                    <li><a href="ticheng.php"><span>月度提成</span></a></li>
                
                    <li class=""><a href="payinfo.php"><span>充值明细</span></a></li>
                    <li class=""><a href="payout.php"><span>支出明细</span></a></li>
                    <li class=""><a href="exit.php"><span>安全退出</span></a></li>
                    <li class="">
                        <a href="./help_files/help.html">
                            <span class="title">交易单号</span>

                        </a>
                    </li>
                </ul>

            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">任务中心</div>
            <div class="panel-body">
                <ul class="nav nav-pills nav-stacked nav-bracket">
                    <li><a href="add.php"><span>发布任务</span></a></li>
                    <li><a href="mywork.php"><span>我的任务</span></a></li>
                    <li><a href="tousu.php"><span>投诉列表</span></a></li>
                 
                </ul>
            </div>
        </div>
        
    </div><span style="display:none">
<script src="./help_files/z_stat.php" language="JavaScript"></script><script src="./help_files/core.php" charset="utf-8" type="text/javascript"></script><a href="http://www.cnzz.com/stat/website.php?web_id=1257161489" target="_blank" title="站长统计">站长统计</a></span>
    <!-- leftpanelinner -->

<!-- leftpanel -->

        <div class="mainpanel">

            

<style type="text/css">
    .navs {
        line-height: 50px;
        margin-left: 30px;
        font-size: 17px;
        float: left;
        color: black;
        text-decoration: none;
    }

        .navs:hover {
            text-decoration: none;
        }
</style>
<div class="headerbar">

    <a class="menutoggle"><i class="fa fa-bars"></i></a>
    <a class="navs" href="index2.php">首页
    </a>

    <a class="navs" href="help.php">帮助中心
    </a>
    

    <a class="navs" href="pay.php">在线充值
    </a>
    <!--
    <a class="navs" href="level.php">代理升级
    </a>
    -->  
    <a class="navs" href="contact.php">联系方式
    </a>
  

    <div class="header-right">
        <ul class="headermenu">

            <li>
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <?php echo $_SESSION['username'] ?>
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-usermenu pull-right">

                        <li><a href="exit.php"><i class="glyphicon glyphicon-log-out"></i>注销</a></li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
    
    <!-- header-right -->

</div>
<!-- headerbar -->



            <div class="contentpanel">
                <div class="panel panel-default">
                    <div class="panel-heading">

                        <!-- panel-btns -->
                        <h3 class="panel-title">交易单号</h3>
                    </div>
                    <div class="panel-body">

                     
                        <table id="table1" class="table dataTable no-footer" role="grid" aria-describedby="table1_info">

                            <tbody>

                                
                                        <tr class="gradeA odd" role="row">

                                            <td>
                                            <img style="height:300px;widht:220px;" src="imgs/89.pic.jpg" />
                                            </td>
                                            <td>
                                            <img style="height:300px;widht:220px;" src="imgs/90.pic.jpg" />
                                            </td>
                                            <td>
                                            <img style="height:300px;widht:220px;" src="imgs/91.pic.jpg" />
                                            </td>
                                        </tr>

                                    

                            </tbody>
                        </table>
                        
<!-- AspNetPager V7.2 for VS2005 & VS2008  Copyright:2003-2008 Webdiyer (www.webdiyer.com) -->
<!--记录总数只有一页，AspNetPager已自动隐藏，若需在只有一页数据时显示AspNetPager，请将AlwaysShow属性值设为true！-->
<!-- AspNetPager V7.2 for VS2005 & VS2008 End -->


                        <!-- table-responsive -->

                    </div>
                    <!-- panel-body -->
                </div>
            </div>
            <!-- contentpanel -->

        </div>
        <!-- mainpanel -->
    </section>
    <script src="./help_files/jquery-migrate-1.2.1.min.js"></script>
    <script src="./help_files/jquery-ui-1.10.3.min.js"></script>
    <script src="./help_files/bootstrap.min.js"></script>
    <script src="./help_files/modernizr.min.js"></script>
    <script src="./help_files/jquery.sparkline.min.js"></script>
    <script src="./help_files/toggles.min.js"></script>
    <script src="./help_files/retina.min.js"></script>
    <script src="./help_files/jquery.cookies.js"></script>
    <script src="./help_files/morris.min.js"></script>
    <script src="./help_files/raphael-2.1.0.min.js"></script>
    <script src="./help_files/custom.js"></script>



</body></html>