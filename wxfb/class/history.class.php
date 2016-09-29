<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class historyClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from history";
    	return $this->getTotalNumber($sql);
	}
	function getCount2($pid){
		$sql = "select count(*) as number from history where pid='$pid'";
    	return $this->getTotalNumber($sql);
	}
	function getAll(){
		$sql = "select * from history order by id desc";
		return $this->selectArray($sql);		
	}
	function getAll2($pid){
		$sql = "select * from history where pid='$pid' order by id desc";
		return $this->selectArray($sql);		
	}
	function getAllItems($offset,$rows){
		$sql = "select * from history order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function update($id,$password){
		$sql = "update history set password='$password' where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
	function add($username,$pid,$action,$fee){		
		$sql = "INSERT  INTO history(username,pid,action,fee,createTime) Values('$username','$pid','$action','$fee',now())";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
	function del($id){
		$sql = "delete from history where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}		

}