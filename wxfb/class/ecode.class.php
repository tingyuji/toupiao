<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class ecodeClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}

	function getCount(){
		$sql = "select count(*) as number from ecode";
    	return $this->getTotalNumber($sql);
	}
	function getCount2(){
		$sql = "select count(*) as number from ecode where status='未用'";
    	return $this->getTotalNumber($sql);
	}	


	function getCount3($ecode){
		$sql = "select count(*) as number from ecode where ecode = '$ecode' ";
    	return $this->getTotalNumber($sql);
	}	

	function getCount4($ecode){
		$sql = "select count(*) as number from ecode where ecode = '$ecode' ";
    	return $this->getTotalNumber($sql);
	}		

	function getAllItems($offset,$rows){
		$sql = "select * from ecode order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function getAllItemsByKeyword($keyword,$offset,$rows){
		$sql = "select * from ecode where ecode like '%$keyword%' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}	
	function getAll(){
		$sql = "select * from ecode order by id desc";
		return $this->selectArray($sql);
	}
	function getAll2(){
		$sql = "select * from ecode where status='未用' order by id asc";
		return $this->selectArray($sql);
	}		

	function add($fileid,$ecode){		
		$sql = "INSERT  INTO ecode(fileid,ecode,status,createTime) Values('$fileid','$ecode','未用',now())";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
	function add2($ecode){		
		$sql = "INSERT  INTO ecode(ecode,status,createTime) Values('$ecode','未用',now())";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}			
	function update($vercode){
		$sql = "update ecode set status='已用' where ecode='$vercode'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update2($newcode){
		$sql = "update ecode set status='已分配' where ecode='$newcode'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function del($id){
		$sql = "delete from ecode where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}