<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class efileClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from efile";
    	return $this->getTotalNumber($sql);
	}
	function getCountByKeyword($keyword){
		$sql = "select count(*) as number from efile where filename like '%$keyword%' ";
    	return $this->getTotalNumber($sql);
	}	
	function getAllItems($offset,$rows){
		$sql = "select * from efile order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function getAllItemsByKeyword($keyword,$offset,$rows){
		$sql = "select * from efile where filename like '%$keyword%' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}	
	function getAll(){
		$sql = "select * from efile order by id desc";
		return $this->selectArray($sql);
	}	

	function add($username,$efilename,$efilename2){		
		$sql = "INSERT  INTO efile(username,filename,filename2,status,createTime) Values('$username','$efilename','$efilename2','未导入',now())";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
	function update($id,$status){
		$sql = "update efile set status='$status' where id='$id'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}

	function del($id){
		$sql = "delete from efile where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}