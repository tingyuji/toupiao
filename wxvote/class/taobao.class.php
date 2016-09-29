<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class taobaoClass extends database_wcc {
	private $test_datasource = 'taobao_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
		//echo 'hello';
		//echo '<br>';
	}
	function getCount(){
		$sql = "select count(*) as number from taobao";
    	return $this->getTotalNumber($sql);
	}
	function getAllItems($offset,$rows){
		$sql = "select * from taobao order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function add($tradeNo,$desc,$time,$username,$userid,$amount,$status){		

		$sql = "INSERT INTO taobao(tradeNo,desc,time,username,userid,amount,status,createTime) Values('$tradeNo','$desc','$time','$username','$userid','$amount','$status',now())";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	


}