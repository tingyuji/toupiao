<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class tradeClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from trade";
    	return $this->getTotalNumber($sql);
	}
	function getCount2($username){
		$sql = "select count(*) as number from trade where username ='$username' ";
		//echo $sql;
		//echo '<br>';
    	return $this->getTotalNumber($sql);
	}	

	function getAll(){
		$sql = "select * from trade order by id desc";
		return $this->selectArray($sql);		
	}

	function getAll2($username){
		$sql = "select * from trade where username='$username' order by id desc";
		return $this->selectArray($sql);		
	}

	function getAllItems($offset,$rows){
		$sql = "select * from trade order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function update($id,$password){
		$sql = "update trade set password='$password' where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
	function add($username,$fee,$orderNo,$action,$remarks){		
		$sql = "INSERT  INTO trade(username,fee,orderNo,action,remarks,createTime) Values('$username','$fee','$orderNo','$action','$remarks',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	function delItemByid($id){
		$sql = "delete from trade where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}		

}