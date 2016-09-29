<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class itemsClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from items";
    	return $this->getTotalNumber($sql);
	}
	function getCount2($website){
		$sql = "select count(*) as number from items where website='$website'";
    	return $this->getTotalNumber($sql);
	}	

	function getAll(){
		$sql = "select * from items order by id desc";
		return $this->selectArray($sql);
	}	
	function getAll2($website,$date1,$date2){
		$sql = "select a.*,b.sale1,b.sale2,b.cpm from items a left join sale b on a.date1=b.date1 where a.website = '$website' and a.date1 >= '$date1' and a.date1 <= '$date2' order by a.id desc ";
		return $this->selectArray($sql);
	}	
	function add($website,$date1,$t1,$t2){		
		$sql = "INSERT  INTO items(website,date1,t1,t2,createTime) Values('$website','$date1','$t1','$t2',now())";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
	function update(){
		$sql = "update items set status='1' where status='0'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
			
	function del($id){
		$sql = "delete from items where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		
	function drop($website){
		$sql = "delete from items where website='$website'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
}