<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class problemClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from problem";
    	return $this->getTotalNumber($sql);
	}

	function getAll(){
		$sql = "select * from problem order by id desc";
		return $this->selectArray($sql);		
	}

	function getAll2(){
		$sql = "select pid,count(*) as sum from problem group by pid order by pid desc";
		return $this->selectArray($sql);		
	}


	function getAll3($id){
		$sql = "select * from problem where id='$id' order by id desc";
		return $this->selectArray($sql);		
	}

	function getAll4($status){
		$sql = "select * from problem where status='$status' order by id desc";
		return $this->selectArray($sql);		
	}
	
	function getAll5(){
		$sql = "select * from problem where left(createTime,10)='2016-06-06' order by id desc";
		return $this->selectArray($sql);		
	}

	function getAllItems($offset,$rows){
		$sql = "select * from problem order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function add($pid,$title,$img,$username,$username2,$memo){		
		$sql = "INSERT  INTO problem(pid,title,img,username,username2,memo,createTime) Values('$pid','$title','$img','$username','$username2','$memo',now())";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	


	function update($id,$status){
		$sql = "update problem set status='$status' where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}

	function update2($orderid,$username){
		$sql = "update problem set username='$username' where orderid=$orderid";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}

	function update3($orderid,$username){
		$sql = "update problem set username2='$username' where oid='$orderid' ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}	

	function del($id){
		$sql = "delete from problem where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	

	function del3($orderid){
		$sql = "delete from problem where orderid=$orderid ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}



}