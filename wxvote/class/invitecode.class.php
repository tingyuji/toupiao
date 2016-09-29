<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class invitecodeClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}

	function getCount(){
		$sql = "select count(*) as number from invitecode";
    	return $this->getTotalNumber($sql);
	}
	function getCount2(){
		$sql = "select count(*) as number from invitecode where status='未用'";
    	return $this->getTotalNumber($sql);
	}	
	function getCountByKeyword($keyword){
		$sql = "select count(*) as number from invitecode where invitecode like '%$keyword%' ";
    	return $this->getTotalNumber($sql);
	}	

	function getCountByinvitecode($invitecode){
		$sql = "select count(*) as number from invitecode where invitecode = '$invitecode' ";
    	return $this->getTotalNumber($sql);
	}	

	function getCountByinvitecode2($invitecode){
		$sql = "select count(*) as number from invitecode where invitecode = '$invitecode' and status='未用'";
    	return $this->getTotalNumber($sql);
	}		

	function getAllItems($offset,$rows){
		$sql = "select * from invitecode order by id asc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function getAllItemsByKeyword($keyword,$offset,$rows){
		$sql = "select * from invitecode where invitecode like '%$keyword%' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}	
	function getAll(){
		$sql = "select * from invitecode order by id desc";
		return $this->selectArray($sql);
	}
	function getAll2(){
		$sql = "select * from invitecode where status='未用' order by id asc";
		return $this->selectArray($sql);
	}		

	function add($fileid,$invitecode){		
		$sql = "INSERT  INTO invitecode(fileid,invitecode,status,createTime) Values('$fileid','$invitecode','未用',now())";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
	function add2($code){		
		$sql = "INSERT  INTO invitecode(code,status,createTime) Values('$code','未用',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}			
	function update($vercode){
		$sql = "update invitecode set status='已用' where invitecode='$vercode'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update2($code,$status){
		$sql = "update invitecode set status='$status' where code='$code'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function del($id){
		$sql = "delete from invitecode where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}