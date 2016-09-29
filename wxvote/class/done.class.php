<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class doneClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from done";
    	return $this->getTotalNumber($sql);
	}

	function getCount2($pid){
		$sql = "select count(*) as number from done where pid='$pid' and type='已放弃' ";
		//echo $sql;
		//echo "\n";
    	return $this->getTotalNumber($sql);
	}

	function getCount3($pid){
		$sql = "select count(*) as number from done where pid='$pid' and type='已完成' ";
		//echo $sql;
		//echo "\n";
    	return $this->getTotalNumber($sql);
	}


	function getAll(){
		$sql = "select * from done order by id desc";
		return $this->selectArray($sql);		
	}

	function getAllItems($offset,$rows){
		$sql = "select * from done order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function update($id,$password){
		$sql = "update done set password='$password' where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}

	function update5($openid,$username){
		$sql = "update done set username='$username'  where openid='$openid'";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}	
		
	function add($username,$pid,$title,$type){		
		$sql = "INSERT  INTO done(username,pid,title,type,createTime) Values('$username','$pid','$title','$type',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	function delItemByid($id){
		$sql = "delete from done where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}		

}