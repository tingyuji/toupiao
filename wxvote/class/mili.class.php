<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class miliClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from mili";
    	return $this->getTotalNumber($sql);
	}
	function getCount2($wxusername){
		$sql = "select count(*) as number from mili where wxusername='$wxusername'";
    	return $this->getTotalNumber($sql);
	}	
	

	function getAll(){
		$sql = "select * from mili where wxusername !='' order by id desc";
		return $this->selectArray($sql);		
	}	

	function getAll2($wxusername){
		$sql = "select * from mili where wxusername='$wxusername' order by id desc";
		return $this->selectArray($sql);		
	}	
	
	
	
	function getAll3($orderCount){
		$sql = "select * from mili where orderCount > $orderCount order by id desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}	

	function getAll4(){
		$sql = "select username,count(*) from mili group by username HAVING count(*)>1 ";
		return $this->selectArray($sql);		
	}
	function update($wxusername,$username){
		$sql = "update mili set username='$username' where wxusername='$wxusername'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update2($wxusername,$password){
		$sql = "update mili set password='$password' where wxusername='$wxusername'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update3($wxusername,$step){
		$sql = "update mili set step='$step' where wxusername='$wxusername'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update4($wxusername,$status){
		$sql = "update mili set status='$status' where wxusername='$wxusername'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

	function add($wxusername){	

		$sql = "INSERT  INTO mili(wxusername,createTime) Values('$wxusername',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	

	function del($openid){
		$sql = "delete from mili where wxusername='$openid'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	function del2($username){
		$sql = "delete from mili where username='$username'";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}		

}
