<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location:home.php"); //重新定向到其他页面
    exit();
}
?>
<!DOCTYPE html>
<!-- saved from url=(0049)copy.php?id=161342 -->
<html xmlns="http://www.w3.org/1999/xhtml" class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><title>
	修改任务
</title><link href="css/style.default.css" rel="stylesheet">
    <script src="./copy_files/jquery-1.11.1.min.js"></script>
    <script src="./copy_files/PCASClass.js"></script>
    <link href="js/ui-dialog.css" rel="stylesheet">
    <script type="text/javascript" charset="utf-8" src="./copy_files/jquery.form.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="./copy_files/Validform_v5.3.2_min.js"></script>
    <script src="My97DatePicker/WdatePicker.js"></script>
    <link href="My97DatePicker/skin/WdatePicker.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/validate.css">
    <script src="./copy_files/dialog-plus-min.js"></script>
    <script type="text/javascript" charset="utf-8" src="./copy_files/common.js"></script>
    <script type="text/javascript">
        $(function () {
            //初始化表单
            AjaxInitForm('#updateForm', '#btnSubmit', 1);

        });
    </script>


   
       <script type="text/javascript" src="js/purl.js"></script> 
    <script type="text/javascript">
$(document).ready(function(){
            var url = $.url(); 
            var id=url.param('id'); 

            
            $.ajax({
                url: "get01.php",
                type: "POST",
                data: {
                    id:id
                },
                dataType:'json',
                success: function (data) {
                   //console.log(data);
                   var total=data.total;
                   var rows=data.rows;
                   var row=rows[0];
                   var type=row['type'];
                   var wx=row['wx'];
                   var url=row['url'];
                   var img1=row['img1'];
                   var img2=row['img2'];
                   var intro=row['intro'];
                   var memo=row['memo'];
                   var title=row['title'];
                   var num=row['num'];
                   var price=row['price'];
                   var intro=row['intro'];
       
                   $('#gzh').val(wx);
                   $('#type').val(type);
                   $('#name').val(title);
                   $('#tpurl').val(url);
                   $('#num').val(num);
                   $('#imgfile').val(img1);
                   $('#qrimgfile').val(img2);

                   $('#img1').attr('src',img1);
                   if(img2!=''){
                        $('#qrdivimg').append('<img style="width:200px;height:300px;" id="img2" src="'+img2+'">');
                   }
                   

                   $('#jianjie').val(intro);
                   $('#beizhu').val(memo);
                   

                   

                }
            });

});
    </script>


    <script type="text/javascript">
        $(function () {
             new PCAS("province", "city","");
   $("input[name='typeid']").data("allprice", $("#danjia").html());
              $("input[name='typeid']").change(function () {
                return;
                var selectid = $(this).val();
                if (selectid == 1) {
                    $("#selectquyu").show();
                    

                } else {
                    $("#selectquyu").hide();
                  
                }
                 if (selectid == 2) {
                     $("#danjia").html($("input[name='typeid']").data("allprice"));
                     for (var i = 0; i <= 1; i++) {
                        $("#danjia option:eq(0)").remove();
                    }
                } else if (selectid == 3) {
                      $("#danjia").html($("input[name='typeid']").data("allprice"));
                    for (var i = 0; i <= 6; i++) {
                        $("#danjia option:eq(0)").remove();
                    }
                }
                else {

                    $("#danjia").html($("input[name='typeid']").data("allprice"));
                }

            })
           var typeidshow = $("input[name='typeid']:checked").val();
            if (typeidshow == 1) {
                $("#selectquyu").show();
            } else if (typeidshow == 2) {
                $("#danjia").html($("input[name='typeid']").data("allprice"));
                for (var i = 0; i <= 1; i++) {
                    $("#danjia option:eq(0)").remove();
                }
            } else if (typeidshow == 3) {
                $("#danjia").html($("input[name='typeid']").data("allprice"));
                for (var i = 0; i <= 6; i++) {
                    $("#danjia option:eq(0)").remove();
                }
            }
        });
    </script>
    <script type="text/javascript">

        $(function () {
            var d = dialog({
                content: '<img src="/images/loading.gif"/> 上传中'
            });

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
                        data: { "image": "" + this.result + "", "imgtype":0 },
                        beforeSend: function (e) {
                            d.showModal();
                        },
                        success: function (data) {
                            $("#divimg").html("<br/><br/><img with=\"200\" height=\"300\" src=\"http://www.vxtoupiao.com/wxfb/" + data.path + "\"/>");
                            $("#imgfile").val(data.path).attr("readOnly", "true");
                            d.close().remove();
                        }, dataType: "json"
                    });
                }
            });

            $('#qruploadInput').change(function () {
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
                            d.showModal();
                        },
                        success: function (data) {
                            $("#qrdivimg").html("<br/><br/><img with=\"200\" height=\"300\" src=\"http://www.vxtoupiao.com/wxfb/" +data.path + "\"/>");
                            $("#qrimgfile").val("/upload" +data.path).attr("readOnly", "true");
                            d.close().remove();
                        }, dataType: "json"
                    });
                }
            });
        })

    </script>
    <style type="text/css">
        .left {
            float: left;
            line-height: 20px;
        }
  #typeid input {
            margin-left: 20px;
        }

        #typeid label {
            margin-left: 10px;
        }
    </style>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->
