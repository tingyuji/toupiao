<?php
require_once('wxsdk.php');
define("TOKEN", "weixin");
setlocale(LC_ALL, 'zh_CN.utf-8');
header("Content-Type:text/html;charset=utf-8");

$wechatObj = new wechatCallbackapiTest("wxdda2a0fe7a1637eb","efb9b15278468609f611fb9f313844ca");

require_once 'class/mapping.class.php';
require_once 'class/queue.class.php';
require_once 'class/task.class.php';
require_once 'class/orders.class.php';


$mappingClass=new mappingClass();
$queueClass=new queueClass();
$taskClass=new taskClass();
$ordersClass=new ordersClass();


$data='
{
    "touser":"oMZx0wyzSph5Y5wmhA7ePk1qvVKY",
    "msgtype":"news",
    "news":{
        "articles": [
         {
             "title":"Happy Day",
             "description":"Is Really A Happy Day",
             "url":"URL",
             "picurl":"PIC_URL"
         }
         ]
    }
}
';



  $redis = new redis(); 
  $redis->connect('127.0.0.1', 6379); 

  $pid='01613';
  $queueItems=$queueClass->getAll3($pid);
  echo '<pre>';
  print_r($queueItems);
  //exit();


  foreach ($queueItems as $queueItem) {

      //sleep(20);
      $now=date('Y-m-d H:i:s');
      echo $now;
      echo "\n";
      $pid=$queueItem['pid'];
      $orderid=$queueItem['orderid'];
      $img1=$queueItem['img1'];
      $img2=$queueItem['img2'];
      $type=$queueItem['type'];
      $url='http://www.fangdan8.com/wx/img1.php?id=1613';
      $title='【平台派发*优先处理】'.$queueItem['title'];
      $note=$queueItem['note'];

      echo $orderid;
      echo "\n";

      $openid=$redis->rpop('openid');
      $queue='queue-'.$openid;

      

      $status=$redis->get($queue);

      echo $status;
      echo "\n";
      switch ($status) {
          case 0:
              $redis->set($queue,'2');
              

              $pid=intval($pid);
              $orderid=$ordersClass->makeorderid();
              $ordersClass->add3($openid,$orderid,$pid,$title);
              $redis->set($queue,'2');

              $data=array(
                     'touser'=>$openid,
                     "msgtype"=>"news",
                     'news'=>array(
                        "articles"=> array(

                                  array(
                                   "title"=>$title,
                                   "description"=>$note,
                                   "url"=>$url,
                                   "picurl"=>'http://www.fangdan8.com/wxfb/'.$img1
                                  )
                          )

                      )
                               
              );


              $json=json_encode($data,JSON_UNESCAPED_UNICODE);
              echo $json;
              echo "\n";

              $ret=$wechatObj->send_kefu_message($json); 
              var_dump($ret);
              echo "\n";
                break;
          case 1:
              $redis->set($queue,'2');
              

              $pid=intval($pid);
              $orderid=$ordersClass->makeorderid();
              $ordersClass->add3($openid,$orderid,$pid,$title);
              $redis->set($queue,'2');

              $data=array(
                     'touser'=>$openid,
                     "msgtype"=>"news",
                     'news'=>array(
                        "articles"=> array(

                                  array(
                                   "title"=>$title,
                                   "description"=>$note,
                                   "url"=>$url,
                                   "picurl"=>'http://www.fangdan8.com/wxfb/'.$img1
                                  )
                          )

                      )
                               
              );


              $json=json_encode($data,JSON_UNESCAPED_UNICODE);
              echo $json;
              echo "\n";

              $ret=$wechatObj->send_kefu_message($json); 
              var_dump($ret);
              echo "\n";
                break;
            case 2:

              $redis->set($queue,'2');
              

              $pid=intval($pid);
              $orderid=$ordersClass->makeorderid();
              $ordersClass->add3($openid,$orderid,$pid,$title);
              $redis->set($queue,'2');

              $data=array(
                     'touser'=>$openid,
                     "msgtype"=>"news",
                     'news'=>array(
                        "articles"=> array(

                                  array(
                                   "title"=>$title,
                                   "description"=>$note,
                                   "url"=>$url,
                                   "picurl"=>'http://www.fangdan8.com/wxfb/'.$img1
                                  )
                          )

                      )
                               
              );


              $json=json_encode($data,JSON_UNESCAPED_UNICODE);
              echo $json;
              echo "\n";

              $ret=$wechatObj->send_kefu_message($json); 
              var_dump($ret);
              echo "\n";            
                //echo '该用户还有任务尚未完成';
                //echo "\n";
                break;
            default:
                echo '未知情况，请核查';
                echo "\n";
      }


      

                  
  }




  




?>








