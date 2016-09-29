<?php
/**
  * wechat php test
  */

//define your token
define("TOKEN", "weixin");

require_once 'class/done.class.php';
require_once 'class/task.class.php';
require_once 'class/orders.class.php';
require_once 'class/ordersdone.class.php';

require_once 'class/mapping.class.php';
require_once 'class/worker.class.php';
require_once 'class/alipay.class.php';
require_once 'class/income.class.php';
require_once 'class/profit.class.php';
require_once 'class/images.class.php';


$wechatObj = new wechatCallbackapiTest("wxdda2a0fe7a1637eb","efb9b15278468609f611fb9f313844ca");

//$wechatObj->valid();
if (isset($_GET['echostr'])) {
    $wechatObj->valid();
}else{
    $wechatObj->responseMsg();
}

class wechatCallbackapiTest{
    private $appId;
    private $appSecret;
 
    public function __construct($appId, $appSecret) {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }    
  public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
          echo $echoStr;
          exit;
        }
    }

    public function responseMsg()
    {
    //get post data, May be due to the different environments
    $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
    $taskClass=new taskClass();
    $ordersClass=new ordersClass();
    $ordersdoneClass=new ordersdoneClass();

 
    $mappingClass=new mappingClass();
    $workerClass=new workerClass();

    $alipayClass = new alipayClass();
    $incomeClass = new incomeClass();
    $profitClass = new profitClass();
    $imagesClass = new imagesClass();

    $doneClass=new doneClass();
        //extract post data
    if (!empty($postStr)){
                /* libxml_disable_entity_loader is to prevent XML eXternal Entity Injection,
                   the best way is to check the validity of xml by yourself */
                libxml_disable_entity_loader(true);
                $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $fromUsername = $postObj->FromUserName;
                $toUsername = $postObj->ToUserName;
                $keyword = trim($postObj->Content);
                $msgType=strtolower($postObj->MsgType);
                $event=strtolower($postObj->Event);   


                $time = time();

                $textTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Content><![CDATA[%s]]></Content>
                            <FuncFlag>0</FuncFlag>
                            </xml>";  
                $imageTpl = "<xml>
                            <ToUserName><![CDATA[%s]]></ToUserName>
                            <FromUserName><![CDATA[%s]]></FromUserName>
                            <CreateTime>%s</CreateTime>
                            <MsgType><![CDATA[%s]]></MsgType>
                            <Image>
                            <MediaId><![CDATA[%s]]></MediaId>
                            </Image>
                            </xml>";                              

                $newsTpl="<xml>
                          <ToUserName><![CDATA[%s]]></ToUserName>
                          <FromUserName><![CDATA[%s]]></FromUserName>
                          <CreateTime>%s</CreateTime>
                          <MsgType><![CDATA[%s]]></MsgType>
                          <ArticleCount>1</ArticleCount>
                          <Articles>
                          <item>
                          <Title><![CDATA[%s]]></Title>
                          <Description><![CDATA[%s]]></Description>
                          <PicUrl><![CDATA[%s]]></PicUrl>
                          <Url><![CDATA[%s]]></Url>
                          </item>
                          </Articles>
                          </xml>";

                $newsTpl2="<xml>
                          <ToUserName><![CDATA[%s]]></ToUserName>
                          <FromUserName><![CDATA[%s]]></FromUserName>
                          <CreateTime>%s</CreateTime>
                          <MsgType><![CDATA[%s]]></MsgType>
                          <ArticleCount>1</ArticleCount>
                          <Articles>
                          <item>
                          <Title><![CDATA[赚米吧登陆提示]]></Title>
                          <Description><![CDATA[本系统一次登陆永久有效]]></Description>
                          <PicUrl><![CDATA[%s]]></PicUrl>
                          <Url><![CDATA[%s]]></Url>
                          </item>
                          </Articles>
                          </xml>";

                $imgTpl="<xml>
                          <ToUserName><![CDATA[toUser]]></ToUserName>
                          <FromUserName><![CDATA[fromUser]]></FromUserName>
                          <CreateTime>%s</CreateTime>
                          <MsgType><![CDATA[image]]></MsgType>
                          <Image>
                          <MediaId><![CDATA[%s]]></MediaId>
                          </Image>
                          </xml>";     
                $redis = new redis(); 
                $redis->connect('127.0.0.1', 6379);
                $openid=$fromUsername;
                $queue='queue-'.$openid; 

                $done='done-'.$openid;

                $now='now-'.$openid;

                $T='id-'.$openid;



                switch($msgType){
                   case "event":
                          switch (strtolower($postObj->Event)){
                            case "subscribe":

                                    
                                    $time=time();
                                    $redis->set($openid,$time);
                                    $redis->set($queue,'0');

                                    $msgType2 = "text";
                                    $contentStr="恭候您多时了"."\n\n";
              
                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType2, $contentStr);
                                    echo $resultStr; 
                                    break;
                            case "unsubscribe":
                                    $redis->set($queue,'0');
                                    
                                    break;
                            case "click":

                                    $message="<a href='#' >无法识别</a>";
                                    $message.=  "\n\n";
                                    $msgType='text';
                                    
                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                    echo $resultStr; 
                                    break;                            
                            default:
                                    $message="<a href='#' >无法识别</a>";
                                    $message.=  "\n\n";
                                    $msgType='text';
                                    
                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                    echo $resultStr;                          
                           }

                   break;
                   case "text":
                              $openid=$fromUsername;
                              
                              $keyword=$keyword;
                              switch ($keyword) {

                                  case '小时光':
                                      $total=$ordersClass->getCount9($openid);
                                      $message ="平台目前提供以下快捷操作\n";
                                      $message.="1-接任务\n";
                                      $message.="2-查看当前任务\n";
                                      $message.="0-完成\n";
                                      $message.="6-放弃\n";
                                      $message.="绑定\n";
                                      $message.="提现\n";
                                      $message.="账号\n";
                                      $message.="战果\n";
                                            
                                      $msgType='text';
                                          
                                      $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                      echo $resultStr;
                                    break;     


                                  case '赚米吧':
                                    
                                            
                                                                                        $msgType='image';
                                                  $MediaId='43JnhWI18AThLj7STx9mK_2qS3goquwx6TtJdY3pbo0';
                                                
                                                  $resultStr = sprintf($imageTpl, $fromUsername, $toUsername, $time, $msgType, $MediaId);
                                                  echo $resultStr; 
                                    break;   


                                  case '战果':
                                      $total=$ordersdoneClass->getCount3($openid);
                                      $today=date('Y-m-d H:i:s');
                                      $message="今天已完成任务个数为：".$total."\n";

                                      $message.="统计于："."\n";
                                      $message.=$today."\n";
                                      $message.="-------------------"."\n\n";

                                      $total=intval($total);



                                      if($total<9){
                                        $diff=9-$total;
                                        $message.="再接在励，还差".$diff."个就可以完成次日发放佣金的基本指标。";
                                      }
                                      if($total>8){
                                         $message.='您也太拼了吧，恭喜您，您今天已圆满完成平台次日凌晨发放佣金的标准，为保证佣金发放成功，请及时进行绑定。';
                                      }   
                                      $message.="-------------------"."\n\n";
                                      $message.="任务高峰期，战果统计会有几分钟延迟，请耐心等待"."\n";
                                      
                                      $msgType='text';
                                          
                                      $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                      echo $resultStr;
                                    break; 

                                  case '绑定':
                                    $url='http://www.fangdan8.com/wx/zhifu.php';
                                    $url2='https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxdda2a0fe7a1637eb&redirect_uri='.$url.'&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';

                                    $msgType = "text";
                                    $message='点击去=》=》<a href="'.$url2.'">绑定</a>';
                                    //$message='绑定每天开放时间为晚上6点到12点，是否绑定不影响佣金计算，请安心做任务';
                                    //$message='2016年7月9号佣金正在发放中，请耐心等待，发放还要持续一个小时';

                                    
                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                    echo $resultStr;
                                    break; 
                                  case '编号':

                                  $orderid=$redis->get($now);
                                  $msgType = "text";
                                  $message=$orderid;
                                  $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                  echo $resultStr; 
                                  break;

                                  case '解绑':

                                  $mappingClass->del($openid);
                                  $msgType = "text";
                                  $message='暂未开放解绑功能';
                                  $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                  echo $resultStr; 
                                  break;


                                case '账号':
                                  $msgType = "text";
                                  $message=$openid;
                                  $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                  echo $resultStr; 
                                  break;

                                case '提现':
                                  $msgType = "text";
                                  $message="赚米吧不需要注册，关注后就可以做任务，为保证佣金发放及时，请在关注后，及时进行绑定，请回复'绑定'二字，进行绑定，绑定后当天佣金满一元，也就是做满九个任务，佣金在凌晨12点10分开始自动发放，佣金发放到微信零钱包。\n";
                                  $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                  echo $resultStr; 
                                  break;   

                                case '2':
                                                $status=$redis->get($queue);

                                                
                                                if($status>=2){

                                                  $pid=$redis->get($T);
                                                 
                                                  
                                                  

                                                  
                                                  $items=$taskClass->getAll2($pid);
                                                  
                                                  $item=$items[0];
                                                  $title=$item['title'];
                                                  $content=$item['content'];

                                                  $message =$title."\n";
                                                  
                                                  $url=$item['url'];
                                                  $mpUrl=$url;
                                                  $price2=$item['price2'];
                                                  $type=$item['type'];
                                                  
                                                  $img1=$item['img1'];
                                                  $img2=$item['img2'];
                                                  /*
                                                  $type=$redis->hGet($pid, 'type');
                                                  $title=$redis->hGet($pid, 'title');
                                                  $url=$redis->hGet($pid, 'url');
                                                  $price2=$redis->hGet($pid, 'price2');
                                                  

                                                  $img1=$redis->hGet($pid, 'img1');
                                                  $img2=$redis->hGet($pid, 'img2');
                                                  */



                                                  $imgUrl=$img1;


                                                  $PicUrl =$imgUrl;

                                                  

                                                  $url='http://www.fangdan8.com/wx/img1.php?id='.$pid;

                                                  
                                                if($type=='MP'){
                                                    $time=time();
                                                    
                                                    $bef=$redis->get($openid);
                                                    $diff=$time-$bef;
                                                    $howmany=10-$diff/60;
                                                    $howmany=number_format($howmany,1);
                                                    $msgType = "text";
                                                   
                                                    $message='任务编号：'.$pid."\n\n";
                                                    $message.=$title."\n\n";
                                                    $message.="-------------"."\n\n";
                                                    $message.=$mpUrl."\n\n";
                                                    $message.="-------------"."\n";
                                                    $message.="时间：".$howmany."分钟"."\n\n";

                                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                                    echo $resultStr; 
                                                  }
                                                if($type=='注册任务'){
                                                    $time=time();
                                                    
                                                    $bef=$redis->get($openid);
                                                    $diff=$time-$bef;
                                                    $howmany=10-$diff/60;
                                                    $howmany=number_format($howmany,1);
                                                    $msgType = "text";
                                                   
                                                    $message='任务编号：'.$pid."\n\n";
                                                    $message.="-------------"."\n\n";
                                                    $message.="任务标题："."\n\n";
                                                    $message.=$title."\n\n";
                                                    $message.="-------------"."\n\n";
                                                    $message.="任务描述："."\n\n";
                                                    $message.=$content."\n\n";
                                                    $message.="-------------"."\n";
                                                    $message.="样图：\n\n";
                                                    $message.=$img1."\n\n";
                                                    $message.="-------------"."\n";

                                                    $message.="时间：".$howmany."分钟"."\n\n";

                                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                                    echo $resultStr; 
                                                  }                                                  
                                                  if(($type=='扫码关注')||($type=='普通任务')){

                                                    $msgType = "text";

                                                    $message='任务编号：'.$pid."\n\n";
                                                    $message.=$title."\n\n";

                                                    $message.="-------------"."\n\n";
                                                    $message.=$mpUrl."\n\n";
                                                    $message.="-------------"."\n";


                                                    $message.="样图：\n";
                                                    $message.=$img1."\n\n";
                                                    $message.="-------------"."\n";

                                                    $message.="二维码图：\n";
                                                    $message.=$img2."\n\n";
                                                    $message.="-------------"."\n";


                                                    $message.="快捷键：\n\n";
                                                    $message.="回复数字1，去接任务\n\n";
                                                    $message.="回复数字0，代表任务完成\n\n";
                                                    $message.="回复数字6，代表任务放弃\n\n";
                                                    $message.="-------------"."\n\n";;                          

                                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                                    echo $resultStr; 
                                                  } 
                                                 
                                                }
                                                if($status<2){

                                                  $contentStr="没有需要提交的任务。"."\n";
                                                  $contentStr.="可能是因为您还未接过任何任务，或者您接受的任务已经过期超时。";
                                                  
                                                  $msgType='text';
                                                
                                                  $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                                  echo $resultStr; 

                                                } 
                                  break;   


                                case '8':
                                              $data=$redis->get($openid);
                                            
                                            
                                              $time=time();
                                              $diff=$time-$data;
                                              

                                              if($diff<10){   

                                                //$delta=10-$diff;
                                                $msgType2 = "text";
                                                $contentStr="亲，别点太急了，小二有些反应不过来了，请过3秒再点击吧。";
                                                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType2, $contentStr);
                                                echo $resultStr; 

                                              }
                                              if($diff>=10){

                                                    $time=time();
                                                    $redis->set($openid,$time);
                                                    $status=$redis->get($queue);
                                                    if($status==3){
                                                      $msgType2 = "text";
                                                      $contentStr='您已经提交图片尚未回复数字0，请回复数字0';
                                                      $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType2, $contentStr);
                                                      echo $resultStr; 
                                                    }
                                                    if($status==2){
                                                      $msgType2 = "text";
                                                      $contentStr="您有任务尚未完成，请回复数字2查看。"."\n\n";
                                                      $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType2, $contentStr);
                                                      echo $resultStr;
                                                    }
                                                    if($status<2){

                                                      
                                                      

                                                      //$total=$taskClass->getCount3($username);
                                                      $todo=$redis->sDiff('doing',$done);
                                                      $total=count($todo);

                                                      //$total=$taskClass->getCount4($openid);
                                                      if($total==0){
                                                        $contentStr="任务都被抢光啦~"."\n\n";
                                                        $contentStr.= "由于近期平台不断优化，如不能正常接收任务，请回复'赚米吧'三个字获取平台二维码，将二维码保存到本地，然后取消关注再重新关注下"."\n\n";
                                                        $contentStr.= "赚米吧六群 577820230"."\n\n";
                                                        //$contentStr.= "由于紫萱昨天外出，之前佣金补发延迟一天发放"."\n";
                                                        $msgType = "text";
                                                        //$contentStr="如果有多张截图请继续发送，如果已经发送完毕，请回复【完成】。";
                                                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                                        echo $resultStr; 
                                                      }
                                                      if($total!=0){
                                                        
                                                          $pid='8094';
                                                          
                                                          $items=$taskClass->getAll2($pid);
                                                          
                                                          $item=$items[0];
                                                          $pid=$item['id'];
                                                          $title=$item['title'];
                                                          $content=$item['content'];
                                                          $url=$item['url'];

                                                          $mpUrl=$url;
                                                          $price2=$item['price2'];
                                                          $tip=$item['tip'];
                                                          $tip=intval($tip);

                                                          $xiansu=$item['xiansu'];
                                                          $times=$item['times'];

                                                          
                                                          
                                                          $type=$item['type'];
                                                          $img1=$item['img1'];
                                                          $img2=$item['img2'];
                                                          $imgUrl=$img1;


                                                          $url='http://www.fangdan8.com/wx/img1.php?id='.$pid;
                                                          

                                                          $PicUrl =$imgUrl;
                                                          
                                                          //$orderid=$ordersClass->makeorderid();

                                                          $len=$redis->lSize('T-'.$pid);
                                                          
                                                          if($len==0){
                                                            //20160815
                                                            //$redis->sAdd('done',$pid);
                                                            $redis->sRem('doing', $pid);

                                                            $contentStr="编号为".$pid."的任务"."\n\n";
                                                            $contentStr.="刚刚被抢光了，请回复数字1，继续接任务。"."\n\n";
                                                            $msgType = "text";
                                                            //$contentStr="如果有多张截图请继续发送，如果已经发送完毕，请回复【完成】。";
                                                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                                            echo $resultStr; 

                                                          }else{

                                                          $orderid=$redis->rPop('T-'.$pid);
                                                          //$ordersClass->add2($username,$orderid,$pid,$title);

                                                          //$ordersClass->add3($openid,$orderid,$pid,$title);

                                                          $redis->lPush('orders', $pid.'#'.$orderid.'#'.$openid);

                                                          
                                                          $redis->set($now,$orderid);

                                                          $redis->set($T,$pid);

                                                          

                                                          
                                                          $redis->set($queue,'2');

                                                          $imgsortcode='img-'.$openid;
                                                          $redis->set($imgsortcode,0);
                                                          
                                                          //20160502
                                                          //if($times!=0){
                                                          //  $taskClass->update4($pid,$times);

                                                          //  $redis->sRem('doing', $pid);
                                                          //}
                                                          
                                                          if($type=='MP'){
                                                            $msgType = "text";
                                                            
                                                            $message="任务编号：".$pid."\n\n";

                                                            $message.="任务类型：MP任务"."\n\n";
                                                            $message.="-------------"."\n";

                                                            $message.="任务要求：必须提交勾选图和已选图两张截图，单图无米，不建议拼图，拒绝拼图，因为拼图很容易导致误投诉"."\n\n";
                                                            $message.="-------------"."\n";

                                                            $message.="任务警示：投票频繁截图不要提交，提交到平台，一律封号处理。"."\n\n";
                                                            $message.="-------------"."\n";

                                                            $message.=$title."\n";
                                                            $message.="-------------"."\n";

                                                            $message.="米粒：".$price2."\n";
                                                            if($tip>0){
                                                              $tip3=$tip/100;
                                                              $message.="小费：".$tip3."\n";
                                                            }
                                                            $message.="-------------"."\n";
                                                            $message.=$mpUrl."\n\n";
                                                            $message.=$intro."\n";
                                                            $message.="-------------"."\n";
                                                            $message.="时间：10分钟"."\n";
                                                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                                            echo $resultStr; 
                                                          } 
                                                          if($type=='扫码关注'){
                                                            $msgType = "text";

                                                            $message="任务编号：".$pid."\n\n";
                                                            
                                                            $message.="任务类型：扫码关注"."\n\n";
                                                            $message.="-------------"."\n";

                                                            $message.="任务备注：扫码关注类任务是所有任务中最简单的，没有之一"."\n\n";
                                                            $message.="-------------"."\n";

                                                            $message.=$title."\n";
                                                            $message.="-------------"."\n";

                                                            $message.="米粒：".$price2."\n";
                                                            if($tip>0){
                                                              $tip3=$tip/100;
                                                              $message.="小费：".$tip3."\n";
                                                            }
                                                            $message.="-------------"."\n";
                                                            $message.="点这里扫码：\n";
                                                            $message.=$mpUrl."\n\n";
                                                            $message.=$intro."\n";
                                                            $message.="-------------"."\n";
                                                            $message.="时间：10分钟"."\n\n";
                                                            $message.="备注：\n";
                                                            $message.="申诉编号：".$orderid."\n";
                                                            $message.="如果任务被投诉，可以凭借此编号到扣扣群151640542找平台管理申诉\n\n";

                                                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                                            echo $resultStr; 
                                                          }                                                           
                                                          if($type=='普通任务'){
                                                            $message="任务编号：".$pid."\n\n";

                                                            $message.="任务类型：普通任务"."\n\n";
                                                            $message.="-------------"."\n";
                                                            $message.=$title."\n\n";

                                                            $msgType = "text";
                                                           
                                                            $message.="米粒：".$price2."\n";
                                                            if($tip>0){
                                                              $tip3=$tip/100;
                                                              $message.="小费：".$tip3."\n";
                                                            }
                                                            $message.="-------------"."\n";
                                                            $message.=$mpUrl."\n\n";
                                                            $message.=$intro."\n";
                                                            $message.="-------------"."\n";


                                                            $message.="样图：\n";
                                                            $message.=$img1."\n\n";
                                                            $message.="-------------"."\n";

                                                            $message.="二维码图：\n";
                                                            $message.=$img2."\n\n";
                                                            $message.="-------------"."\n";

                                                            $message.="快捷键：\n\n";
                                                            $message.="回复数字1，去接任务\n\n";
                                                            $message.="回复数字0，代表任务完成\n\n";
                                                            $message.="回复数字6，代表任务放弃\n\n";
                                                            $message.="-------------"."\n\n";


                                                            $message.="备注：\n";
                                                            $message.="申诉编号：".$orderid."\n";
                                                            $message.="如果任务被投诉，可以凭借此编号到扣扣群151640542找平台管理申诉\n\n";

                                                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                                            echo $resultStr; 
                                                          }                           
                                                          if($type=='注册任务'){
                                                            $message="任务编号：".$pid."\n\n";

                                                            $message.="任务类型：注册任务"."\n\n";
                                                            $message.="-------------"."\n\n";

                                                            $message.="任务备注：注册任务佣金正在火爆发放中，扣扣群418978327，快到碗里来"."\n\n";
                                                            $message.="-------------"."\n\n";

                                                            $message.="温馨提示：凡是成功做过注册任务的会员，平台管理将会与您进行面对面交流，优先解决您的各种问题，比如封号、投诉、佣金发放，各方面给于资源倾斜。"."\n\n";
                                                            $message.="-------------"."\n\n";


                                                            $msgType = "text";
                                                           
                                                            $message.="任务标题：\n\n";
                                                            $message.=$title."\n";
                                                            $message.="-------------"."\n";
                                                            $message.="米粒：".$price2."\n";
                                                           
                                                            $message.="-------------"."\n";
                                                            $message.="任务描述：\n\n";
                                                            $message.=$content."\n\n";
                                                            $message.="-------------"."\n";
                                                            $message.="样图：\n\n";
                                                            $message.=$img1."\n\n";
                                                            $message.="-------------"."\n";


                                                          

                                                            $message.="快捷键：\n\n";
                                                            $message.="回复数字1，去接任务\n\n";
                                                            $message.="回复数字0，代表任务完成\n\n";
                                                            $message.="回复数字6，代表任务放弃\n\n";
                                                            $message.="-------------"."\n\n";

                                                            $message.="备注：\n";
                                                            $message.="申诉编号：".$orderid."\n";
                                                            $message.="如果任务被投诉，可以凭借此编号到扣扣群151640542找平台管理申诉\n\n";

                                                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                                            echo $resultStr; 
                                                          }        

                                                          }
                                                                                                              
                                                        
                                                                                                                
                                                        
                                             
                                                      }

                                                    } 
                                                  }
                                  break;    

                                case '1':
                                              $data=$redis->get($openid);
                                            
                                            
                                              $time=time();
                                              $diff=$time-$data;
                                              

                                              if($diff<10){   

                                                //$delta=10-$diff;
                                                $msgType2 = "text";
                                                $contentStr="亲，别点太急了，小二有些反应不过来了，请过3秒再点击吧。";
                                                $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType2, $contentStr);
                                                echo $resultStr; 

                                              }
                                              if($diff>=10){

                                                    $time=time();
                                                    $redis->set($openid,$time);
                                                    $status=$redis->get($queue);
                                                    if($status==3){
                                                      $msgType2 = "text";
                                                      $contentStr='您已经提交图片尚未回复数字0，请回复数字0';
                                                      $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType2, $contentStr);
                                                      echo $resultStr; 
                                                    }
                                                    if($status==2){
                                                      $msgType2 = "text";
                                                      $contentStr="您有任务尚未完成，请回复数字2查看。"."\n\n";
                                                      $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType2, $contentStr);
                                                      echo $resultStr;
                                                    }
                                                    if($status<2){

                                                      
                                                      

                                                      //$total=$taskClass->getCount3($username);
                                                      $todo=$redis->sDiff('doing',$done);
                                                      $total=count($todo);

                                                      //$total=$taskClass->getCount4($openid);
                                                      if($total==0){
                                                        $contentStr="任务都被抢光啦~"."\n\n";
                                                        $contentStr.= "由于近期平台不断优化，如不能正常接收任务，请回复'赚米吧'三个字获取平台二维码，将二维码保存到本地，然后取消关注再重新关注下"."\n\n";
                                                        $contentStr.= "赚米吧六群 577820230"."\n\n";
                                                        //$contentStr.= "由于紫萱昨天外出，之前佣金补发延迟一天发放"."\n";
                                                        $msgType = "text";
                                                        //$contentStr="如果有多张截图请继续发送，如果已经发送完毕，请回复【完成】。";
                                                        $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                                        echo $resultStr; 
                                                      }
                                                      if($total!=0){
                                                        //$items=$taskClass->getAll6($username);

                                                        //$items=$taskClass->getAll8($openid);
                                                          shuffle($todo);

                                                          /*
                                                          $arr=array();
                                                          foreach ($todo as $t) {
                                                            $sortCode=$redis->get($t); 
                                                            $pid=$t;
                                                            $arr[$pid]=$sortCode;

                                                          }

                                                          arsort($arr);
                                                          $arr2=array_keys($arr);

                                                          $pid=array_shift($arr2);

                                                          */
                                                          $pid=$todo[0];
                                                          
                                                          $items=$taskClass->getAll2($pid);
                                                          
                                                          $item=$items[0];
                                                          $pid=$item['id'];
                                                          $title=$item['title'];
                                                          $content=$item['content'];
                                                          $url=$item['url'];

                                                          $mpUrl=$url;
                                                          $price2=$item['price2'];
                                                          $tip=$item['tip'];
                                                          $tip=intval($tip);

                                                          $xiansu=$item['xiansu'];
                                                          $times=$item['times'];

                                                          
                                                          
                                                          $type=$item['type'];
                                                          $img1=$item['img1'];
                                                          $img2=$item['img2'];
                                                          $imgUrl=$img1;


                                                          $url='http://www.fangdan8.com/wx/img1.php?id='.$pid;
                                                          

                                                          $PicUrl =$imgUrl;
                                                          
                                                          //$orderid=$ordersClass->makeorderid();

                                                          $len=$redis->lSize('T-'.$pid);
                                                          
                                                          if($len==0){
                                                            //20160815
                                                            //$redis->sAdd('done',$pid);
                                                            $redis->sRem('doing', $pid);

                                                            $contentStr="编号为".$pid."的任务"."\n\n";
                                                            $contentStr.="刚刚被抢光了，请回复数字1，继续接任务。"."\n\n";
                                                            $msgType = "text";
                                                            //$contentStr="如果有多张截图请继续发送，如果已经发送完毕，请回复【完成】。";
                                                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
                                                            echo $resultStr; 

                                                          }else{

                                                          $orderid=$redis->rPop('T-'.$pid);
                                                          //$ordersClass->add2($username,$orderid,$pid,$title);

                                                          //$ordersClass->add3($openid,$orderid,$pid,$title);

                                                          $redis->lPush('orders', $pid.'#'.$orderid.'#'.$openid);

                                                          
                                                          $redis->set($now,$orderid);

                                                          $redis->set($T,$pid);

                                                          

                                                          
                                                          $redis->set($queue,'2');

                                                          $imgsortcode='img-'.$openid;
                                                          $redis->set($imgsortcode,0);
                                                          
                                                          //20160502
                                                          //if($times!=0){
                                                          //  $taskClass->update4($pid,$times);

                                                          //  $redis->sRem('doing', $pid);
                                                          //}
                                                          
                                                          if($type=='MP'){
                                                            $msgType = "text";
                                                            
                                                            $message="任务编号：".$pid."\n\n";

                                                            $message.="任务类型：MP任务"."\n\n";
                                                            $message.="-------------"."\n";

                                                            $message.="任务要求：必须提交勾选图和已选图两张截图，单图无米，不建议拼图，拒绝拼图，因为拼图很容易导致误投诉"."\n\n";
                                                            $message.="-------------"."\n";

                                                            $message.="任务警示：投票频繁截图不要提交，提交到平台，一律封号处理。"."\n\n";
                                                            $message.="-------------"."\n";

                                                            $message.=$title."\n";
                                                            $message.="-------------"."\n";

                                                            $message.="米粒：".$price2."\n";
                                                            if($tip>0){
                                                              $tip3=$tip/100;
                                                              $message.="小费：".$tip3."\n";
                                                            }
                                                            $message.="-------------"."\n";
                                                            $message.=$mpUrl."\n\n";
                                                            $message.=$intro."\n";
                                                            $message.="-------------"."\n";
                                                            $message.="时间：10分钟"."\n";
                                                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                                            echo $resultStr; 
                                                          } 
                                                          if($type=='扫码关注'){
                                                            $msgType = "text";

                                                            $message="任务编号：".$pid."\n\n";
                                                            
                                                            $message.="任务类型：扫码关注"."\n\n";
                                                            $message.="-------------"."\n";

                                                            $message.="任务备注：扫码关注类任务是所有任务中最简单的，没有之一"."\n\n";
                                                            $message.="-------------"."\n";

                                                            $message.=$title."\n";
                                                            $message.="-------------"."\n";

                                                            $message.="米粒：".$price2."\n";
                                                            if($tip>0){
                                                              $tip3=$tip/100;
                                                              $message.="小费：".$tip3."\n";
                                                            }
                                                            $message.="-------------"."\n";
                                                            $message.="点这里扫码：\n";
                                                            $message.=$mpUrl."\n\n";
                                                            $message.=$intro."\n";
                                                            $message.="-------------"."\n";
                                                            $message.="时间：10分钟"."\n\n";
                                                            $message.="备注：\n";
                                                            $message.="申诉编号：".$orderid."\n";
                                                            $message.="如果任务被投诉，可以凭借此编号到扣扣群151640542找平台管理申诉\n\n";

                                                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                                            echo $resultStr; 
                                                          }                                                           
                                                          if($type=='普通任务'){
                                                            $message="任务编号：".$pid."\n\n";

                                                            $message.="任务类型：普通任务"."\n\n";
                                                            $message.="-------------"."\n";
                                                            $message.=$title."\n\n";

                                                            $msgType = "text";
                                                           
                                                            $message.="米粒：".$price2."\n";
                                                            if($tip>0){
                                                              $tip3=$tip/100;
                                                              $message.="小费：".$tip3."\n";
                                                            }
                                                            $message.="-------------"."\n";
                                                            $message.=$mpUrl."\n\n";
                                                            $message.=$intro."\n";
                                                            $message.="-------------"."\n";


                                                            $message.="样图：\n";
                                                            $message.=$img1."\n\n";
                                                            $message.="-------------"."\n";

                                                            $message.="二维码图：\n";
                                                            $message.=$img2."\n\n";
                                                            $message.="-------------"."\n";

                                                            $message.="快捷键：\n\n";
                                                            $message.="回复数字1，去接任务\n\n";
                                                            $message.="回复数字0，代表任务完成\n\n";
                                                            $message.="回复数字6，代表任务放弃\n\n";
                                                            $message.="-------------"."\n\n";


                                                            $message.="备注：\n";
                                                            $message.="申诉编号：".$orderid."\n";
                                                            $message.="如果任务被投诉，可以凭借此编号到扣扣群151640542找平台管理申诉\n\n";

                                                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                                            echo $resultStr; 
                                                          }                           
                                                          if($type=='注册任务'){
                                                            $message="任务编号：".$pid."\n\n";

                                                            $message.="任务类型：注册任务"."\n\n";
                                                            $message.="-------------"."\n\n";

                                                            $message.="任务备注：注册任务佣金正在火爆发放中，扣扣群418978327，快到碗里来"."\n\n";
                                                            $message.="-------------"."\n\n";

                                                            $message.="温馨提示：凡是成功做过注册任务的会员，平台管理将会与您进行面对面交流，优先解决您的各种问题，比如封号、投诉、佣金发放，各方面给于资源倾斜。"."\n\n";
                                                            $message.="-------------"."\n\n";


                                                            $msgType = "text";
                                                           
                                                            $message.="任务标题：\n\n";
                                                            $message.=$title."\n";
                                                            $message.="-------------"."\n";
                                                            $message.="米粒：".$price2."\n";
                                                           
                                                            $message.="-------------"."\n";
                                                            $message.="任务描述：\n\n";
                                                            $message.=$content."\n\n";
                                                            $message.="-------------"."\n";
                                                            $message.="样图：\n\n";
                                                            $message.=$img1."\n\n";
                                                            $message.="-------------"."\n";


                                                          

                                                            $message.="快捷键：\n\n";
                                                            $message.="回复数字1，去接任务\n\n";
                                                            $message.="回复数字0，代表任务完成\n\n";
                                                            $message.="回复数字6，代表任务放弃\n\n";
                                                            $message.="-------------"."\n\n";

                                                            $message.="备注：\n";
                                                            $message.="申诉编号：".$orderid."\n";
                                                            $message.="如果任务被投诉，可以凭借此编号到扣扣群151640542找平台管理申诉\n\n";

                                                            $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                                            echo $resultStr; 
                                                          }        

                                                          }
                                                                                                              
                                                        
                                                                                                                
                                                        
                                             
                                                      }

                                                    } 
                                                  }
                                  break;                                                                 
                                case '完成':
                                

                                  $message="<a href='#' >无法识别，如确认完成任务，请回复数字0</a>";
                                  $message.=  "\n\n";
                                  $msgType='text';
                                  
                                  $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                  echo $resultStr; 
                                  

                                break;


                                case '0':
                                

                                    $status=$redis->get($queue);
                                    switch ($status) {
                                        case '0':
                                          $msgType = "text";
                                          $message='您尚未接任务或者任务已过期，请回复数字1';
                                          $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                          echo $resultStr; 
                                          break;
                                        case '1':
                                          $msgType = "text";
                                          $message='您尚未接任务或者任务已过期，请回复数字1';
                                          $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                          echo $resultStr; 
                                          break;
                                        case '2':
                                          $msgType = "text";
                                          $message='尚未收到您提交的任务图片，请继续';
                                          $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                          echo $resultStr; 
                                          break;  
                                        case '3':

                                            $time1=$redis->get($openid);
                                            
                                            
                                            $time2=time();
                                            $diff=$time2-$time1;
                                            

                                            if($diff>1200){   

                                              $redis->set($queue,'0');

                                              $msgType2 = "text";
                                              $contentStr="您尚未接任务或者任务已过期，请回复数字1，开始新的任务";
                                              $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType2, $contentStr);
                                              echo $resultStr; 

                                            }
                                            if($diff<=1200){
                                              $orderid=$redis->get($now);

                                              $redis->lPush('K',$orderid);

                                              

                                              
                                              $redis->set($queue,'0');

                                              $pid=$redis->get($T);
                                              $redis->sAdd($done , $pid);
                                              
                                              $redis->lPush('done', $pid.'#'.$orderid.'#'.$openid);

                                              $msgType='text';
                                              $message='完成任务截图提交，管理员审核通过后您会获得该任务的奖励。';
                                              $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                              echo $resultStr;

                                            }

                                          


                                          break; 
                                        default:
                                          //$redis->set($queue,'0');

                                          $msgType = "text";
                                          $message='您当前没有正在进行中的任务，请回复数字1。';
                                          $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                          echo $resultStr; 
                                          break;
                                    }
                                  

                                break;

                                case '放弃':


                                  $message="<a href='#' >无法识别，如确认放弃任务，请回复数字6</a>";
                                  $message.=  "\n\n";
                                  $msgType='text';
                                  
                                  $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                  echo $resultStr; 
                                
                                  

                                  break;


                                case '6':

                 
                                  
                                    $status=$redis->get($queue);

                                    switch ($status) {
                                        case '0':
                                          $msgType = "text";
                                          $message='您尚未接任务或者任务已过期，请回复数字1';
                                          $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                          echo $resultStr; 
                                          break;
                                        case '1':
                                          $msgType = "text";
                                          $message='您尚未接任务或者任务已过期，请回复数字1';
                                          $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                          echo $resultStr; 
                                          break;
                                        case '2':
                                          //$items=$ordersClass->getAll6($username);

                                          /*
                                          $items=$ordersClass->getAll13($openid);
                                          $item=$items[0];  
                                          $id=$item['id'];
                                          $pid=$item['pid'];
                                          $title=$item['title'];
                                          $orderid=$item['orderid'];    

                                          */                            


                                          //$status='已放弃';
                                          //$ordersClass->update3($orderid,$status);

                                          //$ordersClass->update18($id);

                                          $orderid=$redis->get($now);
                                          $pid=$redis->get($T);
                                          
                                          $redis->lPush('N',$orderid);

                                          //$redis->lPush('T-'.$pid,$orderid);

                                          
                                          //$type='已放弃';
                                          //$doneClass->add($username,$pid,$title,$type);

                                          //$doneClass->add2($openid,$pid,$title,$type);

                                         
                                           
                                          $redis->set($queue,'0');


                                          
                                          $redis->sAdd($done , $pid);


                                          /*
                                          $PicUrl =$imgUrl;
                                          $title='[已参与][放弃]'.$title;
                                          $msgType = "news";
                                          $resultStr = sprintf($newsTpl, $fromUsername, $toUsername, $time, $msgType,$title,$intro, $PicUrl,$url);  
                                          
                                          echo $resultStr; 
                                          */

                                          $msgType = "text";
                                          //$message="您已经放弃任务*".$title."\n"."点击菜单*接任务*开始新的征程吧";
                                          $message.="放弃成功"."\n\n";
                                          $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                          echo $resultStr; 
                                          break;  
                                        case '3':
                                          $msgType = "text";
                                          $message='您已提交图片，请回复数字0';
                                          $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                          echo $resultStr; 
                                          
                                          break; 
                                        default:

                                          //$redis->set($queue,'0');
                                          $msgType = "text";
                                          $message='您当前没有正在进行中的任务，请点接任务。';
                                          $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                          echo $resultStr; 
                                          break;
                                    }


                                default:

                                 
                                  
                                    $message="<a href='#' >无法识别</a>";
                                    $message.=  "\n\n";
                                    $msgType='text';
                                    
                                    $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                                    echo $resultStr; 

                          
                                  

                                                          
                               }
                   
      
                   break;
                   case "image":
                     
                          
                            $status=$redis->get($queue);
                            if($status==0){
                              $msgType = "text";
                              $message='您尚未接任务或者任务已过期，请回复数字1';
                              $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                              echo $resultStr; 
                            }
                            if($status>1){

                              //$items=$ordersClass->getAll12($username);
                              // $items=$ordersClass->getAll15($openid);

                              // $item=$items[0];  
                              // $id=$item['id'];
                              // $pid=$item['pid'];
                              // $orderid=$item['orderid'];

                              $orderid=$redis->get($now);
                              $pid=$redis->get($T);

                              $media_id=$postObj->MediaId; 
                              $PicUrl=$postObj->PicUrl; 

                              $access_token=$this->getAccessToken();
                              $url = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=".$access_token."&media_id=".$media_id;
                              
                              
                              
                              
                              $time=date('YmdHis');
                              $p=md5($time);
                              $p1 = substr($p,0,1);
                              $p2 = substr($p,1,1);
                              $p3 = substr($p,2,1);

                              $folder='Uploads'.'/'.$p1.'/'.$p2.'/'.$p3.'/';
                              //if (!file_exists($folder)) {
                              //    mkdir($folder, 0777, true);
                              //}

                              //$targetName = $folder.$time.rand(1000,9999).'.jpg';
                              //20160521
                              //$i = rand(0,999);

                              $imgsortcode='img-'.$openid;
                              $i=$redis->incr($imgsortcode);
                              $targetName = $folder.$orderid.'-'.str_pad($i,2,'0',STR_PAD_LEFT).'.jpg';


                              /*
                              $ch = curl_init($url); // 初始化
                              $fp = fopen($targetName, 'wb'); // 打开写入
                              curl_setopt($ch, CURLOPT_FILE, $fp); // 设置输出文件的位置，值是一个资源类型
                              curl_setopt($ch, CURLOPT_HEADER, 0);
                              curl_exec($ch);
                              curl_close($ch);
                              fclose($fp);

                              */

                              
                              

                              //$ip=$this->getRealIpAddr();
                              //$ip='';
                              //$ordersClass->update4($orderid,$targetName);
                              //$ordersClass->update6($orderid,$targetName,$ip);
                              //$ordersClass->update7($orderid,$targetName,$PicUrl,$ip);
                              //$ordersClass->update9($id,$targetName,$PicUrl,$ip);

                              //$ordersClass->update19($id);

                              //$imagesClass->add($username,$pid,$orderid,$targetName,$PicUrl);

                              //$imagesClass->add2($openid,$pid,$orderid,$targetName,$PicUrl);

                              $redis->lPush('images', $pid.'#'.$orderid.'#'.$openid.'#'.$targetName.'#'.$PicUrl);

                              $redis->set($queue,'3');

                              $msgType = "text";
                              //$message="如果已经发送完毕，请回复[完成]。";

                              $message="如果有多张截图请继续发送，如果已经发送完毕，请回复数字0。";

                              $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                              echo $resultStr; 
                            }

                          

       
                   break;

                }                                        
                if(!empty( $keyword )){
                  $msgType = "text";
                  $message = "<a href='#' >无法识别</a>";
                  $message.=  "\n\n";
                  
                  $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $message);
                  echo $resultStr;
                }else{
                  echo "Input something...";
                }

        }else {
          echo "";
          exit;
        }
    }

    public function sendGetData($url){
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
    public function sendPostData($url,$curlPost){

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
        $return_str = curl_exec($curl);
        curl_close($curl);
        return $return_str;
    }
    public function send_template_message($template){
             $token=$this->getAccessToken();
             $url='https://api.weixin.qq.com/cgi-bin/message/template/send?access_token='.$token;        
             $res=$this->sendPostData($url,$template);
             return  json_decode($res,true);

    }
  private function checkSignature()
  {
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
            
    $token = TOKEN;
    $tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
    sort($tmpArr, SORT_STRING);
    $tmpStr = implode( $tmpArr );
    $tmpStr = sha1( $tmpStr );
    
    if( $tmpStr == $signature ){
      return true;
    }else{
      return false;
    }
  }

      public function getSignPackage() {
        $jsapiTicket = $this->getJsApiTicket();

        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        //$url='http://tel.xsdcm.cn/sample.php';

        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        $signature = sha1($string);

        $signPackage = array(
          "appId"     => $this->appId,
          "nonceStr"  => $nonceStr,
          "timestamp" => $timestamp,
          "url"       => $url,
          "signature" => $signature,
          "rawString" => $string
        );
        return $signPackage; 
      }

      private function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
          $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
      }

      private function getJsApiTicket() {
        // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
        $data = json_decode($this->get_php_file("jsapi_ticket.php"));
        if ($data->expire_time < time()) {
          $accessToken = $this->getAccessToken();
          // 如果是企业号用以下 URL 获取 ticket
          // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
          $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
          $res = json_decode($this->httpGet($url));
          $ticket = $res->ticket;
          if ($ticket) {
            $data->expire_time = time() + 7000;
            $data->jsapi_ticket = $ticket;
            $this->set_php_file("jsapi_ticket.php", json_encode($data));
          }
        } else {
          $ticket = $data->jsapi_ticket;
        }

        return $ticket;
      }


      private function getRealIpAddr(){
          if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
          {
            $ip=$_SERVER['HTTP_CLIENT_IP'];
          }
          elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
          {
            $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
          }
          else
          {
            $ip=$_SERVER['REMOTE_ADDR'];
          }
          return $ip;
      }
      private function getAccessToken() {
        // access_token 应该全局存储与更新，以下代码以写入到文件中做示例
        $data = json_decode($this->get_php_file("access_token.php"));
        if ($data->expire_time < time()) {
          // 如果是企业号用以下URL获取access_token
          // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
          $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$this->appId&secret=$this->appSecret";
          $res = json_decode($this->httpGet($url));
          $access_token = $res->access_token;
          if ($access_token) {
            $data->expire_time = time() + 7000;
            $data->access_token = $access_token;
            $this->set_php_file("access_token.php", json_encode($data));
          }
        } else {
          $access_token = $data->access_token;
        }
        return $access_token;
      }

      private function httpGet($url) {
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

      private function get_php_file($filename) {
        return trim(substr(file_get_contents($filename), 15));
      }
      private function set_php_file($filename, $content) {
        $fp = fopen($filename, "w");
        fwrite($fp, "<?php exit();?>" . $content);
        fclose($fp);
      }    
}

?>
