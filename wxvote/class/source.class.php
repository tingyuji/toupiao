<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class sourceClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}

	function getCount(){
		$sql = "select count(*) as number from source";
    	return $this->getTotalNumber($sql);
	}

	function getCountByKeyword($keyword){
		$sql = "select count(*) as number from source where dateval ='$keyword' ";
    	return $this->getTotalNumber($sql);
	}	

		

	function getAllItems($offset,$rows){
		$sql = "select * from source order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function getAllItemsByKeyword($keyword,$offset,$rows){
		$sql = "select * from source where dateval ='$keyword' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}	
	function getAll(){
		$sql = "select * from source order by id desc";
		return $this->selectArray($sql);
	}

	function add($dateval,$s1,$s2){		
		$sql = "INSERT  INTO source(dateval,s1,s2,createTime) Values('$dateval','$s1','$s2',now())";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
	function update($vercode){
		$sql = "update source set status='已用' where source='$vercode'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

	function del($id){
		$sql = "delete from source where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}