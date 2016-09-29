<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class queueClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from queue";
    	return $this->getTotalNumber($sql);
	}

	

	function getAll(){
		$sql = "select * from queue order by id desc";
		return $this->selectArray($sql);
	}	

	function add($pid,$sortcode,$orderid){	

		$sql = "INSERT  INTO queue(pid,sortcode,orderid,createTime) Values('$pid','$sortcode','$orderid',now())";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

	function add2($pid,$sortcode,$orderid,$type,$url,$img1,$img2,$title,$note){	

		$sql = "INSERT  INTO queue(pid,sortcode,orderid,type,url,img1,img2,title,note,createTime) Values('$pid','$sortcode','$orderid','$type','$url','$img1','$img2','$title','$note',now())";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}


	function update($orderid,$fee){
		$sql = "update queue set fee='$fee' where orderid='$orderid'";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}
	function update2($id,$status,$data){
		$sql = "update queue set status='$status',data='$data' where id='$id'";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

	function del($id){
		$sql = "delete from queue where id='$id'";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}		

}