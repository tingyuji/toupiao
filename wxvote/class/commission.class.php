<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class commissionClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from commission";
    	return $this->getTotalNumber($sql);
	}

	function getCount2($username){
		$sql = "select count(*) as number from commission where username='$username' and status='已确认'";
		echo $sql;
		echo "\n";
    	return $this->getTotalNumber($sql);
	}
	function getCount3($username){
		$sql = "select sum(fee) as number from commission where username='$username' and status='已确认'";
		echo $sql;
		echo "\n";
    	return $this->getTotalNumber($sql);
	}

	function getCount4(){
		$sql = "select sum(fee) as number from commission where action='在线充值' and createTime>curdate() ";
    	return $this->getTotalNumber($sql);

	}


	function getCount5($newcode,$time){
		$sql = "select count(*) as number from commission where left(createTime,7)='$time' and action='在线充值' and username in (select username from user where inviteCode='$newcode')";
    	
		echo $sql;
		echo "\n";
    	return $this->getTotalNumber($sql);
	}


	function getCount6($newcode,$time){
		$sql = "select sum(fee) as number from commission where left(createTime,7)='$time' and action='在线充值' and username in (select username from user where inviteCode='$newcode')";
    	
		echo $sql;
		echo "\n";
    	return $this->getTotalNumber($sql);
	}
	
	function getCountByKeyword($Keyword){
		$sql = "select count(*) as number from commission where name like '%$Keyword%'";
		//echo $sql;
		//echo '<br>';
    	return $this->getTotalNumber($sql);
	}	
	function getCountByName($Name,$Password){
		$sql = "select count(*) as number from commission where Name='$Name' and Password='$Password'";
    	//echo $sql;
    	//echo '<br>';
    	return $this->getTotalNumber($sql);
	}
	function getCountByName2($Name){
		$sql = "select count(*) as number from commission where account='$Name'";
    	return $this->getTotalNumber($sql);
	}	
	
	function getAllItemsByName($Name,$Password){
		$sql = "select * from commission where Name='$Name' and Password='$Password' order by id desc";
		return $this->selectArray($sql);
	}
	function getAll(){
		$sql = "select * from commission order by id desc";
		return $this->selectArray($sql);		
	}


	function getAll2(){
		$sql = "select * from commission where status='已确认' and data is NULL order by id desc ";
		return $this->selectArray($sql);		
	}
	function getAll3(){
		$sql = "select * from commission where action='平台收益' and status='已确认' and data is NULL order by id desc ";
		return $this->selectArray($sql);		
	}

	function getAll4(){
		$sql = "select username,sum(fee) as fee from commission where status='已确认' group by username";
		echo $sql;
		echo "\n";
    	return $this->selectArray($sql);	
	}


	function getAll5(){
		$sql = "select * from commission where action='投诉成功扣款' and createTime>CURDATE() order by id desc ";
		return $this->selectArray($sql);		
	}


	function getAll6(){
		$sql = "select username,sum(fee) as fee from commission where action in ('在线充值','人工充值') group by username ";
		return $this->selectArray($sql);		
	}

	function getAll7(){
		$sql = "select username,sum(fee) as fee from commission where status='已确认' and action in ('在线充值','人工充值','发布任务','追加任务','终止任务返现','投诉成功返现','退款') group by username";
		echo $sql;
		echo "\n";
    	return $this->selectArray($sql);	
	}

	function getAll8(){
		$sql = "select * from commission where action='平台收益' and status='已确认' and data is NULL order by id desc limit 30000";
		return $this->selectArray($sql);		
	}


	function getAllItems($offset,$rows){
		$sql = "select * from commission order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}
	function getAllItemsByKeyword($Keyword){
		$sql = "select * from commission where name like '%$Keyword%' order by id desc";
		return $this->selectArray($sql);
	}	
	function getItemByID($ID){
		$sql = "select * from commission where id='$ID' order by id desc";
		return $this->selectArray($sql);
	}							
	function getAllItemsByName2($Name){
		$sql = "select * from commission where Name='$Name' order by id desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);
	}		
	function update($orderNo,$status){
		$sql = "update commission set status='$status' where orderNo='$orderNo'";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

	function update2($id,$status,$data){
		$sql = "update commission set status='$status',data='$data' where id=$id";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}
	function update3(){
		$sql="update commission set status='已确认' where action in ('发布任务','人工充值','在线充值','追加任务','终止任务返现','投诉成功返现','投诉成功扣款')";
    	echo $sql;
    	echo "\n";
		$this->update_sql($sql);
	}
	function update4($orderNo,$fee){
		$sql = "update commission set fee='$fee' where orderNo='$orderNo'";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}


	function update5($orderNo,$username){
		$sql = "update commission set username='$username' where orderNo='$orderNo' and action='投诉成功扣款' ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

	function add($username,$fee,$orderNo,$action,$remarks){		
		$sql = "INSERT  INTO commission(username,fee,orderNo,action,remarks,createTime) Values('$username','$fee','$orderNo','$action','$remarks',now())";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);

	}	

	function add2($username,$fee,$orderNo,$status,$action,$remarks){		
		$sql = "INSERT  INTO commission(username,fee,orderNo,status,action,remarks,createTime) Values('$username','$fee','$orderNo','$status','$action','$remarks',now())";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);


	}	
	function add3($username,$fee,$orderNo,$status,$action,$remarks){		
		$sql = "INSERT  INTO commission(username,fee,orderNo,status,action,remarks,createTime) Values('$username','$fee','$orderNo','$status','$action','$remarks',now())";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);


	}

	function add4($username,$fee,$orderNo,$action,$status,$remarks){		
		$sql = "INSERT  INTO commission(username,fee,orderNo,action,status,remarks,createTime) Values('$username','$fee','$orderNo','$action','$status','$remarks',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

	function add5($username,$fee,$action,$status,$createTime){		
		$sql = "INSERT  INTO commission(username,fee,action,status,createTime) Values('$username','$fee','$action','$status','$createTime')";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}


	function add6($username,$orderNo,$fee,$action,$status){		
		$sql = "INSERT  INTO commission(username,orderNo,fee,action,status,createTime) Values('$username','$orderNo','$fee','$action','$status',now())";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}


	function del($orderid){
		$sql = "delete from commission where orderNo='$orderid' ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

	function del2($time){
		$sql = "delete from commission where time='$time' ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

	function del3($action){
		$sql = "delete from commission where action='$action' ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}


	function del4($orderid){
		$sql = "delete from commission where orderNo=$orderid ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}



}