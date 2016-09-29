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


	function getCount4($username){
		$sql = "select sum(fee) as number from alipay where username='$username' and action in ('人工充值','在线充值','发布任务','追加任务','终止任务返现','投诉成功返现','退款')  ";
		//echo $sql;
		//echo '<br>';
		return $this->getFloat($sql);		
	}


	function getCount5($username){
		$sql = "select sum(fee) as number from alipay where username='$username' and action in ('人工充值','在线充值') group by username ";
		//echo $sql;
		//echo '<br>';
		return $this->getFloat($sql);		
	}	

	function getCount6($username){
		$sql = "select sum(fee) as number from alipay where username='$username' and action = '在线充值'";
		//echo $sql;
		//echo '<br>';
		return $this->getFloat($sql);		
	}

	function getCount7($username){
		$sql = "select sum(fee) as number from alipay where username='$username' and fee<0 ";
		//echo $sql;
		//echo '<br>';
		return $this->getFloat($sql);		
	}

	function getCount8($username){
		$sql = "select sum(fee) as number from alipay where username='$username' ";
		//echo $sql;
		//echo '<br>';
		return $this->getFloat($sql);		
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

	function getAll3($username){
		$sql = "select * from alipay where username='$username' and fee<0 order by id desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}


	function getAll4(){
		$sql = "select username,sum(fee) as sum from alipay where action in ('人工充值','在线充值','发布任务','追加任务','终止任务返现','投诉成功返现','退款') group by username ";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}

	function getAll5(){
		$sql = "select username,sum(fee) as sum from alipay where action in ('人工充值','在线充值') group by username ";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}	
	function update($id,$password){
		$sql = "update alipay set password='$password' where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}

	function update2(){
		$sql="update alipay set status='已确认' where action in ('发布任务','在线充值','追加任务','终止任务返现')";
    	echo $sql;
    	echo "\n";
		$this->update_sql($sql);
	}
	function add($username,$fee,$orderNo,$action,$remarks){		
		$sql = "INSERT  INTO alipay(username,fee,orderNo,action,status,remarks,createTime) Values('$username','$fee','$orderNo','$action','已确认','$remarks',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);

	}	
	function delItemByid($id){
		$sql = "delete from alipay where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}		

}