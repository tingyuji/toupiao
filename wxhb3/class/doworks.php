<!DOCTYPE html>
<!-- saved from url=(0073)http://www.toupiaopt.com/doworks.php?id=2EFC52211E3FF097127C4C88196F0E20 -->
<html xmlns="http://www.w3.org/1999/xhtml" class="ks-webkit537 ks-webkit ks-chrome42 ks-chrome"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><script charset="utf-8" src="./doworks_files/preview-min.js" async=""></script><script charset="utf-8" src="./doworks_files/urlsInput-min.js" async=""></script><script charset="utf-8" src="./doworks_files/auth-min.js" async=""></script><script charset="utf-8" src="./doworks_files/theme-min.js" async=""></script><script charset="utf-8" src="./doworks_files/index-min.js" async=""></script><script charset="utf-8" src="./doworks_files/logger-min.js" async=""></script><script charset="utf-8" src="./doworks_files/event-min.js" async=""></script><script charset="utf-8" src="./doworks_files/querystring-min.js" async=""></script><script charset="utf-8" src="./doworks_files/io-min.js" async=""></script><script charset="utf-8" src="./doworks_files/promise-min.js" async=""></script><script charset="utf-8" src="./doworks_files/anim-base-min.js" async=""></script><script charset="utf-8" src="./doworks_files/anim-transition-min.js" async=""></script><script charset="utf-8" src="./doworks_files/event-gesture-min.js" async=""></script><script charset="utf-8" src="./doworks_files/event-dom-base-min.js" async=""></script><script charset="utf-8" src="./doworks_files/query-selector-base-min.js" async=""></script><script charset="utf-8" src="./doworks_files/dom-base-min.js" async=""></script><script charset="utf-8" src="./doworks_files/node-min.js" async=""></script><script charset="utf-8" src="./doworks_files/json-base-min.js" async=""></script><script charset="utf-8" src="./doworks_files/event-base-min.js" async=""></script><script charset="utf-8" src="./doworks_files/event-custom-min.js" async=""></script><script charset="utf-8" src="./doworks_files/attribute-min.js" async=""></script><script charset="utf-8" src="./doworks_files/base-min.js" async=""></script><script charset="utf-8" src="./doworks_files/index-min(1).js" async=""></script><script charset="utf-8" src="./doworks_files/index-min(2).js" async=""></script><title>
	任务中心
