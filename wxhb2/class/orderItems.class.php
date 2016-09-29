<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class orderItemsClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from orderItems";
    	return $this->getTotalNumber($sql);
	}

	function add($orderid,$name,$price){		
		$sql = "INSERT  INTO orderItems(orderid,name,price,createTime) Values('$orderid','$name','$price',now())";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
	function update(){
		$sql = "update orderItems set status='1' where status='0'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}

	function update4($id,$income){
		$sql = "update orderItems set total=total+1,income='$income' where id='$id'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}				
	function del($id){
		$sql = "delete from orderItems where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}