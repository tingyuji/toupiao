<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class messageClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from message";
    	return $this->getTotalNumber($sql);
	}

	
	function getAll(){
		$sql = "select * from message order by id desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}



	function update($id,$password){
		$sql = "update message set password='$password' where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
	function add($openid,$username,$pid,$title,$message){		
		$sql = "INSERT  INTO message(openid,username,pid,title,message,createTime) Values('$openid','$username','$pid','$title','$message',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	function del($id){
		$sql = "delete from message where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}		

}