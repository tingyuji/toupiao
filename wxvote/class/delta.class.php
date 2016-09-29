<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class deltaClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from ordersdelta";
    	return $this->getTotalNumber($sql);
	}



	function getCount2($pid){
		$sql = "select count(*) as number from ordersdelta where pid='$pid' and status in ('未上传','已上传','已完成','已审核','可提现','已支付') ";
		return $this->getTotalNumber($sql);
	}



	function getCount3($username){
		$sql = "select count(*) as number from ordersdelta where username='$username' ";
    	return $this->getTotalNumber($sql);
	}


	function getCount4($pid){
		$sql = "select count(*) as number from ordersdelta where pid='$pid' and status in ('已上传','已完成','已审核','可提现','已支付') ";
		return $this->getTotalNumber($sql);
	}

	function getAllByorderid($orderid){
		$sql = "select count(*) as number from ordersdelta where orderid='$orderid'";
    	return $this->getTotalNumber($sql);
	}	

	function getAllItems($offset,$rows){
		$sql = "select a.id,a.username,a.orderid,a.pid,a.status,a.data,a.imgfile,a.source,a.createTime,b.title as title from ordersdelta a inner join task b on a.pid=b.id order by a.id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}
	

	function getAll(){
		$sql = "select * from ordersdelta order by id desc";
		return $this->selectArray($sql);
	}	

	function getAll1($pid){
		$sql = "select * from ordersdelta where pid='$pid' order by id desc";
		return $this->selectArray($sql);
	}

	function getAll2($orderid){
		$sql = "select * from ordersdelta where orderid='$orderid' order by id desc";
		return $this->selectArray($sql);
	}
	function getAll3(){
		$sql = "select pid,count(*) as sum from ordersdelta  group by pid order by pid asc";
		return $this->selectArray($sql);
	}			

	function getAll4(){
		$sql = "select * from ordersdelta where TIMESTAMPDIFF(MINUTE,createTime,now())>10 and status in ('未上传') order by id asc";
		return $this->selectArray($sql);
	}		

	function getAll5(){
		$sql = "select pid,count(*) as sum from ordersdelta where status in ('已完成','已审核','可提现','已支付') group by pid order by pid asc";
		return $this->selectArray($sql);
	}

	function getAll6(){
		//$sql = "select * from ordersdelta where TIMESTAMPDIFF(HOUR,createTime,now())>1 and status='已完成' order by id asc";
		$sql = "select * from ordersdelta where TIMESTAMPDIFF(MINUTE,createTime,now())>5 and status='已完成' order by id asc";
		return $this->selectArray($sql);
	}

	function getAll7($status){
		$sql = "select * from ordersdelta where status='$status' order by id asc";
		return $this->selectArray($sql);
	}

	function getAll8(){
		$sql = "select * from ordersdelta where TIMESTAMPDIFF(MINUTE,createTime,now())>10 and status in ('已放弃') order by id asc";
		return $this->selectArray($sql);
	}

	function getAll9(){
		$sql = "select pid,count(*) as sum from ordersdelta where status in ('未上传','已上传','已完成','已审核','可提现','已支付') group by pid order by pid asc";
		return $this->selectArray($sql);
	}


	function getAll10(){
		$sql = "select username,count(*) as sum from ordersdelta group by username ";
		return $this->selectArray($sql);
	}	

	function getAll11(){
		//$sql = "select * from ordersdelta where TIMESTAMPDIFF(HOUR,createTime,now())>1 and status='已完成' order by id asc";
		$sql = "select * from ordersdelta where TIMESTAMPDIFF(MINUTE,createTime,now())>5 and status='已完成' order by id asc limit 100";
		return $this->selectArray($sql);
	}


	function getAll12($status){
		$sql = "select * from ordersdelta where status='$status' order by id asc limit 50000";
		return $this->selectArray($sql);
	}


	function getAll13(){
		$sql = "select * from ordersdelta where username is NULL order by id asc limit 20000";
		return $this->selectArray($sql);
	}

	function getAll15($status){
		$sql = "select * from ordersdelta where left(createTime,10)='2016-05-30' and status='$status' and username is not NULL order by id asc limit 10";
		return $this->selectArray($sql);
	}

	function getAll16(){
		$sql = "select * from ordersdelta where createTime>'2016-05-15' order by id asc";
		return $this->selectArray($sql);
	}


	function getAll18($data){
		$sql = "select * from ordersdelta where data='$data' order by id asc";
		return $this->selectArray($sql);
	}


	function getAll28($status){
		$sql = "select * from ordersdelta where status='$status' and left(createTime,10)='2016-06-01' and username is not NULL order by id asc limit 10";
		return $this->selectArray($sql);
	}

	function getAll38($status){
		$sql = "select * from ordersdelta where status='$status' and left(createTime,10)='2016-05-31' and username is not NULL order by id asc limit 10";
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
            $total=$this->getAll2($orderid);
        }while($total);
        return $orderid;
	}	
	function add($username,$orderid,$pid,$title){	

		$sql = "INSERT  INTO ordersdelta(username,orderid,pid,title,createTime) Values('$username','$orderid','$pid','$title',now())";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function update($orderid,$fee){
		$sql = "update ordersdelta set fee='$fee' where orderid='$orderid'";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}
	function update2($id,$status,$data){
		$sql = "update ordersdelta set status='$status',data='$data' where id=$id ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}


	function update3($orderid,$status,$data){
		$sql = "update ordersdelta set status='$status',data='$data' where orderid='$orderid'";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

	function update5($openid,$username){
		$sql = "update ordersdelta set username='$username' where openid='$openid' and username is NULL";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}	

	function update6($orderid,$data){
		$sql = "update ordersdelta set data='$data' where orderid='$orderid' ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}	

	function update8($orderid,$data){
		$sql = "update ordersdelta set status='已审核',data='$data' where orderid='$orderid' ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}	


	function del($id){
		$sql = "delete from ordersdelta where id=$id ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}

	function del2($status){
		$sql = "delete from ordersdelta where TIMESTAMPDIFF(MINUTE,createTime,now())>10 and status='$status' ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}


	function del3($orderid){
		$sql = "delete from ordersdelta where orderid=$orderid ";
    	echo $sql;
    	echo "\n";
    	$this->update_sql($sql);
	}



}
