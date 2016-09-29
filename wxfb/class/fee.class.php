<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class feeClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from fee";
    	return $this->getTotalNumber($sql);
	}

	function getAllByorderid($orderid){
		$sql = "select count(*) as number from fee where orderid='$orderid'";
    	return $this->getTotalNumber($sql);
	}	
	function getCountByKeyword($orderid){
		$sql = "select count(*) as number from fee where orderid='$orderid'";
    	return $this->getTotalNumber($sql);
	}
	function getCountBytodo(){
		$sql = "select count(*) as number from fee where status='待处理'";
    	return $this->getTotalNumber($sql);
	}
	function getCountBydone(){
		$sql = "select count(*) as number from fee where status!='待处理'";
    	return $this->getTotalNumber($sql);
	}				
	function getCountByKeyword2($username,$orderid){
		$sql = "select count(*) as number from fee where username='$username' and orderid='$orderid'";
    	return $this->getTotalNumber($sql);
	}			
	function getCount2($username){
		$sql = "select count(*) as number from fee where username='$username'";
		//echo $sql;
		//echo '<br>';
    	return $this->getTotalNumber($sql);
	}
	function getFee($username,$status){
		$sql = "select sum(fee) as number from fee where username='$username' and status='$status'";
		//echo $sql;
		//echo '<br>';
    	return $this->getTotalNumber($sql);
	}			
	function getAllItems($offset,$rows){
		$sql = "select * from fee order by id asc limit $offset,$rows";
		return $this->selectArray($sql);		
	}
	function getAllItemsByKeyword($keyword){
		$sql = "select * from fee where orderid='$keyword' order by id desc";
		return $this->selectArray($sql);		
	}	
	function getAllItemsByKeyword2($username,$keyword){
		$sql = "select * from fee where username='$username' and orderid='$keyword' order by id desc";
		return $this->selectArray($sql);		
	}		
	function getAllItemsBytodo($offset,$rows){
		$sql = "select * from fee where status='待处理' order by id asc limit $offset,$rows";
		return $this->selectArray($sql);		
	}	
	function getAllItemsBydone($offset,$rows){
		$sql = "select * from fee where status!='待处理' order by id asc limit $offset,$rows";
		return $this->selectArray($sql);		
	}			
	function getAllItems2($username,$offset,$rows){
		$sql = "select * from fee where username='$username' order by id desc limit $offset,$rows";
		//echo $sql;
		//echo '<br>';		
		return $this->selectArray($sql);		
	}
	function getAll(){
		$sql = "select * from fee order by id desc";
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
	function add($orderid,$username,$fee){		
		$sql = "INSERT  INTO fee(orderid,username,fee,status,createTime) Values('$orderid','$username','$fee','未提取',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	function update($orderid,$status){
		$sql = "update fee set status='$status' where orderid='$orderid'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
	function update2($orderid,$vercode,$status){
		$sql = "update fee set vercode2='$vercode',status='$status' where orderid='$orderid'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}

	function del($id){
		$sql = "delete from fee where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		
	function drop($website){
		$sql = "delete from fee where website='$website'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
}