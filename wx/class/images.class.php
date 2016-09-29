<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class imagesClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from images";
    	return $this->getTotalNumber($sql);
	}

	function getCount2(){
		$sql = "select sum(images) as number from images where createTime>curdate() ";
    	return $this->getTotalNumber($sql);
	}
	
	function getAllItems($offset,$rows){
		$sql = "select * from images order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}	
	function getAll(){
		$sql = "select * from images order by id desc";
		return $this->selectArray($sql);		
	}

	function getAll2(){
		$sql = "select * from images where TIMESTAMPDIFF(MINUTE,createTime,now())>1 and status='已确认' order by id asc";
		return $this->selectArray($sql);		
	}


	function getAll3(){
		$sql = "select * from images where TIMESTAMPDIFF(DAY,createTime,now())>1 order by id desc limit 50000";
		return $this->selectArray($sql);
	}	
		

	function getAll4(){
		$sql = "select * from images where Qiniu=0 order by id desc limit 100";
		return $this->selectArray($sql);		
	}
	
	function getAll5($pid){
		$sql = "select * from images where pid='$pid' and Qiniu=0 order by id desc limit 100";
		return $this->selectArray($sql);		
	}
	
	function getAll18(){
		$sql="select * from images where Qiniu=0 order by id asc limit 100";
		return $this->selectArray($sql);
	
	}


	function update($id,$status){
		$sql = "update images set status='$status' where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}


	function update2($id){
		$sql = "update images set Qiniu=1 where id=$id";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}
	
	function add($username,$pid,$orderid,$img,$imgUrl){		
		$sql = "INSERT  INTO images(username,pid,orderid,img,imgUrl,createTime) Values('$username','$pid','$orderid','$img','$imgUrl',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	

	function add2($openid,$pid,$orderid,$img,$imgUrl){		
		$sql = "INSERT  INTO images(openid,pid,orderid,img,imgUrl,createTime) Values('$openid','$pid','$orderid','$img','$imgUrl',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		
	function del($id){
		$sql = "delete from images where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	

	function del2($time){
		$sql = "delete from images where time='$time' ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}



}