</title>
    <!-- start: META -->
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0"><meta name="apple-mobile-web-app-capable" content="yes"><meta name="apple-mobile-web-app-status-bar-style" content="black"><meta name="description"><meta name="author">
    <!-- end: META -->
    <!-- start: MAIN CSS -->
    <link rel="stylesheet" href="http://www.toupiaopt.com/assets/plugins/bootstrap/css/bootstrap.min.css"><link rel="stylesheet" href="http://www.toupiaopt.com/assets/plugins/font-awesome/css/font-awesome.min.css"><link rel="stylesheet" href="http://www.toupiaopt.com/assets/fonts/style.css"><link rel="stylesheet" href="http://www.toupiaopt.com/assets/css/main.css"><link rel="stylesheet" href="http://www.toupiaopt.com/assets/css/main-responsive.css"><link rel="stylesheet" href="http://www.toupiaopt.com/assets/plugins/iCheck/skins/all.css"><link rel="stylesheet" href="http://www.toupiaopt.com/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css"><link rel="stylesheet" href="http://www.toupiaopt.com/assets/plugins/perfect-scrollbar/src/perfect-scrollbar.css"><link id="skin_color" rel="stylesheet" href="./doworks_files/theme_light.css" type="text/css">
   
 <script src="./doworks_files/jquery-2.0.3.min.js"></script>
 <style type="text/css">
        .webuploader-element-invisible {
            clip: rect(1px, 1px, 1px, 1px);
            position: absolute !important;
        }.webuploader-pick {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #e1e1e1;
    color: #333;
    cursor: pointer;
    display: inline-block;
    height: 30px;
    line-height: 30px;
    overflow: hidden;
    position: relative;
    text-align: center;
    width: 65px;
}
    </style>
    <!--[if IE 7]>
		<link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome-ie7.min.css" />
		<![endif]-->
    <!-- end: MAIN CSS -->
    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
    <link rel="stylesheet" href="http://www.toupiaopt.com/assets/plugins/fullcalendar/fullcalendar/fullcalendar.css">
    <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->

    <script src="./doworks_files/seed-min.js" charset="utf-8"></script>

    <script type="text/javascript">

        $(function () {
            var d = dialog({
                content: '<img src="/images/loading.gif"/> 上传中'
            });
            var ds = dialog({
                content: '<img src="/images/loading.gif"/> 处理中'
            });
            $(".nodo").click(function () {
                var id = $(this).attr("id")
                $.ajax({
                    url: "/tools/submit_ajax.ashx?action=nodo",
                    type: "POST",
                    data: { "id": "" + id + "" },
                    beforeSend: function (e) {
                        ds.showModal();
                    },
                    success: function (data) {
                        if (data.status == 1) { //成功
                            var d = dialog({ content: data.msg }).show();
                            setTimeout(function () {
                                d.close().remove();
                                location.href = data.url;
                            }, 2000);
                        } else { //失败
                            dialog({ title: '提示', content: data.msg, okValue: '确定', ok: function () { } }).showModal();

                        }
                        ds.close().remove();
                    }, dataType: "json"
                });
            })

            $(".noyc").click(function () {
                var id = $(this).attr("id")


                if(confirm("确认报告异常吗？")){

                    $.ajax({
                        url: "/tools/submit_ajax.ashx?action=noyc",
                        type: "POST",
                        data: { "id": "" + id + "" },
                        beforeSend: function (e) {
                            ds.showModal();
                        },
                        success: function (data) {
                            if (data.status == 1) { //成功
                                var d = dialog({ content: data.msg }).show();
                                setTimeout(function () {
                                    d.close().remove();
                                    location.href = data.url;
                                }, 2000);
                            } else { //失败
                                dialog({ title: '提示', content: data.msg, okValue: '确定', ok: function () { } }).showModal();

                            }
                            ds.close().remove();
                        }, dataType: "json"
                    });}
            })

        
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
                        data: { "image": "" + this.result + "" },
                        beforeSend: function (e) {
                            d.showModal();
                        },
                        success: function (data) {
                          
                            if(data.status=="1"){
                                $("#uploadimg").html("<img with=\"200\" height=\"300\" src=\"" + 'http://www.xiaomutong.com.cn/toupiao2/'+data.path + "\"/>");
                                $("#imgfile").val(data.path);
                                d.close().remove();
                            }else
                            {
                                d.close().remove();
                                var f = dialog({
                                    content: data.msg
                                }).showModal();
                                setTimeout(function () {
                                    f.close().remove();
                                   
                                }, 1000);
                            }

                        }, dataType: "json"
                    });
                }
            });
        })
      
    </script>
    

    <style type="text/css">
        .page-header p {
            word-wrap: break-word;
            width: 360px;
        }
    </style>
<link type="text/css" rel="stylesheet" href="chrome-extension://kfgmnlgjmofpiicpgohgfpeabgpmhjdp/style.css"><script type="text/javascript" charset="utf-8" src="chrome-extension://kfgmnlgjmofpiicpgohgfpeabgpmhjdp/page_context.js"></script><link charset="utf-8" href="http://g.tbcdn.cn/kg/uploader/6.2.7/themes/imageUploader/style-min.css" rel="stylesheet"></head>
<body gtools_scp_screen_capture_injected="true">
    <form name="form1" method="post" action="addworks.php" id="form1">
