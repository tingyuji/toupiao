<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class hyxxClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from hyxx";
    	return $this->getTotalNumber($sql);
	}

	function getByTel($tel){
		$sql = "select count(*) as number from hyxx where yddh='$tel'";
    	return $this->getTotalNumber($sql);
	}

	function getAllItems($offset,$rows){
		$sql = "select * from hyxx order by id asc limit $offset,$rows";
		return $this->selectArray($sql);		
	}
	function getAllByTel($tel){
		$sql = "select * from hyxx where yddh='$tel' order by id desc";
		return $this->selectArray($sql);		
	}	
	
}