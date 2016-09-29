<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class memoClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from memo";
    	return $this->getTotalNumber($sql);
	}
	function getAllByorderid($orderid){
		$sql = "select count(*) as number from memo where orderid='$orderid'";
    	return $this->getTotalNumber($sql);
	}	
	function getCountByKeyword($orderid){
		$sql = "select count(*) as number from memo where orderid='$orderid'";
    	return $this->getTotalNumber($sql);
	}
	function getCountBytodo(){
		$sql = "select count(*) as number from memo where status='待处理'";
    	return $this->getTotalNumber($sql);
	}
	function getCountBytodo2($username){
		$sql = "select count(*) as number from memo where status='待处理' and username2='$username'";
    	return $this->getTotalNumber($sql);
	}	
	function getCountBydone(){
		$sql = "select count(*) as number from memo where status!='待处理'";
    	return $this->getTotalNumber($sql);
	}				
	function getCountBydone2($username){
		$sql = "select count(*) as number from memo where status!='待处理' and username2='$username'";
    	return $this->getTotalNumber($sql);
	}					
	function getCountByKeyword2($username,$orderid){
		$sql = "select count(*) as number from memo where username='$username' and orderid='$orderid'";
    	return $this->getTotalNumber($sql);
	}			
	function getCount2($username){
		$sql = "select count(*) as number from memo where username='$username'";
    	return $this->getTotalNumber($sql);
	}
	function getCount3($username){
		$sql = "select count(*) as number from memo where username2='$username'";
    	return $this->getTotalNumber($sql);
	}	
	function getCount4(){
		$sql = "select count(*) as number from memo where state='未接单'";
    	return $this->getTotalNumber($sql);
	}		

	function getAllItems($offset,$rows){
		$sql = "select * from memo order by id asc limit $offset,$rows";
		return $this->selectArray($sql);		
	}
	function getAllItemsByKeyword($keyword){
		$sql = "select * from memo where orderid='$keyword' order by id desc";
		return $this->selectArray($sql);		
	}	
	function getAllItemsByKeyword2($username,$keyword){
		$sql = "select * from memo where username='$username' and orderid='$keyword' order by id desc";
		return $this->selectArray($sql);		
	}		
	function getAllItemsBytodo($offset,$rows){
		$sql = "select * from memo where status='待处理' order by id asc limit $offset,$rows";
		return $this->selectArray($sql);		
	}
	function getAllItemsBytodo2($username,$offset,$rows){
		$sql = "select * from memo where status='待处理' and username2='$username' order by id asc limit $offset,$rows";
		return $this->selectArray($sql);		
	}		
	function getAllItemsBydone($offset,$rows){
		$sql = "select * from memo where status!='待处理' order by id asc limit $offset,$rows";
		return $this->selectArray($sql);		
	}			

	function getAllItemsBydone2($username,$offset,$rows){
		$sql = "select * from memo where status!='待处理' and username2='$username' order by id asc limit $offset,$rows";
		return $this->selectArray($sql);		
	}				
	function getAllItems2($username,$offset,$rows){
		$sql = "select * from memo where username='$username' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}
	function getAllItems3($username,$offset,$rows){
		$sql = "select * from memo where username2='$username' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}	
	function getAll(){
		$sql = "select * from memo order by id desc";
		return $this->selectArray($sql);
	}	
	function getAll2(){
		$sql = "select * from memo where state='未接单' order by id asc";
		return $this->selectArray($sql);
	}		
	function makeorderid(){

        //$i = rand(0,9999);
        $i=0;
        do{
            if(999==$i){
                $i=0;
            }
            $i++;
            $orderid = date('Ymd').str_pad($i,3,'0',STR_PAD_LEFT);
            $total=$this->getAllByorderid($orderid);
        }while($total);
        return $orderid;
	}	
	function add($orderid,$name,$female,$addr,$birthday){
		$sql = "INSERT  INTO memo(orderid,name,female,addr,birthday,createTime) Values('$orderid','$name','$female','$addr','$birthday',now())";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
	function update($orderid,$fee){
		$sql = "update memo set fee='$fee' where orderid='$orderid'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
	function update2($orderid,$orderDate){
		$sql = "update memo set orderDate='$orderDate' where orderid='$orderid'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
	function update3($orderid,$orderTime){
		$sql = "update memo set orderTime='$orderTime' where orderid='$orderid'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	function update4($orderid,$status){
		$sql = "update memo set status='$status' where orderid='$orderid'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	

	function del($id){
		$sql = "delete from memo where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}