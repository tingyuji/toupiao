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
	
	function getCount2($username){
		$sql = "select count(*) as number from task where username='$username' ";
    	return $this->getTotalNumber($sql);
	}

	function getCount3(){
		$sql = "select count(*) as number from task where createTime>curdate() ";
    	return $this->getTotalNumber($sql);
	}

	function getAll(){
		$sql = "select * from task order by id desc";
		return $this->selectArray($sql);		
	}

	function getAll2($username){
		$sql = "select * from task where username='$username' order by id desc";
		return $this->selectArray($sql);		
	}	

	function getAll3($id){
		$sql = "select * from task where id='$id' order by id desc";
		return $this->selectArray($sql);		
	}	

	function getAll6(){

		//$sql = "select * from task where xiansu=0 and TIMESTAMPDIFF(MINUTE,createTime,now())>1 and status='审核中' order by id asc";
		$sql = "select * from task where xiansu=0 and TIMESTAMPDIFF(SECOND,createTime,now())>30 and status='审核中' order by id asc";

		//$sql = "select * from task where TIMESTAMPDIFF(SECOND,createTime,now())>10 and status='审核中' order by id asc";
		return $this->selectArray($sql);
	}


	function getAll7($status){
		$sql = "select * from task where status='$status' order by id asc";
		return $this->selectArray($sql);		
	}	


	function getAll8(){
		$sql = "select * from task where TIMESTAMPDIFF(MINUTE,refundTime,now())>720 and status in ('用户终止','自动终止') and refundStatus=0 order by id desc";
		return $this->selectArray($sql);		
	}


	function getAll9(){
		$sql = "select * from task where TIMESTAMPDIFF(MINUTE,updateTime,now())<60 and status='已完成' order by id desc";
		return $this->selectArray($sql);		
	}


	function getAll10(){
		$sql = "select * from task where TIMESTAMPDIFF(MINUTE,updateTime,now())<60 and status='执行中' order by id desc";
		return $this->selectArray($sql);		
	}



	function getAll11($status){
		$sql = "select * from task where TIMESTAMPDIFF(MINUTE,updateTime,now())<60 and status='$status' order by id desc";
		return $this->selectArray($sql);		
	}

	function getAll12(){
		$sql = "select * from task where status='已完成' order by id desc";
		return $this->selectArray($sql);		
	}


	function getAll13(){
		$sql = "select * from task where status='执行中' order by id desc";
		return $this->selectArray($sql);		
	}

	function getAll15(){
		$sql = "select * from task where status='执行中' and now() > nextTime order by id desc";
		return $this->selectArray($sql);		
	}

	function getAll16($status){
		$sql = "select * from task where status='$status' and TIMESTAMPDIFF(MINUTE,createTime,now())>10 order by id asc";
		return $this->selectArray($sql);		
	}	

	function getAll18(){

		$sql = "select * from task where xiansu=1 and TIMESTAMPDIFF(MINUTE,createTime,now())>1 and status='审核中' order by id asc";

		//$sql = "select * from task where TIMESTAMPDIFF(SECOND,createTime,now())>10 and status='审核中' order by id asc";
		return $this->selectArray($sql);
	}

	function getAll20(){
		$sql = "select * from task where status='分发中' order by id desc";
		return $this->selectArray($sql);		
	}

	function getAll28(){
		$sql = "select * from task where left(createTime,10)='2016-09-04' and TIMESTAMPDIFF(MINUTE,refundTime,now())>60 and status ='用户终止' and refundStatus=0 order by id desc";
		return $this->selectArray($sql);		
	}


	function getAll36(){
		$sql = "select * from task where TIMESTAMPDIFF(MINUTE,updateTime,now())>2 and status='执行中' order by id desc";
		
		echo $sql;
		echo "\n";
		return $this->selectArray($sql);		
	}

	function getAll38(){
		$sql = "select * from task where left(createTime,10)='2016-09-04' and status='用户终止' and status2=0 order by id desc";
		return $this->selectArray($sql);		
	}	

	function getAll58(){
		$sql = "select id,type,price2,createTime from task where type='综合任务' order by updateTime desc limit 100";
		echo $sql;
		echo "\n";
		return $this->selectArray($sql);		
	}	

	function getAll68($username,$time){
		$sql = "select * from task where username='$username' and left(createTime,10)='$time and status='用户终止' and status2=0 order by id desc";
		return $this->selectArray($sql);		
	}	



	function getAll88(){
		$today=date('Y-m-d');
		$sql = "select * from task where left(createTime,10)='$today' and TIMESTAMPDIFF(MINUTE,refundTime,now())>30 and status ='用户终止' and refundStatus=0 order by id desc";
		echo $sql;
		echo "\n";
		return $this->selectArray($sql);		
	}

	function getAll89(){

		$today=date('Y-m-d');
		$sql = "select * from task where left(createTime,10)='$today' and TIMESTAMPDIFF(MINUTE,refundTime,now())>60 and status='用户终止' and status2=0 order by id desc";
		echo $sql;
		echo "\n";

		return $this->selectArray($sql);		
	}


	function getAllItems($offset,$rows){
		$sql = "select * from task order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}




	function add($type,$username,$wx,$title,$url,$img1,$img2,$price,$num,$onetime,$time1,$time2,$area,$xiansu,$minute){	

		$sql = "INSERT  INTO task(type,username,wx,title,url,img1,img2,price,num,onetime,time1,time2,area,xiansu,minute,createTime) Values('$type','$username','$wx','$title','$url','$img1','$img2','$price','$num','$onetime','$time1','$time2','$area','$xiansu','$minute',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update($id,$sum){
		$sql = "update task set complete='$sum' where id=$id ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

	function update2($id,$sum){
		$sql = "update task set stop='$sum' where id=$id ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

	function update3($id,$status){
		$sql = "update task set status='$status' where id=$id ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

	function update4($id,$code){
		$sql = "update task set code='$code' where id=$id ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}


	function update5($id,$times){
		$sql = "update task set times='$times' where id=$id ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

	function update7($id){
		$sql = "update task set refundStatus=1 where id=$id ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}


	function update8($id,$sum){
		$sql = "update task set done='$sum' where id=$id ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

	function update9($id){
		$sql = "update task set status='自动终止',refundTime=now() where id=$id ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}


	function update18($id){
		$sql = "update task set xiansu='0'  where id=$id ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

	function update28($id,$sum){
		$sql = "update task set num2='$sum' where id=$id ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}
	function update38($id){
		$sql = "update task set status2=1 where id=$id ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}
	function del($id){
		$sql = "delete from task where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}
