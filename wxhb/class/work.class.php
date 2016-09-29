<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class workClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from work";
    	return $this->getTotalNumber($sql);
	}
	
	function getCount2($workname,$password){
		$sql = "select count(*) as number from work where workname='$workname' and password='$password' ";
    	return $this->getTotalNumber($sql);
	}


	function getAll(){
		$sql = "select * from work order by id desc";
		return $this->selectArray($sql);		
	}

	function getAll2($workname,$password){
		$sql = "select * from work where workname='$workname' and password='$password' order by id desc";
		return $this->selectArray($sql);		
	}	
	function getAllItems($offset,$rows){
		$sql = "select * from work order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}




	function add($username,$orderid,$pid,$title){	

		$sql = "INSERT  INTO work(username,orderid,pid,title,createTime) Values('$username','$orderid','$pid','$title',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update($workname,$password){
		$sql = "update work set password=password('$password') where workname='$workname'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

	function update2($openid,$name,$female,$addr,$birthday){
		$sql = "update work set name='$name',female='$female',addr='$addr',birthday='$birthday' where openid='$openid'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update3($openid,$password){
		$sql = "update work set password=password('$password') where openid='$openid'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

	function del($id){
		$sql = "delete from work where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}