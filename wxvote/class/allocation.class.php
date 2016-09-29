<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class allocationClass extends database_wcc {
	private $test_dataallocation = 'test_dataallocation';
	function __construct ($config=NULL){
		parent::__construct($this->test_dataallocation);
	}

	function getCount(){
		$sql = "select count(*) as number from allocation";
    	return $this->getTotalNumber($sql);
	}
	function getCount2(){
		$sql = "select count(*) as number from allocation where status='未用'";
    	return $this->getTotalNumber($sql);
	}	
	function getCountByKeyword($keyword){
		$sql = "select count(*) as number from allocation where dateval ='$keyword' ";
    	return $this->getTotalNumber($sql);
	}	

	function getCountByallocation($allocation){
		$sql = "select count(*) as number from allocation where allocation = '$allocation' ";
    	return $this->getTotalNumber($sql);
	}	

	function getCountByallocation2($allocation){
		$sql = "select count(*) as number from allocation where allocation = '$allocation' and status='未用'";
    	return $this->getTotalNumber($sql);
	}		

	function getAllItems($offset,$rows){
		$sql = "select * from allocation order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function getAllItemsByKeyword($keyword,$offset,$rows){
		$sql = "select * from allocation where dateval='$keyword' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}	
	function getAll(){
		$sql = "select * from allocation order by id desc";
		return $this->selectArray($sql);
	}
	function getAll2(){
		$sql = "select * from allocation where status='未用' order by id asc";
		return $this->selectArray($sql);
	}		

	function add($user,$dateval,$s1,$s2){		
		$sql = "INSERT  INTO allocation(user,dateval,s1,s2,createTime) Values('$user','$dateval','$s1','$s2',now())";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
	function update($vercode){
		$sql = "update allocation set status='已用' where allocation='$vercode'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

	function del($id){
		$sql = "delete from allocation where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}