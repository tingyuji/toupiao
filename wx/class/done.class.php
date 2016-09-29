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
	function add($username,$pid,$title,$type){		
		$sql = "INSERT  INTO done(username,pid,title,type,createTime) Values('$username','$pid','$title','$type',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	

	function add2($openid,$pid,$title,$type){		
		$sql = "INSERT  INTO done(openid,pid,title,type,createTime) Values('$openid','$pid','$title','$type',now())";
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