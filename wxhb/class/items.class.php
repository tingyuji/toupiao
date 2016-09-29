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
	function getAllByorderid($orderid){
		$sql = "select count(*) as number from items where orderid='$orderid'";
    	return $this->getTotalNumber($sql);
	}	
	function getCountByKeyword($orderid){
		$sql = "select count(*) as number from items where orderid='$orderid'";
    	return $this->getTotalNumber($sql);
	}
	function getCountBytodo(){
		$sql = "select count(*) as number from items where status='待处理'";
    	return $this->getTotalNumber($sql);
	}
	function getCountBytodo2($username){
		$sql = "select count(*) as number from items where status='待处理' and username2='$username'";
    	return $this->getTotalNumber($sql);
	}	
	function getCountBydone(){
		$sql = "select count(*) as number from items where status!='待处理'";
    	return $this->getTotalNumber($sql);
	}				
	function getCountBydone2($username){
		$sql = "select count(*) as number from items where status!='待处理' and username2='$username'";
    	return $this->getTotalNumber($sql);
	}					
	function getCountByKeyword2($username,$orderid){
		$sql = "select count(*) as number from items where username='$username' and orderid='$orderid'";
    	return $this->getTotalNumber($sql);
	}			
	function getCount2($username){
		$sql = "select count(*) as number from items where username='$username'";
    	return $this->getTotalNumber($sql);
	}
	function getCount3($username){
		$sql = "select count(*) as number from items where username2='$username'";
    	return $this->getTotalNumber($sql);
	}	
	function getCount4(){
		$sql = "select count(*) as number from items where state='未接单'";
    	return $this->getTotalNumber($sql);
	}		

	function getAllItems($offset,$rows){
		$sql = "select * from items order by id asc limit $offset,$rows";
		return $this->selectArray($sql);		
	}
	function getAllItemsByKeyword($keyword){
		$sql = "select * from items where orderid='$keyword' order by id desc";
		return $this->selectArray($sql);		
	}	
	function getAllItemsByKeyword2($username,$keyword){
		$sql = "select * from items where username='$username' and orderid='$keyword' order by id desc";
		return $this->selectArray($sql);		
	}		
	function getAllItemsBytodo($offset,$rows){
		$sql = "select * from items where status='待处理' order by id asc limit $offset,$rows";
		return $this->selectArray($sql);		
	}
	function getAllItemsBytodo2($username,$offset,$rows){
		$sql = "select * from items where status='待处理' and username2='$username' order by id asc limit $offset,$rows";
		return $this->selectArray($sql);		
	}		
	function getAllItemsBydone($offset,$rows){
		$sql = "select * from items where status!='待处理' order by id asc limit $offset,$rows";
		return $this->selectArray($sql);		
	}			

	function getAllItemsBydone2($username,$offset,$rows){
		$sql = "select * from items where status!='待处理' and username2='$username' order by id asc limit $offset,$rows";
		return $this->selectArray($sql);		
	}				
	function getAllItems2($username,$offset,$rows){
		$sql = "select * from items where username='$username' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}
	function getAllItems3($username,$offset,$rows){
		$sql = "select * from items where username2='$username' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}	
	function getAll(){
		$sql = "select * from items order by id desc";
		return $this->selectArray($sql);
	}	
	function getAll2(){
		$sql = "select * from items where state='未接单' order by id asc";
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
	function add($orderid,$orderDate,$orderTime,$fee){
		$sql = "INSERT  INTO items(orderid,orderDate,orderTime,fee,createTime) Values('$orderid','$orderDate','$orderTime','$fee',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	function update($orderid,$image,$image2,$vercode,$status){
		$sql = "update items set image='$image',image2='$image2',vercode='$vercode',status='$status' where orderid='$orderid'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
	function update2($orderid,$vercode,$status){
		$sql = "update items set vercode2='$vercode',status='$status' where orderid='$orderid'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
	function update3($orderid,$username){
		$sql = "update items set username2='$username',state='已接单' where orderid='$orderid'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	function update4($orderid){
		$sql = "update items set number2=number2-1 where orderid='$orderid'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}	
	function update5($orderid){
		$sql = "update items set number2=number2+1 where orderid='$orderid'";
    	//echo $sql;
    	//echo '<br>';
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