<div>
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwULLTE5MTY5OTgwMjMPZBYCAgQPZBYMAgIPFgIeBFRleHQFeeemj+WIqeadpeWVpu+8geOAkOazsOmHkeaJgOOAkemZkOmmluasoSDnroDljZXkuIvovb3ms6jlhozku7vliqEg57O757uf6YCBOS42OOWFgyDlj6/mj5DnjrDjgILnpZ3lpKflrrbmlrDlubTlv6vkuZDvvIHvvIFkAgYPFgIfAAUG5YWo5Zu9ZAIHDxYCHwAFjgMx5omr56CBIOazqOWGjCDjgJDmiKrlm77jgJHkuIvovb3lkI7nmbvpmYY8YnIgLz4y6YCJ5oup4oCc6LWE5Lqn4oCdLeKAnOWOu+W8gOaIt+KAnSDmiJDlip/lkI7jgJDmiKrlm77jgJE8YnIgLz48YnIgLz7ms6jvvJrmiKrlm77pnIDmi7zlm74g5rOo5oSP6Zyy5Ye65omL5py65Y+35ZKM5pe26Ze0IOS4pOW8oOWbvuaXtumXtOimgeS4gOiHtCDns7vnu5/otaDpgIE5LjY45YWDIOesrOS6jOWkqeeZu+W9leWNs+WPr+aPkOeOsCDkvYbmmK/mnJ/pl7Tlj6/og73kvJrmnInlrpjmlrnnlLXor53lm57orr8g6ZyA5o6l5ZCs55S16K+d5omN5Y+v5LulIOS4jeeEtumihuS4jeWIsOezu+e7n+i1oOmAgeeahOmSsTxiciAvPuelneWkp+WutuaWsOW5tOW/q+S5kOOAguaBreWWnOWPkei0ou+8ge+8ge+8ge+8gWQCCA8PFgIeCEltYWdlVXJsBTpodHRwOi8vaW1nMS50b3VwaWFvcHQuY29tLzIwMTYwMi8wOC8yMDE2MDIwODIxMDQ1NDMzMzAuanBnZGQCCQ8PFgQfAQU6aHR0cDovL2ltZzEudG91cGlhb3B0LmNvbS8yMDE2MDIvMDgvMjAxNjAyMDgyMTA1MzU1NTczLmpwZx4HVmlzaWJsZWdkZAIKDw8WBB8ABSTplb/mjInkuoznu7TnoIHkv53lrZjliLDmnKzlnLDmiavmj48fAmdkZGR8+sIqKRkcW3xxhG769JFPo9mN73+RuwLPySBM39Idmw==">
</div>

<div>

	<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="5C01167B">
	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEWBwL1rMrpBALcs5DpDgKsqunrAQL7pM2ECwKLy/rqDgKgyfWVBwLh777wDOYousYuB66zh97YjtrcHVghA1XxsWATJVO1DywIpxCs">
</div>
        

<style type="text/css">
    .nava {
        margin-left: 30px;
        font-size: 20px;
        line-height:42px;
    }
