<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class workerClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from worker";
    	return $this->getTotalNumber($sql);
	}
	
	function getCount2($username,$password){
		$sql = "select count(*) as number from worker where username='$username' and password='$password' ";
    	return $this->getTotalNumber($sql);
	}


	function getAll(){
		$sql = "select * from worker order by id desc";
		return $this->selectArray($sql);		
	}

	function getAll2($username,$password){
		$sql = "select * from worker where username='$username' and password='$password' order by id desc";
		return $this->selectArray($sql);		
	}	

	function getAll3($username){
		$sql = "select * from worker where username='$username' order by id desc";
		return $this->selectArray($sql);		
	}

	function getAll4(){
		$sql = "select * from worker where inviteCode is NULL order by id asc";
		return $this->selectArray($sql);		
	}

	function getAllItems($offset,$rows){
		$sql = "select id,username,name,tel,newcode,status,createTime from worker order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}




	function add($username,$password,$inviteCode,$name,$email,$tel,$QQ){	

		$sql = "INSERT  INTO worker(username,password,inviteCode,name,email,tel,QQ,createTime) Values('$username','$password','$inviteCode','$name','$email','$tel','$QQ',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update($workername,$password){
		$sql = "update worker set password=password('$password') where workername='$workername'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

	function update2($openid,$name,$female,$addr,$birthday){
		$sql = "update worker set name='$name',female='$female',addr='$addr',birthday='$birthday' where openid='$openid'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update3($id,$status){
		$sql = "update worker set status='$status' where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}



	function update4($id,$inviteCode){
		$sql = "update worker set inviteCode='$inviteCode' where id='$id'";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

	function update5($newcode,$newCode2){
		$sql = "update worker set newcode='$newCode2' where newcode='$newcode'";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}


	function update6($username,$password){
		$sql = "update worker set status='禁用',password='$password' where username='$username'";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}


	function del($id){
		$sql = "delete from worker where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}