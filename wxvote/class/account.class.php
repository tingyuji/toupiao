<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class accountClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from account";
    	return $this->getTotalNumber($sql);
	}
	function getCount2($username){
		$sql = "select count(*) as number from account where username='$username'";
    	return $this->getTotalNumber($sql);
	}	
	function getCount3(){
		$sql = "select count(*) as number from account where role='售票员'";
    	return $this->getTotalNumber($sql);
	}		
	function getCountByKeyword($keyword){
		$sql = "select count(*) as number from account where username like '%$keyword%'";
    	return $this->getTotalNumber($sql);
	}	

	function getCountByKeyword2($keyword){
		$sql = "select count(*) as number from account where role = '$keyword'";
    	return $this->getTotalNumber($sql);
	}		
	function getCountByusername($username,$password){
		$sql = "select count(*) as number from account where username='$username' and password=password('$password')";
    	//echo $sql;
    	//echo '<br>';
    	return $this->getTotalNumber($sql);
	}
	function getCountByName($username){
		$sql = "select count(*) as number from account where username='$username'";
    	return $this->getTotalNumber($sql);
	}	

	function getAllItemsByName($username){
		$sql = "select * from account where username='$username' order by id desc";
		return $this->selectArray($sql);
	}		
	
	function getAllItemsByusername($username,$password){
		$sql = "select * from account where username='$username' and password=password('$password') order by id desc";
		return $this->selectArray($sql);
	}
	function getAll(){
		$sql = "select * from account order by id desc";
		return $this->selectArray($sql);		
	}

	function getAll2($username){
		$sql = "select * from account where username='$username' order by id desc";
		return $this->selectArray($sql);		
	}	

	function getAll3(){
		$sql = "select * from account where role='售票员' order by id desc";
		return $this->selectArray($sql);		
	}	

	function getAllItems($offset,$rows){
		$sql = "select * from account order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}
	function getAllItemsByKeyword($keyword,$offset,$rows){
		$sql = "select * from account where username like '%$keyword%' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function getAllItemsByKeyword2($keyword,$offset,$rows){
		$sql = "select * from account where role = '$keyword' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function updateItem($username,$password){
		$sql = "update account set password=password('$password') where username='$username'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

	function update2($username,$email){
		$sql = "update account set email='$email' where username='$username'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	function update3($username,$numbers,$fee,$alipay){
		$sql = "update account set numbers='$numbers',fee='$fee',alipay='$alipay' where username='$username'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

	function update4($email,$password){
		$sql = "update account set password=password('$password') where email='$email'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	function addItem($username,$password,$name,$role,$tel,$remarks){	

		$sql = "INSERT  INTO account(username,password,name,role,tel,remarks,createTime) Values('$username',password('$password'),'$name','$role','$tel','$remarks',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	

	function addItem2($username,$password,$name,$role,$tel,$sex,$QQ,$email,$alipay,$numbers,$fee,$remarks){	
		$numbers2=0;
		$sql = "INSERT  INTO account(username,password,name,role,tel,sex,QQ,email,alipay,numbers,numbers2,fee,remarks,createTime) Values('$username',password('$password'),'$name','$role','$tel','$sex','$QQ','$email','$alipay','$numbers','$numbers2','$fee','$remarks',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	

	function del($id){
		$sql = "delete from account where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}