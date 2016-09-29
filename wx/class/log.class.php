<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class logClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}

	function add($tel){		
		$sql = "INSERT  INTO log(tel,createTime) Values('$tel',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	

}