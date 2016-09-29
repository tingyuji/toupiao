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
		$sql = "select count(*) as number from user where username='$username' and password='$password' ";
    	return $this->getTotalNumber($sql);
	}


	function getAll(){
		$sql = "select * from user order by id asc";
		return $this->selectArray($sql);		
	}

	function getAll2($username,$password){
		$sql = "select * from user where username='$username' and password='$password' order by id desc";
		return $this->selectArray($sql);		
	}	
	function getAllItems($offset,$rows){
		$sql = "select id,name,level,fee,balance,inviteCode,newcode,status,createTime from user order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}




	function add($username,$password,$inviteCode,$name,$email,$tel,$QQ){	

		$sql = "INSERT  INTO user(username,password,inviteCode,name,email,tel,QQ,createTime) Values('$username','$password','$inviteCode','$name','$email','$tel','$QQ',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update($username,$password){
		$sql = "update user set password=password('$password') where username='$username'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

	function update2($openid,$name,$female,$addr,$birthday){
		$sql = "update user set name='$name',female='$female',addr='$addr',birthday='$birthday' where openid='$openid'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update3($id,$status){
		$sql = "update user set status='$status' where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}


	function update4($id,$balance){
		$sql = "update user set balance='$balance' where id='$id' ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

	function update5($username,$fee){
		$sql = "update user set fee='$fee' where username='$username' ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

	function update6($id,$level){
		$sql = "update user set level='$level' where id='$id' ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

	function del($id){
		$sql = "delete from user where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}