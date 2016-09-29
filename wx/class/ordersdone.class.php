<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class ordersdoneClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from ordersdone";
    	return $this->getTotalNumber($sql);
	}
	function getCount2($pid){
		$sql = "select count(*) as number from ordersdone where pid='$pid' ";
    	return $this->getTotalNumber($sql);
	}	
	function getCount3($openid){

		$today=date("Y-m-d");
		$sql = "select count(*) as number from ordersdone where openid='$openid' and left(createTime,10)='$today' ";

		// $today='2016-08-21';
		// $sql = "select count(*) as number from ordersdone where openid='$openid' and createTime>'$today' ";
    	return $this->getTotalNumber($sql);
	}

	function getCount4($openid){

		// $today=date("Y-m-d");
		// $sql = "select count(*) as number from ordersdone where openid='$openid' and left(createTime,10)='$today' ";

		$today='2016-08-21';
		$sql = "select count(*) as number from ordersdone where openid='$openid' and createTime>'$today' ";
    	return $this->getTotalNumber($sql);
	}

	function getAll(){
		$sql = "select * from ordersdone order by id desc";
		return $this->selectArray($sql);
	}	


	function add($openid,$pid,$orderid){	

		$sql = "INSERT  INTO ordersdone(openid,pid,orderid,createTime) Values('$openid','$pid','$orderid',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}


	function update($orderid,$status){
		$sql = "update ordersdone set status='$status' where orderid='$orderid'";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

		
	function del($id){
		$sql = "delete from ordersdone where id=$id ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}


}
