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

	function getCount5($username,$status){
		$sql = "select count(*) as number from orders where username='$username' and status='$status' ";
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

	function getAll5($username,$status){
		$sql = "select a.orderid,a.pid,a.status,a.data,b.title,b.url,b.num,b.complete,b.price2,b.onetime from orders a inner join task b on a.pid=b.id  where a.username='$username' and a.status='$status' order by a.id desc";
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
            $orderid = date('Ymd').str_pad($i,6,'0',STR_PAD_LEFT);

            $total=$this->getAll2($orderid);
        }while($total);
        return $orderid;
	}	
	function add($username,$orderid,$pid,$title,$imgfile,$memo){	

		$sql = "INSERT  INTO orders(username,orderid,pid,title,imgfile,memo,status,createTime) Values('$username','$orderid','$pid','$title','$imgfile','$memo','未上传',now())";
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
	function del($id){
		$sql = "delete from orders where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}