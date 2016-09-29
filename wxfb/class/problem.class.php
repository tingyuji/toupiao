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
	function getCount2($username){
		$sql = "select count(*) as number from problem where username1='$username' ";
    	return $this->getTotalNumber($sql);
	}
	function getCount3($orderid){
		$sql = "select count(*) as number from problem where oid='$orderid' ";
    	return $this->getTotalNumber($sql);
	}	
	function getAll(){
		$sql = "select * from problem order by id desc";
		return $this->selectArray($sql);		
	}
	function getAll2($username){
		$sql = "select * from problem where username1='$username' order by id desc";
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
	function add2($pid,$oid,$title,$imgfile,$source,$memo,$zdy,$username1,$username2){		
		$sql = "INSERT  INTO problem(pid,oid,title,imgfile,source,memo,zdy,username1,username2,createTime) Values('$pid','$oid','$title','$imgfile','$source','$memo','$zdy','$username1','$username2',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	


	function add3($pid,$oid,$title,$imgfile,$source,$memo,$zdy,$username1,$username2,$openid){		
		$sql = "INSERT  INTO problem(pid,oid,title,imgfile,source,memo,zdy,username1,username2,openid,createTime) Values('$pid','$oid','$title','$imgfile','$source','$memo','$zdy','$username1','$username2','$openid',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	


	function update($id,$password){
		$sql = "update problem set password='$password' where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}

	function del($id){
		$sql = "delete from problem where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}		

}