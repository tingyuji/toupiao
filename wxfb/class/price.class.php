<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class priceClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from price";
    	return $this->getTotalNumber($sql);
	}


	function getCount2($level){
		$sql = "select count(*) as number from price where type='$level' ";
    	return $this->getTotalNumber($sql);
	}


	function getAll(){
		$sql = "select * from price order by price1 asc";
		return $this->selectArray($sql);		
	}


	function getAll2($level){
		$sql = "select * from price where type='$level' order by price1 asc";
		return $this->selectArray($sql);		
	}


	function getAllItems($offset,$rows){
		$sql = "select * from price order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function update($id,$password){
		$sql = "update price set password='$password' where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
	function add($price1,$price2){		
		$sql = "INSERT  INTO price(price1,price2,createTime) Values('$price1','$price2',now())";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
	function del($id){
		$sql = "delete from price where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}		

}