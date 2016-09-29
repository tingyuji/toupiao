<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class appendClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from append";
    	return $this->getTotalNumber($sql);
	}

	function getAll(){
		$sql = "select * from append order by append asc";
		return $this->selectArray($sql);		
	}

	function getAllItems($offset,$rows){
		$sql = "select * from append order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function update2($pid){
		$sql = "insert ignore into done select * from donedelta where pid= $pid ";
    	//echo $sql;
    	//echo '<br>';
		$this->update_sql($sql);
		
		$sql = "insert ignore into orders select * from ordersdelta where pid= $pid ";
    	//echo $sql;
    	//echo '<br>';    	
    	$this->update_sql($sql);
	}


	function update($id,$password){
		$sql = "update append set password='$password' where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
	function add($username,$pid,$title,$num,$time2){		
		$sql = "INSERT  INTO append(username,pid,title,num,time2,createTime) Values('$username','$pid','$title','$num','$time2',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	function del($id){
		$sql = "delete from append where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}		

}