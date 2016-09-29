<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class logClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from log";
    	return $this->getTotalNumber($sql);
	}
	function getCount2($username){
		$sql = "select count(*) as number from log where username='$username'";
    	return $this->getTotalNumber($sql);
	}	
	function getCountByKeyword($Keyword){
		$sql = "select count(*) as number from log where username like '%$Keyword%'";
    	return $this->getTotalNumber($sql);
	}	
	function getCountByName($Name,$Password){
		$sql = "select count(*) as number from log where Name='$Name' and Password='$Password'";
    	//echo $sql;
    	//echo '<br>';
    	return $this->getTotalNumber($sql);
	}
	function getCountByName2($Name){
		$sql = "select count(*) as number from log where account='$Name'";
    	return $this->getTotalNumber($sql);
	}	
	
	function getAllItemsByName($Name,$Password){
		$sql = "select * from log where Name='$Name' and Password='$Password' order by id desc";
		return $this->selectArray($sql);
	}

	function getAllItems($offset,$rows){
		$sql = "select * from log order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function getAllItems2($username,$offset,$rows){
		$sql = "select * from log where username='$username' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}	
	function getAllItemsByKeyword($Keyword,$offset,$rows){
		$sql = "select * from log where username like '%$Keyword%' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);
	}	
	function getAllById($id){
		$sql = "select * from log where id='$id' order by id desc";
		return $this->selectArray($sql);
	}							
	function getAllItemsByName2($Name){
		$sql = "select * from log where Name='$Name' order by id desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);
	}		
	function update($id,$password){
		$sql = "update log set password='$password' where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
	function addItem($username){		
		$sql = "INSERT  INTO log(username,createTime) Values('$username',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	function delItemByid($id){
		$sql = "delete from log where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}		

}