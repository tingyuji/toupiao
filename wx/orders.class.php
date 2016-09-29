<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class ordersClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from orders";
    	return $this->getTotalNumber($sql);
	}
	function getCount2($orderid){
		$sql = "select count(*) as number from orders where orderid='$orderid'";
    	return $this->getTotalNumber($sql);
	}	
	function getCount3($username){
		$sql = "select count(*) as number from orders where username='$username'";
    	return $this->getTotalNumber($sql);
	}
	function getCount4($pid,$username){
		$sql = "select count(*) as number from orders where pid='$pid' and username='$username'";
    	return $this->getTotalNumber($sql);
	}	
	function getCount5($status){
		$sql = "select count(*) as number from orders where status='未上传'";
    	return $this->getTotalNumber($sql);
	}		

	function getCount6($username){
		$sql = "select count(*) as number from orders where username='$username' and status='未上传'";
    	return $this->getTotalNumber($sql);
	}

	function getCount7($username){
		$sql = "select count(*) as number from orders where username='$username' and status='已上传'";
    	return $this->getTotalNumber($sql);
	}	

	function getAllItems($offset,$rows){
		$sql = "select * from orders order by id asc limit $offset,$rows";
		return $this->selectArray($sql);		
	}
	
	function getAllItems3($username,$offset,$rows){
		$sql = "select b.* from orders a inner join task b on a.pid=b.id where a.username='$username' order by a.id asc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function getAll(){
		$sql = "select * from orders order by id desc";
		return $this->selectArray($sql);
	}	
	function getAll2($orderid){
		$sql = "select * from orders where orderid='$orderid' order by id desc";
		return $this->selectArray($sql);
	}		
	function getAll3($username){
		$sql = "select a.orderid,a.pid,a.status,b.title,b.url,b.num,b.complete,b.price2,b.onetime from orders a inner join task b on a.pid=b.id where a.username='$username' order by a.id desc";
		return $this->selectArray($sql);
	}	
	function getAll4($pid,$username){
		$sql = "select * from orders where pid='$pid' and username='$username' order by id desc";
		return $this->selectArray($sql);
	}

	function getAll5(){
		$sql = "select * from orders where status='未上传' order by id desc";
		return $this->selectArray($sql);
	}		

	function getAll6($username){
		$sql = "select * from orders where username='$username' and status='未上传' order by id desc";

		return $this->selectArray($sql);



	}	
	function getAll7($username){
		$sql = "select * from orders where username='$username' and status='已上传' order by id desc";
		return $this->selectArray($sql);
	}			

	function getAll8(){
		$sql = "select * from orders where id<1295 and status in ('已上传','已完成','已审核') order by id asc";
		return $this->selectArray($sql);
	}	

	function getAll9(){
		$sql = "select * from orders where createTime<'2016-04-07 01:00:00' order by id asc";
		return $this->selectArray($sql);
	}	
	function makeorderid(){

        $i = rand(0,999999);
        //$i=0;
        do{
            if(999999==$i){
                $i=0;
            }
            $i++;
            $orderid = date('YmdH').str_pad($i,6,'0',STR_PAD_LEFT);

            $total=$this->getAll2($orderid);
        }while($total);
        return $orderid;
	}	
	function add($username,$orderid,$pid,$title,$imgfile,$memo,$source){	

		$sql = "INSERT  INTO orders(username,orderid,pid,title,imgfile,memo,source,status,createTime) Values('$username','$orderid','$pid','$title','$imgfile','$memo','$source','未上传',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);


		$sql = "update worker set num=num+1 where username='$username'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update($orderid,$fee){
		$sql = "update orders set fee='$fee' where orderid='$orderid'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
	function update2($pid,$orderid,$imgfile){
		$sql = "update orders set imgfile='$imgfile',status='已上传' where pid='$pid' and orderid='$orderid'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}

	function update3($orderid,$status){
		$sql = "update orders set status='$status' where orderid='$orderid'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update4($orderid,$imgfile){
		$sql = "update orders set imgfile='$imgfile',status='已上传' where orderid='$orderid'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}

	function update5($id,$imgfile){
		$sql = "update orders set imgfile='$imgfile' where id='$id'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}


	function del($id){
		$sql = "delete from orders where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}