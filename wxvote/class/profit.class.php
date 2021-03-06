<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class profitClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from profit";
    	return $this->getTotalNumber($sql);
	}

	function getAllItems($offset,$rows){
		$sql = "select * from profit order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function getAll(){
		$sql = "select * from profit order by id desc";
		return $this->selectArray($sql);		
	}


	function add($username,$fee,$orderid,$action){		
		$sql = "INSERT  INTO profit(username,fee,orderid,action,createTime) Values('$username','$fee','$orderid','$action',now())";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}
	function update($id,$password){
		$sql = "update profit set password='$password' where id=$id";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}	
	function del($orderid){
		$sql = "delete from profit where orderid='$orderid'";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}		

}