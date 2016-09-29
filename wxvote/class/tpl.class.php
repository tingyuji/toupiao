<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class tplClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from tpl";
    	return $this->getTotalNumber($sql);
	}

	function getAll(){
		$sql = "select * from tpl order by id desc";
		return $this->selectArray($sql);		
	}

	function getAllItems($offset,$rows){
		$sql = "select * from tpl order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function update($id,$password){
		$sql = "update tpl set password='$password' where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
	function add($type,$note){		
		$sql = "INSERT  INTO tpl(type,note,createTime) Values('$type','$note',now())";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
	function del($id){
		$sql = "delete from tpl where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}		

}