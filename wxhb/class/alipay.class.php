<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class alipayClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from alipay";
    	return $this->getTotalNumber($sql);
	}
	function getCount2($username){
		$sql = "select count(*) as number from alipay where username = '$username' and fee>0";
		//echo $sql;
		//echo '<br>';
    	return $this->getTotalNumber($sql);
	}	
	function getCount3($username){
		$sql = "select sum(fee) as number from alipay where username = '$username'";
		//echo $sql;
		//echo '<br>';
    	return $this->getTotalNumber($sql);
	}
	function getAll(){
		$sql = "select * from alipay order by id desc";
		return $this->selectArray($sql);		
	}
	function getAll2($username){
		$sql = "select * from alipay where username='$username' and fee>0 order by id desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}
	function getAll4(){
		$sql = "select username,sum(fee) as sum from alipay group by username ";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}
	function update($id,$password){
		$sql = "update alipay set password='$password' where id=$id";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function add($username,$fee,$orderNo,$action,$remarks){		
		$sql = "INSERT  INTO alipay(username,fee,orderNo,action,remarks,createTime) Values('$username','$fee','$orderNo','$action','$remarks',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	function add2($username,$fee,$action){		
		$sql = "INSERT  INTO alipay(username,fee,action,createTime) Values('$username','$fee','$action',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	function del($id){
		$sql = "delete from alipay where id=$id";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}