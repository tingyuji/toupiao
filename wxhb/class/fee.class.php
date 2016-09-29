<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class feeClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from fee";
    	return $this->getTotalNumber($sql);
	}
	function getCount2($username){
		$sql = "select count(*) as number from fee where username='$username'";
    	return $this->getTotalNumber($sql);
	}
	function getCount3($openid){
		$sql = "select count(*) as number from fee where openid='$openid' and status='已确认'";
    	return $this->getTotalNumber($sql);
	}
	function getAll(){
		$sql = "select * from fee where order by id desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}
		
	function getAll2($username){
		$sql = "select username,fee,createTime,DATE_ADD(createTime, INTERVAL 1 DAY)  as time2 from fee where username='$username' order by id desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}
	function getAll3($openid){
		$sql = "select * from fee where openid='$openid' and status='已确认' order by id asc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}
	function update($id){
		$sql = "update fee set status='已支付' where id=$id";
    	///echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

	function update2($id,$billno){
		$sql = "update fee set billno='$billno',status='已支付' where id=$id";
    	///echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

		
	function add($username,$fee,$action){		
		$sql = "INSERT  INTO fee(username,fee,action,createTime) Values('$username','$fee','$action',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	function del($id){
		$sql = "delete from fee where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}		

}