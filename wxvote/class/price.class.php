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

	function getAll(){
		$sql = "select * from price order by id desc";
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
	function add($type,$price1,$price2){		
		$sql = "INSERT  INTO price(type,price1,price2,createTime) Values('$type','$price1','$price2',now())";
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