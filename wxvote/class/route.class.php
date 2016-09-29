<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class routeClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}

	function getCount(){
		$sql = "select count(*) as number from route";
    	return $this->getTotalNumber($sql);
	}
	function getCount2(){
		$sql = "select count(*) as number from route where status='未用'";
    	return $this->getTotalNumber($sql);
	}	
	function getCountByKeyword($loc2){
		$sql = "select count(*) as number from route where loc2 ='$loc2'";
    	return $this->getTotalNumber($sql);
	}	
	function getCountById($id){
		$sql = "select count(*) as number from route where id ='$id' ";
    	return $this->getTotalNumber($sql);
	}	
	function getCountByroute($route){
		$sql = "select count(*) as number from route where route = '$route' ";
    	return $this->getTotalNumber($sql);
	}	

	function getCountByroute2($route){
		$sql = "select count(*) as number from route where route = '$route' and status='未用'";
    	return $this->getTotalNumber($sql);
	}		

	function getAllItems($offset,$rows){
		$sql = "select * from route order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function getAllItemsByKeyword($loc2,$offset,$rows){
		$sql = "select * from route where loc2='$loc2' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}	

	function getAll(){
		$sql = "select * from route order by id desc";
		return $this->selectArray($sql);
	}
	function getAll2(){
		$sql = "select * from route where status='未用' order by id asc";
		return $this->selectArray($sql);
	}	
	function getAllByLoc2($loc2){
		$sql = "select * from route where loc2='$loc2' order by id desc";
		return $this->selectArray($sql);		
	}	
	function getAllByRoute($loc2){
		$sql = "select * from route where loc2='$loc2' or route like '%$loc2%' order by id desc";
		return $this->selectArray($sql);		
	}				
	function getAllById($id){
		$sql = "select * from route where id = '$id' order by id desc";
		return $this->selectArray($sql);		
	}	
	function add($code,$model,$loc1,$loc2,$time,$no,$route,$status){		
		$sql = "INSERT  INTO route(code,model,loc1,loc2,time,no,route,status,createTime) Values('$code','$model','$loc1','$loc2','$time','$no','$route','流水',now())";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
	function update($id,$code,$model,$loc2,$time,$no,$route,$status){
		$sql = "update route set code='$code',model='$model',loc2='$loc2',time='$time',no='$no',route='$route',status='$status' where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

	function del($id){
		$sql = "delete from route where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}