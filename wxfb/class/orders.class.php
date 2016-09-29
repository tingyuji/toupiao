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

	function getCount2($username){
		$sql = "select count(*) as number from orders where username='$username'";
    	return $this->getTotalNumber($sql);
	}
	function getCount3($username){
		$sql = "select count(*) as number from orders where username2='$username'";
    	return $this->getTotalNumber($sql);
	}	
	function getCount4($pid){
		$sql = "select count(*) as number from orders where pid='$pid'";
    	return $this->getTotalNumber($sql);
	}		
	function getCount5($id){
		$sql = "select count(*) as number from orders where id='$id'";
    	return $this->getTotalNumber($sql);
	}	

	function getCount6($pid,$status){
		$sql = "select count(*) as number from orders where pid='$pid' and status='$status' ";
    	return $this->getTotalNumber($sql);
	}

	function getCount7($pid){
		$sql = "select count(*) as number from orders where pid='$pid' and status not in ('未上传','已放弃') ";
    	return $this->getTotalNumber($sql);
	}


	function getCount8($pid){
		$sql = "select count(*) as number from orders where pid='$pid' and status in ('已上传','已完成','已审核')";
    	return $this->getTotalNumber($sql);
	}


	function getCount9($pid){
		$sql = "select count(*) as number from ordersdelta where pid='$pid'";
    	return $this->getTotalNumber($sql);
	}		

	function getCount10($openid){
		$sql = "select count(*) as number from ordersdelta where openid='$openid'";
    	return $this->getTotalNumber($sql);
	}	

	function getAllItems($offset,$rows){
		$sql = "select * from orders order by id asc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function getAllItems2($username,$offset,$rows){
		$sql = "select * from orders where username='$username' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}
	function getAllItems3($username,$offset,$rows){
		$sql = "select * from orders where username2='$username' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}	
	function getAll(){
		$sql = "select * from orders order by id desc";
		return $this->selectArray($sql);
	}	
	function getAll4($pid){
		$sql = "select * from orders where pid='$pid' order by id desc";
		return $this->selectArray($sql);
	}		

	function getAll5($id){
		$sql = "select * from orders where id='$id' order by id desc";
		return $this->selectArray($sql);
	}	
	function getAll6($pid,$orderid){
		$sql = "select * from orders where pid='$pid' and orderid='$orderid' order by id desc";
		return $this->selectArray($sql);
	}	
	function getAll7($pid){
		$sql = "select * from orders where pid='$pid' and status not in ('未上传','已放弃') order by id desc";
		return $this->selectArray($sql);
	}	

	function getAll8($pid){
		$sql = "select orderid,status,group_concat(img) as imgs from images where pid=$pid group by orderid order by id desc";
		return $this->selectArray($sql);
	}

	function getAll9($pid){
		$sql = "select orderid,status,group_concat(img) as imgs from imagesdelta where pid=$pid group by orderid order by id desc";
		return $this->selectArray($sql);
	}

	function getAll10($openid){
		$sql = "select orderid,group_concat(img) as imgs from imagesdelta where openid='$openid' group by orderid order by id desc";
		return $this->selectArray($sql);
	}

	function getAll18($orderid){
		$sql = "select * from orders where orderid='$orderid' order by id desc";
		return $this->selectArray($sql);
	}	
	function makeorderid(){

        //$i = rand(0,9999);
        $i=0;
        do{
            if(999==$i){
                $i=0;
            }
            $i++;
            $orderid = date('Ymd').str_pad($i,3,'0',STR_PAD_LEFT);
            $total=$this->getAllByorderid($orderid);
        }while($total);
        return $orderid;
	}	
	function add($openid,$orderid){
		$sql = "INSERT  INTO orders(openid,orderid,status,createTime) Values('$openid','$orderid','未支付',now())";
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
	function update2($orderid){
		$sql = "update orders set status='已审核',data='投诉' where orderid='$orderid'";
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