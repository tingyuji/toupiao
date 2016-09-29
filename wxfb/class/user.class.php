<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class userClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from user";
    	return $this->getTotalNumber($sql);
	}
	
	function getCount2($username,$password){
		$password=md5($password);
		$sql = "select count(*) as number from user where username='$username' and password='$password' ";
    	return $this->getTotalNumber($sql);
	}
	function getCount3($newcode){
		$sql = "select count(*) as number from user where inviteCode='$newcode' ";
    	return $this->getTotalNumber($sql);
	}

	function getAll(){
		$sql = "select * from user order by id desc";
		return $this->selectArray($sql);		
	}

	function getAll2($username,$password){
		$password=md5($password);
		$sql = "select * from user where username='$username' and password='$password' order by id desc";
		return $this->selectArray($sql);		
	}

	function getAll3($newcode){
		$sql = "select * from user where inviteCode='$newcode' order by id desc";
		return $this->selectArray($sql);		
	}		
	//
	function getAll4($inviteCode){
		$sql = "select * from user where newcode='$inviteCode' order by id desc";
		return $this->selectArray($sql);		
	}			
	function getAllItems($offset,$rows){
		$sql = "select * from user order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}




	function add($username,$password,$inviteCode,$name,$email,$tel,$QQ,$newcode){	

		$password=md5($password);
		$sql = "INSERT  INTO user(username,password,inviteCode,name,email,tel,QQ,newcode,createTime) Values('$username','$password','$inviteCode','$name','$email','$tel','$QQ','$newcode',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update($username,$password){
		$password=md5($password);
		$sql = "update user set password='$password' where username='$username'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update2($username,$amount){
		$sql = "update user set fee=fee+$amount where username='$username'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

	function del($id){
		$sql = "delete from user where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}