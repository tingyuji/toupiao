<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class xiaoClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}


	function getAll(){
		$sql = "select * from xiao order by id desc";
		return $this->selectArray($sql);		
	}

		
	function update($id,$status){
		$sql = "update xiao set status='$status' where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}


	function add($username,$pid,$orderid,$img,$imgUrl){		
		$sql = "INSERT  INTO xiao(username,pid,orderid,img,imgUrl,createTime) Values('$username','$pid','$orderid','$img','$imgUrl',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	



}