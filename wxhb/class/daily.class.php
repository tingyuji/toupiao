<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class dailyClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from daily";
    	return $this->getTotalNumber($sql);
	}

	function getAll(){
		$sql = "select * from daily where fee>1 and status is NULL order by id desc ";
		return $this->selectArray($sql);
	}	

	function getAll2(){
		$sql = "select * from daily where fee>1 and status is NULL and orderDate='2016-07-07' order by id asc limit 500 ";
		return $this->selectArray($sql);
	}		

	function add($orderid,$orderDate,$orderTime,$fee){
		$sql = "INSERT  INTO daily(orderid,orderDate,orderTime,fee,createTime) Values('$orderid','$orderDate','$orderTime','$fee',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	function update($id){
			$sql = "update daily set status='已支付' where id=$id ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

	function del($id){
		$sql = "delete from daily where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}
