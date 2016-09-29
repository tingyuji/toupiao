<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class ranklistClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from ranklist";
    	return $this->getTotalNumber($sql);
	}

	function getAll(){
		$sql = "select * from ranklist order by id desc";
		return $this->selectArray($sql);
	}	
	
	function add($num,$value){		
		$sql = "INSERT  INTO ranklist(num,value,createTime) Values('$num','$value',now())";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}	
	function update(){
		$sql = "update ranklist set status='1' where status='0'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
			
	function del($id){
		$sql = "delete from ranklist where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}