<style type="text/css">.jqstooltip { position: absolute;left: 0px;top: 0px;visibility: hidden;background: rgb(0, 0, 0) transparent;background-color: rgba(0,0,0,0.6);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000);-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#99000000, endColorstr=#99000000)";color: white;font: 10px arial, san serif;text-align: left;white-space: nowrap;padding: 5px;border: 1px solid white;z-index: 10000;}.jqsfield { color: white;font: 10px arial, san serif;text-align: left;}</style><link type="text/css" rel="stylesheet" href="chrome-extension://kfgmnlgjmofpiicpgohgfpeabgpmhjdp/style.css"><script type="text/javascript" charset="utf-8" src="chrome-extension://kfgmnlgjmofpiicpgohgfpeabgpmhjdp/page_context.js"></script></head>
<body gtools_scp_screen_capture_injected="true">
    <form name="updateForm" method="post" action="updateForm.php" id="updateForm" class="form-horizontal form-bordered" url="updateForm.php">
<div>
<input type="hidden" name="__VIEWSTATE" id="__VIEWSTATE" value="/wEPDwUKLTQxODUxMTAzMA9kFgICBA9kFgQCEw8WAh4JaW5uZXJodG1sBRXor7fkuIrkvKDlt7LpgInmiKrlm75kAh8PFgIfAGVkZKdoRhDbrOYoE37a1WxakcXSUEKN2WbmGb1P055k7SUB">
</div>

<div>

	<input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEWKgKc/8b8AQKDubGECwKcubGECwKdubGECwKeubGECwKT1pvqBwLrqp+XAgL7uPQdAp/koBACsfzviQkCsfynigkCsfybigkCsfyfigkCsfyTigkCsfyXigkCsfyLigkCsfzPiQkCsfzDiQkCtvyvigkCtvyjigkCtvynigkCtvybigkC+7iIgQUC15KU6ggC1pKU6ggC1ZKU6ggC1JKU6ggC05KU6ggC0pKU6ggC0ZKU6ggCwJKU6ggCz5KU6ggC15LU6QgC5uPdogYC9Lq0rw0C67q0rw0C5NWewQEC/bCh6wICzPurFAKsqunrAQK9y42wAQL5hLCrDq/tx/cq2wqLfMKYwAIBm1LuetVsxNpAty+87aF95d1k">
