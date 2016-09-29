<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class paymentClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from payment";
    	return $this->getTotalNumber($sql);
	}
	
	function getCount2($username){
		$sql = "select count(*) as number from payment where username='$username'";
		//echo $sql;
		//echo '<br>';
    	return $this->getTotalNumber($sql);
	}

	function getAll(){
		$sql = "select * from payment order by id desc";
		return $this->selectArray($sql);
	}	

	function getAll2($username){
		$sql = "select * from payment where username='$username' order by id desc";
		return $this->selectArray($sql);
	}

	function add($username,$time,$fee){		
		$sql = "INSERT  INTO payment(username,time,fee,status,createTime) Values('$username','$time','$fee','未提取',now())";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}	
	function update($orderid,$status){
		$sql = "update payment set status='$status' where orderid='$orderid'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
	function update2($orderid,$vercode,$status){
		$sql = "update payment set vercode2='$vercode',status='$status' where orderid='$orderid'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}

	function del($id){
		$sql = "delete from payment where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		
	function drop($website){
		$sql = "delete from payment where website='$website'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
}