</style>
<script src="./doworks_files/dialog-plus-min.js"></script>
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
                    <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="doworks.php?id=2EFC52211E3FF097127C4C88196F0E20#">

                        <span class="username">jiguoliang517581@126.com</span>
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
                                <li class="active">做任务
                                </li>

                            </ol>
                            <div class="page-header">
                                福利来啦！【泰金所】限首次 简单下载注册任务 系统送9.68元 可提现。祝大家新年快乐！！
                                
                                
  <input type="hidden" name="turl" id="turl" value="work.php">
                                <p>

                                    <a>区域：全国</a>
                                </p>
                                <p>
                                    描述：1扫码 注册 【截图】下载后登陆<br>2选择“资产”-“去开户” 成功后【截图】<br><br>注：截图需拼图 注意露出手机号和时间 两张图时间要一致 系统赠送9.68元 第二天登录即可提现 但是期间可能会有官方电话回访 需接听电话才可以 不然领不到系统赠送的钱<br>祝大家新年快乐。恭喜发财！！！！
                                </p>
                                <p>
                                    <a href="javascript:void(0)" id="45821851" class="nodo btn btn-success">隐藏此任务</a>
                                  
                                    <a style="float:right;" href="javascript:void(0)" id="45821851" class="noyc btn btn-success">报告任务过期</a>
                                </p>
                            </div>
                            <!-- end: PAGE TITLE & BREADCRUMB -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- start: TEXT FIELDS PANEL -->

                            <div class="panel-body">

                                <div class="panel-heading" style="border: 1px solid #eee;">
                                    <!-- panel-btns -->
                                    样例
                                </div>
                                <div class="panel-body" style="border: 1px solid #eee;">

                                    <img id="showimg" src="./doworks_files/201602082104543330.jpg" style="height:300px;width:200px;border-width:0px;"><br>
                                    <img id="qrShow" src="./doworks_files/201602082105355573.jpg" style="height:200px;width:200px;border-width:0px;"><br>
                                    <span id="qrShowlable">长按二维码保存到本地扫描</span>
                                    <p style="margin-top: 10px;">
                                        <label class="left" style="line-height: 35px;">点击浏览上传图片：</label>

                                          <input type="hidden" name="imgfile" id="imgfile">
 <input type="hidden" name="imghash" id="imghash">
  <input type="hidden" name="imghashcenter" id="imghashcenter">
                                        <input type="hidden" name="imgmd5" id="imgmd5">

                                         </p><div class="grid">
                                            <a href="javascript:void(0)" class="g-u ks-uploader-button imageUploader-button"><span class="btn-text">上传文件</span><div class="file-input-wrapper" style="overflow: hidden;"><input type="file" class="g-u file-input" id="J_UploaderBtn" value="上传文件" accept="image/*" name="Filedata"></div></a>
                                          
                                        </div>
                                         <ul id="J_UploaderQueue" class="ks-uploader-queue imageUploader-queue"></ul>
                                    <p></p>
                                    <br>
                                    <br>
                                    <input type="submit" name="OK" value="提交" onclick="return confirm(&#39;确认要提交信息吗,如果未按要求上传，多次违规封号&#39;);" id="OK" class="btn btn-info">

                                </div>

                            </div>

                        </div>
                        <!-- mainpanel -->
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
<script src="./doworks_files/z_stat.php" language="JavaScript"></script><script src="./doworks_files/core.php" charset="utf-8" type="text/javascript"></script><a href="http://www.cnzz.com/stat/website.php?web_id=1256602797" target="_blank" title="站长统计" style="display: none;">站长统计</a>
<script type="text/javascript">
    $(function() {
    $("a[title='站长统计']").hide();
    })
</script>
  
        <script>document.domain="toupiaopt.com";</script>
        
        <script>

         
            var S = KISSY;
            S.config({
                packages:[
                    {
                        name:"kg",
                        path:"//g.tbcdn.cn/kg/",
                        charset:"utf-8",
                        ignorePackageNameInUri:true
                    }
                ]
            });

            if (S.Config.debug) {
                var srcPath = "../";
                S.config({
                    packages:[
                        {
                            name:"kg/uploader/6.2.7",
                            path:srcPath,
                            charset:"utf-8",
                            ignorePackageNameInUri:true
                        }
                    ]
                });
            }

            S.use('kg/uploader/6.2.7/index,kg/uploader/6.2.7/themes/imageUploader/index,kg/uploader/6.2.7/themes/imageUploader/style.css', function (S, Uploader,ImageUploader) {
                //上传组件插件
                var plugins = 'kg/uploader/6.2.7/plugins/auth/auth,' +
                        'kg/uploader/6.2.7/plugins/urlsInput/urlsInput,' +
                        'kg/uploader/6.2.7/plugins/preview/preview';

                S.use(plugins,function(S,Auth,UrlsInput,Preview){
                    var uploader = new Uploader('#J_UploaderBtn',{
                        // 上传方式切成flash
                        
                        type : "iframe",
                       
                        data:{"vtid":118219,"time":"2016-02-08","getvtid":45821851,"sign":"753AF024176980CE5292A8CA5B9F0358"},
                          
                        action:"http://imgimgimgimgimgimgimg2.toupiaopt.com/tools/upload_ajax.ashx?action=UpLoadFile"
                    });
                    //使用主题
                    uploader.theme(new ImageUploader({
                        queueTarget:'#J_UploaderQueue'
                    }))
                    //验证插件
                    uploader.plug(new Auth({
                        max:1
                       
                    }))
                            //url保存插件
                   .plug(new UrlsInput({target:'#imgfile'}));
                    uploader.on('success', function (ev) {

   

                        var index = ev.index, file = ev.file;
                        //服务器端返回的结果集

                        var result = ev.result;
                       
                        $("#imgfile").val(result.url); 
                     $("#imgmd5").val(result.md5);
                       
     $.ajax({
                            type: "get",
                            async: false,
                            url: "http://imgimgimgimgimgimg5.toupiaopt.com/go.php?ImgPath="+result.url+"&type=2",
                            dataType: "jsonp",
                            jsonp: "callbackparam",//传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(默认为:callback)
                            jsonpCallback: "success_jsonpCallback",//自定义的jsonp回调函数名称，默认为jQuery自动生成的随机函数名
                            success: function (json) {
                             
                                if(json[0].hash!="0"){
                                    $("#imghash").val(json[0].hash);
                                }
                            },
                            error: function () {
                              
                            }
                        });
                        $.ajax({
                            type: "get",
                            async: false,
                            url: "http://imgimgimgimgimgimg5.toupiaopt.com/go.php?ImgPath="+result.url+"&type=3",
                            dataType: "jsonp",
                            jsonp: "callbackparam",//传递给请求处理程序或页面的，用以获得jsonp回调函数名的参数名(默认为:callback)
                            jsonpCallback: "success_jsonpCallback2",//自定义的jsonp回调函数名称，默认为jQuery自动生成的随机函数名
                            success: function (json) {
                                if(json[0].hash!="0"){
                                    $("#imghashcenter").val(json[0].hash);
                                }
                            },
                            error: function () {
                              
                            }
                        });
                         
                        $("#J_UploaderQueue").html("<img with=\"200\" height=\"300\" src=\"http://imgimgimgimgimgimgimg2.toupiaopt.com" + result.url + "\"/>");
                    });
                    ;
                });
            })
        </script>
    
        <script src="./doworks_files/jquery-ui-1.10.2.custom.min.js"></script>
        <script src="./doworks_files/bootstrap.min.js"></script>
         <script type="text/javascript">

            function setCopy(content){    
                if(navigator.userAgent.toLowerCase().indexOf('ie') > -1) {    
                    clipboardData.setData('Text',content);    
                    alert ("该地址已经复制到剪切板");    
                } else {    
                    prompt("请手动长按文本框内的网址内容复制:",content);    
                }    
            }    
        </script>
    </form>


