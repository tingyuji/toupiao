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

	function getCount2(){
		$sql = "select sum(fee) as number from fee where createTime>curdate() ";
    	return $this->getTotalNumber($sql);
	}
	
	function getAllItems($offset,$rows){
		$sql = "select * from fee order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}	
	function getAll(){
		$sql = "select * from fee order by id desc";
		return $this->selectArray($sql);		
	}

	function getAll2(){
		$sql = "select * from fee where TIMESTAMPDIFF(MINUTE,createTime,now())>1 and status='已确认' order by id asc";
		return $this->selectArray($sql);		
	}
		
	function update($id,$status){
		$sql = "update fee set status='$status' where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
	function add($username,$fee,$action){		
		$sql = "INSERT  INTO fee(username,fee,action,createTime) Values('$username','$fee','$action',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	function del($id){
		$sql = "delete from fee where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	

	function del2($time){
		$sql = "delete from fee where time='$time' ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}



}