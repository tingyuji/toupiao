<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class sanhaoClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from sanhao";
    	return $this->getTotalNumber($sql);
	}
	function getCount2($wxusername){
		$sql = "select count(*) as number from sanhao where wxusername='$wxusername'";
		echo $sql;
		echo "\n";
		
    	return $this->getTotalNumber($sql);
	}	

	function getAll(){
		$sql = "select * from sanhao order by id desc";
		return $this->selectArray($sql);		
	}	

	function getAll2($wxusername){
		$sql = "select * from sanhao where wxusername='$wxusername' order by id desc";
		echo $sql;
		echo "\n";
		return $this->selectArray($sql);		
	}	

	function getAll3(){
		$sql = "select username,count(*) from sanhao group by username HAVING count(*)>1 ";
		return $this->selectArray($sql);		
	}	

	function update($wxusername,$username){
		$sql = "update sanhao set username='$username' where wxusername='$wxusername'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update2($wxusername,$password){
		$sql = "update sanhao set password='$password' where wxusername='$wxusername'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update3($wxusername,$step){
		$sql = "update sanhao set step='$step' where wxusername='$wxusername'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update4($wxusername,$status){
		$sql = "update sanhao set status='$status' where wxusername='$wxusername'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

	function update5($username,$orderCount){
		$sql = "update sanhao set orderCount='$orderCount' where username='$username'";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

	function update6($username,$inviteCode){
		$sql = "update sanhao set inviteCode='$inviteCode' where username='$username'";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}
	
	function add($wxusername){	

		$sql = "INSERT  INTO sanhao(wxusername,createTime) Values('$wxusername',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	

	function del($id){
		$sql = "delete from sanhao where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	

	function del2($username){
		$sql = "delete from sanhao where username='$username'";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}	

	function del3($wxusername){
		$sql = "delete from sanhao where wxusername='$wxusername'";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}	



}