</div>
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
                    <li><a href="payinfo.php"><span>充值明细</span></a></li>
                    <li><a href="payout.php"><span>支出明细</span></a></li>
                    <li><a href="exit.php"><span>安全退出</span></a></li>
                    <li>
                        <a href="help.php">
                            <span class="title">帮助中心</span>

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
<script src="./copy_files/z_stat.php" language="JavaScript"></script><script src="./copy_files/core.php" charset="utf-8" type="text/javascript"></script><a href="http://www.cnzz.com/stat/website.php?web_id=1257161489" target="_blank" title="站长统计">站长统计</a></span>
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
    <a class="navs" href="index.php">首页
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
                            <h3 class="panel-title">基本信息</h3>
                        </div>
                        <div class="panel-body panel-body-nopadding">

                    
                            <div class="form-group" style="display:none;">
                                <label for="disabledinput" class="col-sm-3 control-label">关注微信号</label>
                                <div class="col-sm-6">
                                    <input type="text" id="gzh" style="width: 150px;" name="gzh" class="form-control  input txt" nullmsg="请输入投票公众号" sucmsg=" " datatype="z0-60" ajaxurl="">
                                    请填写公众号，平台会根据微信号和投票链接及选手信息查询是否已做过
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="disabledinput" class="col-sm-3 control-label">任务类型</label>
                                <div class="col-sm-6">
                                    <input name="type" type="text" id="type" class="form-control input txt" datatype="*2-60" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="disabledinput" class="col-sm-3 control-label">标题</label>
                                <div class="col-sm-6">
                                    <input name="name" type="text" id="name" class="form-control input txt" datatype="*6-60" errormsg="长度在6-60位之间" nullmsg="请输入任务标题" sucmsg=" " value="链接打开关注  投孙琦">
                                <span class="Validform_checktip"></span></div>
                            </div>

                            <div class="form-group">
                                <label for="disabledinput" class="col-sm-3 control-label">投票地址</label>
                                <div class="col-sm-6">
                                    <input name="tpurl" type="text" id="tpurl" class="form-control" nullmsg="请输入投票地址" sucmsg=" " value="http://mp.weixin.qq.com/s?__biz=MzA3MzQ5MTU2Mg==&amp;mid=404547288&amp;idx=1&amp;sn=b24b35105ccc55dbb4188058ce1bb69f&amp;scene=1&amp;srcid=0315F0qSxe9Fhy3NPvRbqSef#rd">
                                </div>
                            </div>
                            <div class="form-group" id="selectquyu" style="display: none">
                                <label for="disabledinput" class="col-sm-3 control-label">限定区域</label>
                                <div class="col-sm-6">

                                    <select id="province" name="province" class="form-control mb15">
                                    <option value="">全国</option><option value="北京">北京</option><option value="天津">天津</option><option value="河北">河北</option><option value="山西">山西</option><option value="内蒙古">内蒙古</option><option value="辽宁">辽宁</option><option value="吉林">吉林</option><option value="黑龙江">黑龙江</option><option value="上海">上海</option><option value="江苏">江苏</option><option value="浙江">浙江</option><option value="安徽">安徽</option><option value="福建">福建</option><option value="江西">江西</option><option value="山东">山东</option><option value="河南">河南</option><option value="湖北">湖北</option><option value="湖南">湖南</option><option value="广东">广东</option><option value="广西">广西</option><option value="海南">海南</option><option value="重庆">重庆</option><option value="四川">四川</option><option value="贵州">贵州</option><option value="云南">云南</option><option value="西藏">西藏</option><option value="陕西">陕西</option><option value="甘肃">甘肃</option><option value="青海">青海</option><option value="宁夏">宁夏</option><option value="新疆">新疆</option><option value="香港">香港</option><option value="澳门">澳门</option><option value="台湾">台湾</option><option value="其它">其它</option></select>
                                    <select name="city" style="display: none" id="city"><option value="">不限</option></select>
                                </div>
                            </div>

                            <div class="form-group putongdanjia">
                                <label for="disabledinput" class="col-sm-3 control-label">单价</label>
                                <div class="col-sm-6">

                                    <select name="danjia" id="danjia" class="form-control mb15">
                                        <!--
                                        <option value="1">0.35</option>
                                        <option value="5">0.4</option>
                                        <option value="6">0.5</option>
                                        <option value="7">0.6</option>
                                        <option value="9">0.8</option>
                                        <option value="10">1</option>
                                        <option value="11">1.3</option>
                                        <option value="12">1.6</option>
                                        <option value="13">2</option>
                                        <option value="14">2.5</option>
                                        <option value="15">3</option>
                                        <option value="16">4</option>
                                        <option value="17">5</option>
                                    -->

                                    </select>
                                </div>
                               
                              
                            </div>

                            <div class="form-group putongdanjia">
                           
                                <label for="disabledinput" class="col-sm-3 control-label">数量</label>
                                <div class="col-sm-6">
                                    <input type="text" name="num" id="num" class="form-control" datatype="n" nullmsg="请输入数量" errormsg="必须为数字" sucmsg=" ">
                                    单次任务20票起
                                <span class="Validform_checktip"></span></div>
                              
                            </div>


                            <div class="form-group">
                                <label for="disabledinput" class="col-sm-3 control-label">简介</label>
                                <div class="col-sm-6">

                                    <textarea name="jianjie" id="jianjie" rows="7" placeholder="公众号或链接地址可以写到上面，方便会员复制，提高任务效率，请在这里写清楚任务流程和截图标准！投票内容描述越清晰，做的速度越快！" class="form-control">请上传已选截图</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="disabledinput" class="col-sm-3 control-label">限速</label>
                                <div class="col-sm-1">
                                    <table id="xiansu" border="0">
                                        <tbody>
                                        <tr>
                                            <td><input id="xiansu_0" type="radio" name="xiansu" value="0" checked="checked"><label for="xiansu_0">否</label></td><td><input id="xiansu_1" type="radio" name="xiansu" value="1"><label for="xiansu_1">是</label></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                            <div class="form-group" id="sudu" style="display: none">
                                <label for="disabledinput" class="col-sm-3 control-label">设置限速</label>
                                <div class="col-sm-6">
                                    <input type="text" name="xzNO" value="0" id="xzNO" class="form-control" datatype="n" nullmsg="请输入五分钟内可投的票数数量" errormsg="必须为数字" sucmsg=" ">
                                    输入五分钟内限制的票数，如果五分钟内限制票数没有投完，将累计到下一计时点。
                                <span class="Validform_checktip"></span></div>

                            </div>

                            <script type="text/javascript">

                                $(function () {

                                    $("input[name='xiansu']").change(function () {

                                        if ($(this).val() == 1) {
                                            $("#sudu").show();

                                        } else {
                                            $("#sudu").hide();
                                            $("#xzNO").val(0);
                                        }

                                    })
                                    var imgurl = $("#imgfile").val();
                                    if (imgurl != "") {
                                        $("#divimg").html("<img src=\"http://www.wx-360.com" + imgurl + "\"/>");
                                    }

                                    var qrimgurl = $("#qrimgfile").val();
                                    if (qrimgurl != "") {
                                        $("#qrdivimg").html("<img src=\"http://www.wx-360.com" + qrimgurl + "\"/>");
                                    }
                                })
                            </script>

                            <div class="form-group">
                                <label for="disabledinput" class="col-sm-3 control-label">样图</label>
                                <div class="col-sm-6">
                                    <input name="imgfile" type="text" id="imgfile" width="170" placeholder=" 请确保样图清晰准确，将直接影响到做任务的效率和质量" sucmsg=" " class=" form-control left" datatype="*" value="" nullmsg="请上传样张" readonly="true">
                                    <input id="uploadInput" type="file" class="left" value="上传图片">
                                    <br>

                                    <div id="divimg"><img style="width:200px;height:300px;" id="img1" src=""></div>
                                <span class="Validform_checktip"></span></div>
                            </div>
                            <div class="form-group">
                                <label for="disabledinput" class="col-sm-3 control-label">二维码</label>
                                <div class="col-sm-6">

                                    <input name="qrimgfile" type="text" id="qrimgfile" placeholder=" 如果投票任务不需要二维码请不要上传" readonly="true" width="170" nullmsg="请上传样张" sucmsg=" " class=" form-control left">
                                    <input id="qruploadInput" type="file" class="left" value="上传图片">
                                    <br>

                                    <div id="qrdivimg"></div>
                                </div>
                            </div>
                            <div class="form-group" style="display:none;">
                                <label for="disabledinput" class="col-sm-3 control-label">备注</label>
                                <div class="col-sm-6">

                                    <textarea name="beizhu" id="beizhu" rows="7" placeholder="备注信息，可在搜索中搜到内容" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="form-group">

                                <label for="disabledinput" class="col-sm-3 control-label"></label>
                                <div class="col-sm-6">
                                    <input name="btnSubmit" id="btnSubmit" type="submit" class=" btn btn-success" value="提交">
                                </div>
                            </div>

                            <!-- table-responsive -->

                        </div>
                        <!-- panel-body -->
                    </div>
                </div>
                <!-- contentpanel -->

            </div>
            <!-- mainpanel -->
        </section>
    </form>
    <script src="./copy_files/jquery-migrate-1.2.1.min.js"></script>
    <script src="./copy_files/jquery-ui-1.10.3.min.js"></script>
    <script src="./copy_files/bootstrap.min.js"></script>
    <script src="./copy_files/modernizr.min.js"></script>
    <script src="./copy_files/jquery.sparkline.min.js"></script>
    <script src="./copy_files/toggles.min.js"></script>
    <script src="./copy_files/retina.min.js"></script>
    <script src="./copy_files/jquery.cookies.js"></script>
    <script src="./copy_files/morris.min.js"></script>
    <script src="./copy_files/raphael-2.1.0.min.js"></script>
    <script src="./copy_files/custom.js"></script>


