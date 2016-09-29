<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class modelClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from model";
    	return $this->getTotalNumber($sql);
	}
	function getCountByKeyword($Keyword){
		$sql = "select count(*) as number from model where name like '%$Keyword%'";
		//echo $sql;
		//echo '<br>';
    	return $this->getTotalNumber($sql);
	}	
	function getCountByName($Name,$Password){
		$sql = "select count(*) as number from model where Name='$Name' and Password='$Password'";
    	//echo $sql;
    	//echo '<br>';
    	return $this->getTotalNumber($sql);
	}
	function getCountByName2($Name){
		$sql = "select count(*) as number from model where account='$Name'";
    	return $this->getTotalNumber($sql);
	}	
	
	function getAllItemsByName($Name,$Password){
		$sql = "select * from model where Name='$Name' and Password='$Password' order by id desc";
		return $this->selectArray($sql);
	}
	function getAll(){
		$sql = "select * from model order by id desc";
		return $this->selectArray($sql);		
	}

	function getAllItems($offset,$rows){
		$sql = "select * from model order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}
	function getAllItemsByKeyword($Keyword){
		$sql = "select * from model where name like '%$Keyword%' order by id desc";
		return $this->selectArray($sql);
	}	
	function getItemByID($ID){
		$sql = "select * from model where id='$ID' order by id desc";
		return $this->selectArray($sql);
	}							
	function getAllItemsByName2($Name){
		$sql = "select * from model where Name='$Name' order by id desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);
	}		
	function update($id,$password){
		$sql = "update model set password='$password' where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
	function add($name,$remarks){		
		$sql = "INSERT  INTO model(name,remarks,createTime) Values('$name','$remarks',now())";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
	function del($id){
		$sql = "delete from model where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}		

}