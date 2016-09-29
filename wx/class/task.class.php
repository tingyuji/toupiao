<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class taskClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from task";
    	return $this->getTotalNumber($sql);
	}
	
	function getCount2($id){
		$sql = "select count(*) as number from task where id='$id' ";
    	return $this->getTotalNumber($sql);
	}
	function getCount3($wxusername){
		$sql = "select count(*) as number from task where now()>time1 and now()>nextTime and status in ('执行中') and id not in (
				select pid from done where username='$wxusername'
			) ";
		//echo $sql;
		//echo '<br>';
		return $this->getTotalNumber($sql);	
	}


	function getCount4($openid){
		$sql = "select count(*) as number from task where now()>time1 and now()>nextTime and status in ('执行中') and id not in (
				select pid from done where openid='$openid'
			) ";
		//echo $sql;
		//echo '<br>';
		return $this->getTotalNumber($sql);	
	}

	function getAll(){
		$sql = "select * from task order by id desc";
		return $this->selectArray($sql);		
	}

	function getAll2($id){
		$sql = "select * from task where id='$id' order by id desc";
		return $this->selectArray($sql);		
	}

	function getAll3(){
		$sql = "select * from task where now()>time1 order by id desc";
		return $this->selectArray($sql);		
	}	
	function getAll4(){
		$sql = "select * from task where now()>time1 and status in ('执行中','执行成功') order by id desc";
		return $this->selectArray($sql);		
	}

	function getAll5($username){
		$sql = "select * from task where now()>time1 and status in ('执行中','执行成功') and id not in (
				select pid from done where username='$username'
			) order by id desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}


	function getAll6($wxusername){
		$sql = "select * from task where now()>time1 and now()>nextTime and status in ('执行中') and id not in (
				select pid from done where username='$wxusername'
			) order by sortCode desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}


	function getAll7($status){
		$sql = "select * from task where status='$status' order by id desc";
		return $this->selectArray($sql);		
	}	


	function getAll8($openid){
		$sql = "select * from task where now()>time1 and now()>nextTime and status in ('执行中') and id not in (
				select pid from done where openid='$openid'
			) order by sortCode desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}

	function getAllItems($offset,$rows){
		$sql = "select * from task order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}




	function add($username,$wx,$title,$url,$img1,$img2,$price,$num,$onetime,$endtime){	

		$sql = "INSERT  INTO task(username,wx,title,url,img1,img2,price,num,onetime,endtime,createTime) Values('$username','$wx','$title','$url','$img1','$img2','$price','$num','$onetime','$endtime',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update($pid,$orderid){
		$sql = "update task set status='过期任务' where id='$pid' ";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

	function update2($id,$times){
		$sql = "update task set times='$times' where id='$id'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
	function update3($openid,$password){
		$sql = "update task set password=password('$password') where openid='$openid'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

	function update4($id,$times){
		$sql = "update task set nextTime=DATE_ADD(now(),INTERVAL ".$times." SECOND) where id='$id'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}

	function del($id){
		$sql = "delete from task where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}