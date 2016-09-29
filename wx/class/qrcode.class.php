<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class qrcodeClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from qrcode";
    	return $this->getTotalNumber($sql);
	}
	function getCount2($openid2){
		$sql = "select count(*) as number from qrcode where openid2='$openid2'";
    	return $this->getTotalNumber($sql);
	}	
	

	function getAll(){
		$sql = "select * from qrcode order by id asc";
		return $this->selectArray($sql);		
	}	

	function getAll2($openid2){
		$sql = "select * from qrcode where openid2='$openid2' order by id asc";
		return $this->selectArray($sql);		
	}	

	function update($wxusername,$username){
		$sql = "update qrcode set username='$username' where wxusername='$wxusername'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}


	function add($qrcode,$openid){	

		$sql = "INSERT  INTO qrcode(qrcode,openid,createTime) Values('$qrcode','$openid',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	

	function del($openid){
		$sql = "delete from qrcode where wxusername='$openid'";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}	


}
