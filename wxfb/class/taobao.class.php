<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class taobaoClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from taobao";
    	return $this->getTotalNumber($sql);
	}
	function getCount2($tradeNo){
		$sql = "select count(*) as number from taobao where tradeNo='$tradeNo'";
    	return $this->getTotalNumber($sql);
	}	
	function getAllItems($offset,$rows){
		$sql = "select * from taobao order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}
	function getAll2($tradeNo){
		$sql = "select * from taobao where tradeNo='$tradeNo' order by id desc ";
		return $this->selectArray($sql);		
	}
	function add($tradeNo,$title,$time,$username,$userid,$amount,$status){		

		$sql = "INSERT INTO taobao(tradeNo,title,time,username,userid,amount,status,createTime) Values('$tradeNo','$title','$time','$username','$userid','$amount','$status',now())";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
	function update($tradeNo){		

		$sql = "update taobao set state='已提取' where tradeNo='$tradeNo' ";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

}