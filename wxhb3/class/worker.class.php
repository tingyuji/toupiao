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

	function getCount3($random){
		$sql = "select count(*) as number from worker where random='$random' ";
    	return $this->getTotalNumber($sql);
	}
	function getCount4($newcode){
		$sql = "select count(*) as number from worker where newcode='$newcode' ";
    	return $this->getTotalNumber($sql);
	}

	function getCount5($username){
		$sql = "select count(*) as number from worker where username='$username' ";
    	return $this->getTotalNumber($sql);
	}		

	function getCount6($newcode){
		$sql = "select count(*) as number from worker where id='$newcode' ";
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
	function getAll4($newcode){
		$sql = "select * from worker where newcode='$newcode'  order by id desc";
		return $this->selectArray($sql);		
	}	

	function getAll5($newcode){
		$sql = "select * from worker where id='$newcode'  order by id desc";
		return $this->selectArray($sql);		
	}				
	function getAllItems($offset,$rows){
		$sql = "select * from worker order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}




	function add($username,$password,$name,$email,$tel,$QQ,$newcode){	

		$sql = "INSERT  INTO worker(username,password,name,email,tel,QQ,newcode,createTime) Values('$username','$password','$name','$email','$tel','$QQ','$newcode',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update($username,$password){
		$sql = "update worker set password='$password' where username='$username'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update2($username,$random){
		$sql = "update worker set random='$random' where username='$username'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update3($random,$password){
		$sql = "update worker set password='$password' where random='$random'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update4($random,$email){
		$sql = "update worker set email='$email' where random='$random'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update5($newcode){
		$sql = "update worker set fee=fee+0.01 where id=$newcode ";
    	//echo $sql;
        //echo '<br>';
    	$this->update_sql($sql);
	}


	function del($id){
		$sql = "delete from worker where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}