<div tabindex="-1" aria-labelledby="title:1459183582985" aria-describedby="content:1459183582985" style="display: none; position: absolute; outline: 0px; left: 575px; top: 215px;"><div i="dialog" class="ui-dialog"><div class="ui-dialog-arrow-a"></div><div class="ui-dialog-arrow-b"></div><table class="ui-dialog-grid"><tbody><tr><td i="header" class="ui-dialog-header" style="display: none;"><button i="close" class="ui-dialog-close" title="cancel">×</button><div i="title" class="ui-dialog-title" id="title:1459183582985"></div></td></tr><tr><td i="body" class="ui-dialog-body"><div i="content" class="ui-dialog-content" id="content:1459183582985"><img src="./copy_files/loading.gif"> 上传中</div></td></tr><tr><td i="footer" class="ui-dialog-footer" style="display: none;"><div i="statusbar" class="ui-dialog-statusbar" style="display: none;"></div><div i="button" class="ui-dialog-button"></div></td></tr></tbody></table></div></div>


<script type="text/javascript">
$(document).ready(function(){
    $.ajax({
      type:'post',
      url:"getAll21.php", 
      data:{
      
      },
      dataType:'json',
      async:true,
      success:function(data){

        var rows=data.rows;
        var total=data.total;
        $('#danjia').html('');
        //$('#danjia').append('<option value="0">请选择</option>');
        for(var i=0;i<total;i++){
            var row=rows[i];
            var html='<option value="'+row.price1+'">'+row.price1+'</option>';
            $('#danjia').append(html);
        }
                
      }
    }); 
});
</script>



</body>
</html>