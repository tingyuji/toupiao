<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class mappingClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from mapping";
    	return $this->getTotalNumber($sql);
	}
	function getCount2($wxusername){
		$sql = "select count(*) as number from mapping where wxusername='$wxusername'";
    	return $this->getTotalNumber($sql);
	}	
	

	function getAll(){
		$sql = "select * from mapping where wxusername !='' order by id asc";
		return $this->selectArray($sql);		
	}	

	function getAll2($wxusername){
		$sql = "select * from mapping where wxusername='$wxusername' order by id desc";
		return $this->selectArray($sql);		
	}	
	
	
	
	function getAll3($orderCount){
		$sql = "select * from mapping where orderCount > $orderCount order by id desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}

	function getAll4(){
		$sql = "select * from mapping where TIMESTAMPDIFF(HOUR,createTime,now())<5 order by id desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}	



	function getAll5($pid){
		$sql = "select * from mapping where username not in (select username from done where pid=$pid ) order by id desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}	


	function getAll6($num1,$num2){
		$sql = "select * from mapping where orderCount > $num1 and orderCount<$num2 order by id desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}

	function getAll7($pid,$orderCount){
		$sql = "select * from mapping where orderCount>$orderCount and orderCount<50 and username not in (select username from done where pid=$pid ) order by id asc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}	


	function getAll10($pid,$orderCount1,$orderCount2){
		$sql = "select * from mapping where orderCount>$orderCount1 and orderCount<$orderCount2 and username not in (select username from done where pid=$pid ) order by id desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}

	function getAll8(){
		$sql = "select * from mapping where province ='河南' order by id asc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}

	function update($wxusername,$username){
		$sql = "update mapping set username='$username' where wxusername='$wxusername'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update2($wxusername,$password){
		$sql = "update mapping set password='$password' where wxusername='$wxusername'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update3($wxusername,$step){
		$sql = "update mapping set step='$step' where wxusername='$wxusername'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update4($wxusername,$status){
		$sql = "update mapping set status='$status' where wxusername='$wxusername'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

	function add($wxusername){	

		$sql = "INSERT  INTO mapping(wxusername,createTime) Values('$wxusername',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	

	function del($openid){
		$sql = "delete from mapping where wxusername='$openid'";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}	
	function del2($username){
		$sql = "delete from mapping where username='$username'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}
