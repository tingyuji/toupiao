<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class sequenceClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}

	function getCount(){
		$sql = "select count(*) as number from sequence";
    	return $this->getTotalNumber($sql);
	}
	function getCount2($user){
		$sql = "select count(*) as number from sequence where user='$user'";
    	return $this->getTotalNumber($sql);
	}	
	function getCount3(){
		$sql = "select count(*) as number from sequence where status='未用'";
    	return $this->getTotalNumber($sql);
	}	

	function getCount4($user,$dateval){
		$sql = "select count(*) as number from sequence where user='$user' and dateval='$dateval' and status='未用'";

    	return $this->getTotalNumber($sql);
	}	
	function getCount5($orderCode){
		$sql = "select count(*) as number from sequence where orderCode='$orderCode'";
    	return $this->getTotalNumber($sql);
	}	
	function getCount6($user){
		$sql = "select count(*) as number from sequence where user='$user' and status='未用'";
    	return $this->getTotalNumber($sql);
	}		
	function getCountByKeyword($keyword){
		$sql = "select count(*) as number from sequence where orderCode like '%$keyword%' ";
    	return $this->getTotalNumber($sql);
	}	
	function getCountByKeyword2($username,$keyword){
		$sql = "select count(*) as number from sequence where user='$username' and orderCode = '$keyword' ";
    	return $this->getTotalNumber($sql);
	}	
	function getCountByloc2($loc2){
		$sql = "select count(*) as number from sequence where loc2 = '$loc2' ";
    	return $this->getTotalNumber($sql);
	}	

	function getCountBysequence2($sequence){
		$sql = "select count(*) as number from sequence where sequence = '$sequence' and status='未用'";
    	return $this->getTotalNumber($sql);
	}		

	function getAllItems($offset,$rows){
		$sql = "select * from sequence order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}
	function getAllItems2($user,$offset,$rows){
		$sql = "select a.*,b.createTime as soldTime,b.loc1,b.loc2 from sequence a join ticket b on a.orderCode=b.orderCode where a.user='$user' order by a.id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}	


	function getAllItemsByKeyword($keyword,$offset,$rows){
		$sql = "select a.*,b.createTime as soldTime,b.loc1,b.loc2 from sequence a left join ticket b on a.orderCode=b.orderCode where a.orderCode = '$keyword' order by a.id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}	
	function getAllItemsByKeyword2($username,$keyword,$offset,$rows){
		$sql = "select a.*,b.createTime as soldTime,b.loc1,b.loc2 from sequence a join ticket b on a.orderCode=b.orderCode where a.user='$username' and a.orderCode = '$keyword' order by a.id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}		
	function getAllItemsByKeyword3($keyword,$offset,$rows){
		$sql = "select * from sequence where orderCode = '$keyword' order by id desc limit $offset,$rows";
    	//echo $sql;
    	//echo '<br>';
		return $this->selectArray($sql);		
	}			
	function getAllItemsByloc2($loc2){
		$sql = "select * from sequence where loc2 = '$loc2' order by id desc";
    	//echo $sql;
    	//echo '<br>';
		return $this->selectArray($sql);		
	}		
	function getAll(){
		$sql = "select * from sequence order by id desc";
		return $this->selectArray($sql);
	}
	function getAll2(){
		$sql = "select * from sequence where status='未用' order by id asc";
		return $this->selectArray($sql);
	}		
	function getAll3(){
		$sql = "select * from sequence where status='未用' order by id asc";
		return $this->selectArray($sql);
	}

	function getAll4($user,$dateval){
		$sql = "select * from sequence where user='$user' and dateval='$dateval' and status='未用' order by id asc";
		return $this->selectArray($sql);
	}
	function getAll6($user){
		$sql = "select * from sequence where user='$user' and status='未用' order by id asc";
		return $this->selectArray($sql);
	}
	function add($user,$orderCode,$dateval){		
		$sql = "INSERT  INTO sequence(user,orderCode,dateval,status,createTime) Values('$user','$orderCode','$dateval','未用',now())";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
	function update($orderCode){
		$sql = "update sequence set status='已用' where orderCode='$orderCode'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function updateByorderCode($orderCode){
		$sql = "update sequence set status='已用,退票' where orderCode='$orderCode'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function del($id){
		$sql = "delete from sequence where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}