<div tabindex="-1" aria-labelledby="title:1456721189252" aria-describedby="content:1456721189252" style="display: none; position: absolute; outline: 0px; left: 596px; top: 222px;"><div i="dialog" class="ui-dialog"><div class="ui-dialog-arrow-a"></div><div class="ui-dialog-arrow-b"></div><table class="ui-dialog-grid"><tbody><tr><td i="header" class="ui-dialog-header" style="display: none;"><button i="close" class="ui-dialog-close" title="cancel">×</button><div i="title" class="ui-dialog-title" id="title:1456721189252"></div></td></tr><tr><td i="body" class="ui-dialog-body"><div i="content" class="ui-dialog-content" id="content:1456721189252"><img src="./doworks_files/loading.gif"> 上传中</div></td></tr><tr><td i="footer" class="ui-dialog-footer" style="display: none;"><div i="statusbar" class="ui-dialog-statusbar" style="display: none;"></div><div i="button" class="ui-dialog-button"></div></td></tr></tbody></table></div></div><div tabindex="-1" aria-labelledby="title:1456721189253" aria-describedby="content:1456721189253" style="display: none; position: absolute; outline: 0px; left: 596px; top: 222px;"><div i="dialog" class="ui-dialog"><div class="ui-dialog-arrow-a"></div><div class="ui-dialog-arrow-b"></div><table class="ui-dialog-grid"><tbody><tr><td i="header" class="ui-dialog-header" style="display: none;"><button i="close" class="ui-dialog-close" title="cancel">×</button><div i="title" class="ui-dialog-title" id="title:1456721189253"></div></td></tr><tr><td i="body" class="ui-dialog-body"><div i="content" class="ui-dialog-content" id="content:1456721189253"><img src="./doworks_files/loading.gif"> 处理中</div></td></tr><tr><td i="footer" class="ui-dialog-footer" style="display: none;"><div i="statusbar" class="ui-dialog-statusbar" style="display: none;"></div><div i="button" class="ui-dialog-button"></div></td></tr></tbody></table></div></div></body></html>