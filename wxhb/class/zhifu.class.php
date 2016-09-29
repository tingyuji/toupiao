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
		$sql = "select * from zhifu order by id asc";
		return $this->selectArray($sql);		
	}	

	function getAll2($openid2){
		$sql = "select * from zhifu where openid2='$openid2' order by id asc";
		return $this->selectArray($sql);		
	}	

	function update($wxusername,$username){
		$sql = "update zhifu set username='$username' where wxusername='$wxusername'";
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


}
