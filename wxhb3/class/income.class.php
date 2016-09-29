<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class incomeClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from income";
    	return $this->getTotalNumber($sql);
	}
	function getCount2($username){
		$sql = "select count(*) as number from income where username = '$username' and fee>0";
		//echo $sql;
		//echo '<br>';
    	return $this->getTotalNumber($sql);
	}	
	function getCount3($username){
		$sql = "select sum(fee) as number from income where username = '$username'";
		//echo $sql;
		//echo '<br>';
    	return $this->getTotalNumber($sql);
	}
	function getAll(){
		$sql = "select * from income order by id desc";
		return $this->selectArray($sql);		
	}
	function getAll2($username){
		$sql = "select * from income where username='$username' and fee>0 order by id desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}


	function add($username,$fee,$orderid,$action){		
		$sql = "INSERT  INTO income(username,fee,orderid,action,createTime) Values('$username','$fee','$orderid','$action',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update($id,$password){
		$sql = "update income set password='$password' where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
	function del($id){
		$sql = "delete from income where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}		

}