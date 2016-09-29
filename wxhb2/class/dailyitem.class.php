<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class dailyitemClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from dailyitem";
    	return $this->getTotalNumber($sql);
	}
	function getCount2($username){
		$sql = "select count(*) as number from dailyitem where username='$username'";
    	return $this->getTotalNumber($sql);
	}
	function getCount3($openid){
		$sql = "select count(*) as number from dailyitem where openid='$openid' and status='已确认'";
    	return $this->getTotalNumber($sql);
	}
	function getAll(){
		$sql = "select * from dailyitem where order by id desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}
		
	function getAll2(){
		$sql = "select openid,sum(fee) as money from dailyitem where status=0 group by openid order by sum(fee) desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}
	
	function update($openid,$status){
		$sql = "update dailyitem set status='$status' where openid='$openid'";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

	function update2($id,$billno){
		$sql = "update dailyitem set billno='$billno',status='已支付' where id=$id";
    	///echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}

		
	function add($username,$dailyitem,$action){		
		$sql = "INSERT  INTO dailyitem(username,dailyitem,action,createTime) Values('$username','$dailyitem','$action',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	function del($id){
		$sql = "delete from dailyitem where id=$id";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}		

}