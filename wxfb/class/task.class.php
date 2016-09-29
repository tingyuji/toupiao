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
		$sql = "select count(*) as number from task where username='$username' and status !='用户终止' and createTime>'2016-08-25'";
    	return $this->getTotalNumber($sql);
	}



	function getCount3($id){
		$sql = "select count(*) as number from task where id='$id' ";
    	return $this->getTotalNumber($sql);
	}

	function getCount4(){
		$sql = "select count(*) as number from task where status='执行中' and top=1 ";
    	return $this->getTotalNumber($sql);
	}

	function getCount5($username,$title){
		$sql = "select count(*) as number from task where username='$username' and title like '%$title%'";
    	return $this->getTotalNumber($sql);
	}


	function getCount6(){
		$sql = "select count(*) as number from task where status='执行中'  ";
    	return $this->getTotalNumber($sql);
	}

	function getCount8($username){
		$sql = "select count(*) as number from task where username='$username' and status='用户终止'";
    	return $this->getTotalNumber($sql);
	}	

	function getAll(){
		$sql = "select * from task order by id desc";
		return $this->selectArray($sql);		
	}

	function getAll2($username){
		$sql = "select * from task where username='$username' and status !='用户终止' and createTime>'2016-08-25' order by id desc";
		return $this->selectArray($sql);		
	}	
	function getAll3($id){
		$sql = "select * from task where id='$id' order by id desc";
		return $this->selectArray($sql);		
	}		


	function getAll4(){
		$sql = "select * from task where Qiniu=0 order by id desc";
		return $this->selectArray($sql);		
	}


	function getAll7($status){
		$sql = "select * from task where status='$status' order by id desc";
		return $this->selectArray($sql);		
	}	



	function getAll8(){
		$sql = "select * from task where logo=0 order by id desc";
		return $this->selectArray($sql);		
	}


	function getAll9($username,$title){
		$sql = "select * from task where username='$username' and title like '%$title%' order by id desc";
		return $this->selectArray($sql);		
	}	

	function getAll18($username){
		$sql = "select * from task where username='$username' order by id desc";
		return $this->selectArray($sql);		
	}	
	function getAll38($username){
		$sql = "select * from task where username='$username' and status='用户终止' order by id desc";
		return $this->selectArray($sql);		
	}	
	function getAll68(){
		$sql = "select * from task order by id desc limit 500";
		return $this->selectArray($sql);		
	}

	function getAllItems($offset,$rows){
		$sql = "select * from task order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}


	function copy($pid,$num){	
		
		$sql = "INSERT  INTO task(type,username,title,url,img1,img2,price,price2,num,orgNum,status,createTime,nextTime) select type,username,title,url,img1,img2,price,price2,'$num','$num','审核中',now(),now() from task where id='$pid' ";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

	function add($type,$username,$wx,$title,$url,$img1,$img2,$price,$price2,$num,$onetime,$time1,$time2,$area,$xiansu,$minute,$intro,$memo){	
		//$title=mysql_real_escape_string($title);
		//$intro=mysql_real_escape_string($intro);
		//$memo=mysql_real_escape_string($memo);

		
		$title=str_replace('关', '浂', $title);
		$intro=str_replace('关', '浂', $intro);

		$title=str_replace('投', '扌 殳', $title);
		//$title=str_replace('票', '*', $title);

		$intro=str_replace('投', '扌 殳', $intro);
		//$intro=str_replace('票', '*', $intro);
		
		
		

		
		if($xiansu==1){
			$times=300/$minute;
			if($times<10){
				$times=10;
			}
		}
		if($xiansu==0){
			$times=0;
		}		
		$sql = "INSERT  INTO task(type,username,wx,title,url,img1,img2,price,price2,num,orgNum,onetime,time1,time2,area,xiansu,minute,intro,memo,times,status,createTime,nextTime) Values('$type','$username','$wx','$title','$url','$img1','$img2','$price','$price2','$num','$onetime','$time1','$time2','$area','$xiansu','$minute','$intro','$memo','$times','审核中',now(),now())";
		$sql = "INSERT  INTO task(type,username,wx,title,url,img1,img2,price,price2,num,orgNum,onetime,time1,time2,area,xiansu,minute,intro,memo,times,status,createTime,nextTime) Values('$type','$username','$wx','$title','$url','$img1','$img2','$price','$price2','$num','$num','$onetime','$time1','$time2','$area','$xiansu','$minute','$intro','$memo','$times','审核中',now(),now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

	function add2($type,$username,$wx,$title,$url,$img1,$img2,$price,$price2,$num,$onetime,$time1,$time2,$area,$xiansu,$minute,$intro,$memo,$tip){	
		//$title=mysql_real_escape_string($title);
		//$intro=mysql_real_escape_string($intro);
		//$memo=mysql_real_escape_string($memo);

		
		$title=str_replace('关', '浂', $title);
		$intro=str_replace('关', '浂', $intro);

		$title=str_replace('投', '扌 殳', $title);
		//$title=str_replace('票', '*', $title);

		$intro=str_replace('投', '扌 殳', $intro);
		//$intro=str_replace('票', '*', $intro);
		
		
		

		
		if($xiansu==1){
			$times=300/$minute;
			if($times<10){
				$times=10;
			}
		}
		if($xiansu==0){
			$times=0;
		}		
		$sql = "INSERT  INTO task(type,username,wx,title,url,img1,img2,price,price2,num,orgNum,onetime,time1,time2,area,xiansu,minute,intro,memo,times,status,createTime,nextTime,tip) Values('$type','$username','$wx','$title','$url','$img1','$img2','$price','$price2','$num','$num','$onetime','$time1','$time2','$area','$xiansu','$minute','$intro','$memo','$times','审核中',now(),now(),$tip)";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}


	function add5($type,$username,$title,$url,$num,$img1,$img2,$price1,$price2,$memo){	


		$title=str_replace('关', '浂', $title);

		$title=str_replace('投', '扌 殳', $title);

		$sql = "INSERT  INTO task(type,username,title,url,num,orgNum,img1,img2,price,price2,memo,status,createTime,nextTime) Values('$type','$username','$title','$url','$num','$num','$img1','$img2','$price1','$price2','$memo','审核中',now(),now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

	function add6($type,$username,$title,$url,$num,$img1,$img2,$price1,$price2,$memo,$content){	


		$title=str_replace('关', '浂', $title);

		$title=str_replace('投', '扌 殳', $title);

		$sql = "INSERT  INTO task(type,username,title,url,num,orgNum,img1,img2,price,price2,memo,content,status,createTime,nextTime) Values('$type','$username','$title','$url','$num','$num','$img1','$img2','$price1','$price2','$memo','$content','审核中',now(),now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}


	function update($id,$title,$num,$time2){
		$sql = "update task set num=num+'$num',time2='$time2' where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

	function update2($id){
		$sql = "update task set status='用户终止',refundStatus=0,refundTime=now() where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	

		
	function update3($id,$title,$num,$time2,$status){
		$sql = "update task set num=num+'$num',time2='$time2',status='$status' where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	function update4($id,$xiansu,$minute){

		if($xiansu==1){
			$times=300/$minute;
		}
		if($xiansu==0){
			$times=1;
		}	
		$sql = "update task set xiansu='$xiansu',minute='$minute',times='$times' where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	

	function update5($id,$status){
		$sql = "update task set status='$status' where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	


	function update6($id){
		$sql = "update task set Qiniu=1 where id=$id ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

	function update7($id){
		$sql = "update task set logo=1 where id=$id ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}



	function update8($id,$sortCode){
		$sql = "update task set top=1,sortCode=$sortCode where id=$id ";
    	//echo $sql;
    	//echo "\n";
    	$this->update_sql($sql);
	}

	function update9($id,$title,$url){
		$sql = "update task set title='$title',url='$url' where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	

	function update10($id,$num,$status){
		$sql = "update task set num=num+'$num',status='$status' where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	


	function update18($id,$num){
		$sql = "update task set xiansu=1,times='$num' where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	

	function update20($id,$num,$status){
		$sql = "update task set num=num+'$num',addNum='$num',status='$status' where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	

	function update28($id){
		$sql = "update task set image=1 where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	


	function del($id){
		$sql = "delete from task where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}
