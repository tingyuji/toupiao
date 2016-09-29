<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class wxClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from wx";
    	return $this->getTotalNumber($sql);
	}
	function getCount2($transaction_id){
		$sql = "select count(*) as number from wx where transaction_id='$transaction_id'";
    	return $this->getTotalNumber($sql);
	}	
	function add($transaction_id,$trade_state,$total_fee){		
		$sql = "INSERT  INTO wx(transaction_id,trade_state,total_fee,createTime) Values('$transaction_id','$trade_state','$total_fee',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	

}