<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class zhifuClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from zhifu";
    	return $this->getTotalNumber($sql);
	}
	function getCount2($openid2){
		$sql = "select count(*) as number from zhifu where openid2='$openid2'";
    	return $this->getTotalNumber($sql);
	}	
	

	function getAll(){
		$sql = "select * from zhifu where wxusername !='' order by id asc";
		return $this->selectArray($sql);		
	}	

	function getAll2($wxusername){
		$sql = "select * from zhifu where wxusername='$wxusername' order by id desc";
		return $this->selectArray($sql);		
	}	
	
	
	
	function getAll3($orderCount){
		$sql = "select * from zhifu where orderCount > $orderCount order by id desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}

	function getAll4(){
		$sql = "select * from zhifu where TIMESTAMPDIFF(HOUR,createTime,now())<5 order by id desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}	



	function getAll5($pid){
		$sql = "select * from zhifu where username not in (select username from done where pid=$pid ) order by id desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}	


	function getAll6($num1,$num2){
		$sql = "select * from zhifu where orderCount > $num1 and orderCount<$num2 order by id desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}

	function getAll7($pid,$orderCount){
		$sql = "select * from zhifu where orderCount>$orderCount and orderCount<50 and username not in (select username from done where pid=$pid ) order by id asc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}	


	function getAll10($pid,$orderCount1,$orderCount2){
		$sql = "select * from zhifu where orderCount>$orderCount1 and orderCount<$orderCount2 and username not in (select username from done where pid=$pid ) order by id desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}

	function getAll8(){
		$sql = "select * from zhifu where province ='广东' order by rand()";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}

	function update($wxusername,$username){
		$sql = "update zhifu set username='$username' where wxusername='$wxusername'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update2($wxusername,$password){
		$sql = "update zhifu set password='$password' where wxusername='$wxusername'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update3($wxusername,$step){
		$sql = "update zhifu set step='$step' where wxusername='$wxusername'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update4($wxusername,$status){
		$sql = "update zhifu set status='$status' where wxusername='$wxusername'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

	function add($telephone,$openid1,$openid2){	

		$sql = "INSERT  INTO zhifu(telephone,openid1,openid2,createTime) Values('$telephone','$openid1','$openid2',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	

	function del($openid){
		$sql = "delete from zhifu where wxusername='$openid'";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}	
	function del2($username){
		$sql = "delete from zhifu where username='$username'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}
