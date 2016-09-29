<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class timeClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from time";
    	return $this->getTotalNumber($sql);
	}

	function getAll(){
		$sql = "select * from time order by id desc";
		return $this->selectArray($sql);		
	}

	function getAllItems($offset,$rows){
		$sql = "select * from time order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function update($id,$password){
		$sql = "update time set password='$password' where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
	function add($username,$pid,$title=''){		
		$sql = "INSERT  INTO time(username,pid,title,createTime) Values('$username','$pid','$title',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	function delItemByid($id){
		$sql = "delete from time where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}		

}