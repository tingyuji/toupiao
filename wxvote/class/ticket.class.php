<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class ticketClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}

	function getCount(){
		$sql = "select count(*) as number from ticket";
    	return $this->getTotalNumber($sql);
	}
	function getCount2($username){
		$sql = "select count(*) as number from ticket where username='$username'";
    	return $this->getTotalNumber($sql);
	}	

	function getCount3($username,$today){
		$sql = "select count(*) as number from ticket where username='$username'  and date1='$today'";
    	return $this->getTotalNumber($sql);
	}	
	function getCount4($today,$code){
		$sql = "select count(*) as number from ticket where date1='$today'  and code='$code'";
    	return $this->getTotalNumber($sql);
	}
	function getCount5($refundType){
		$sql = "select count(*) as number from ticket where refundType=$refundType";
    	return $this->getTotalNumber($sql);
	}	
	function getCount6($refundType,$username){
		$sql = "select count(*) as number from ticket where refundType=$refundType and username='$username' ";
    	return $this->getTotalNumber($sql);
	}	
	function getCount7($refundType,$username,$time){
		$sql = "select count(*) as number from ticket where refundType=$refundType and username='$username' and date1='$time' ";
    	return $this->getTotalNumber($sql);
	}		
	function getCount8($refundType,$time,$username){
		$sql = "select count(*) as number from ticket where refundType=$refundType and date1='$time' and username='$username' ";
    	return $this->getTotalNumber($sql);
	}						
	function getCountByKeyword($date1,$loc2){
		$sql = "select count(*) as number from ticket where date1='$date1' and loc2='$loc2'";
    	return $this->getTotalNumber($sql);
	}	
	function getCountByKeyword2($username,$date1,$loc2){
		$sql = "select count(*) as number from ticket where username='$username' and date1='$date1' and loc2='$loc2'";
    	return $this->getTotalNumber($sql);
	}		

	function getCountByticket($ticket){
		$sql = "select count(*) as number from ticket where ticket = '$ticket' ";
    	return $this->getTotalNumber($sql);
	}	

	function getCountByticket2($ticket){
		$sql = "select count(*) as number from ticket where ticket = '$ticket' and status='未用'";
    	return $this->getTotalNumber($sql);
	}		

	function getAllItems($offset,$rows){
		$sql = "select * from ticket order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function getAllItems2($username,$offset,$rows){
		$sql = "select * from ticket where username='$username' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}	

	function getAllItems3($username,$today,$offset,$rows){
		$sql = "select * from ticket where username='$username' and date1='$today' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}		
	function getAllItems7($username,$offset,$rows){
		$sql = "select date1,code,loc2,count(*) as total,sum(price) as amount from ticket  where username='$username' group by date1,code,loc2 order by date1 desc limit $offset,$rows";
		return $this->selectArray($sql);	
	}	
	function getAllItems8($offset,$rows){
		$sql = "select date1,code,loc2,count(*) as total,sum(price) as amount from ticket  group by date1,code,loc2 order by date1 desc limit $offset,$rows";
		return $this->selectArray($sql);	
	}
	function getAllItems9($username,$offset,$rows){
		$sql = "select date1,count(*) as total,sum(price) as amount from ticket  where username='$username' group by date1 order by date1 desc limit $offset,$rows";
		return $this->selectArray($sql);	
	}		

	function getAllItems10($offset,$rows){
		$sql = "select date1,count(*) as total,sum(price) as amount from ticket  group by date1 order by date1 desc limit $offset,$rows";
		return $this->selectArray($sql);	
	}			
	function getAllItems11($offset,$rows){
		$sql = "select date1,type,count(*) as total,sum(price) as amount from ticket  group by date1,type order by date1 desc limit $offset,$rows";
		return $this->selectArray($sql);	
	}		
	function getAllItems12($username,$offset,$rows){
		$sql = "select date1,type,count(*) as total,sum(price) as amount from ticket  where username='$username' group by date1,type order by date1 desc limit $offset,$rows";
		return $this->selectArray($sql);	
	}			
	function getAllItems13($refundType,$offset,$rows){
		$sql = "select * from ticket where refundType='$refundType' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}		
	function getAllItems14($refundType,$offset,$rows){
		$sql = "select date1,count(*) as total,sum(price) as amount from ticket where refundType='$refundType' group by date1 order by date1 desc limit $offset,$rows";
		return $this->selectArray($sql);	
	}	
	function getAllItems15($refundType,$username,$offset,$rows){
		$sql = "select * from ticket where refundType='$refundType' and username='$username' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}
	function getAllItems16($refundType,$username,$offset,$rows){
		$sql = "select date1,count(*) as total,sum(price) as amount from ticket where refundType='$refundType' and username='$username' group by date1 order by date1 desc limit $offset,$rows";
		return $this->selectArray($sql);	
	}	
	function getAllItems17($refundType,$username,$time,$offset,$rows){
		$sql = "select * from ticket where refundType='$refundType' and username='$username' and date1='$time' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}	
	function getAllItems18($refundType,$username,$time,$offset,$rows){
		$sql = "select date1,count(*) as total,sum(price) as amount from ticket where refundType='$refundType' and username='$username' and date1='$time' group by date1 order by date1 desc limit $offset,$rows";
		return $this->selectArray($sql);	
	}	
	function getAllItems19($refundType,$time,$username,$offset,$rows){
		$sql = "select * from ticket where refundType='$refundType' and date1='$time' and username='$username' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}					
	function getAllItems20($refundType,$time,$offset,$rows){
		$sql = "select date1,count(*) as total,sum(price) as amount from ticket where refundType='$refundType' and date1='$time' group by date1 order by date1 desc limit $offset,$rows";
		return $this->selectArray($sql);	
	}					
	function getAllItemsByKeyword($date1,$loc2,$offset,$rows){
		$sql = "select * from ticket where date1='$date1' and loc2='$loc2' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}	

	function getAllItemsByKeyword2($username,$date1,$loc2,$offset,$rows){
		$sql = "select * from ticket where username='$username' and date1='$date1' and loc2='$loc2' order by id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}	
	function getAllItemsByKeyword3($time,$rCode,$offset,$rows){
		$rCode=strtoupper($rCode);
		$sql = "select date1,code,loc2,count(*) as total,sum(price) as amount from ticket where date1='$time' and code='$rCode' group by date1,code,loc2 order by date1 desc limit $offset,$rows";
		return $this->selectArray($sql);			
	}	
	function getAllByKeyword3($time,$rCode){
		$rCode=strtoupper($rCode);
		$sql = "select date1,code,loc2,count(*) as total,sum(price) as amount from ticket where date1='$time' and code='$rCode' group by date1,code,loc2 order by date1 desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);			
	}	
	function getAllItemsByKeyword4($username,$time,$rCode,$offset,$rows){
		$rCode=strtoupper($rCode);
		$sql = "select date1,code,loc2,count(*) as total,sum(price) as amount from ticket where username='$username' and date1='$time' and code='$rCode' group by date1,code,loc2 order by date1 desc limit $offset,$rows";
		return $this->selectArray($sql);			
	}	
	function getAllItemsByKeyword9($username,$time,$offset,$rows){
		$sql = "select date1,code,loc2,count(*) as total,sum(price) as amount from ticket where username='$username' and date1='$time' group by date1,code,loc2 order by date1 desc limit $offset,$rows";
		return $this->selectArray($sql);			
	}		
	function getAllByKeyword4($username,$time,$rCode){
		$rCode=strtoupper($rCode);
		$sql = "select date1,code,loc2,count(*) as total,sum(price) as amount from ticket where username='$username' and date1='$time' and code='$rCode' group by date1,code,loc2 order by date1 desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);			
	}
	function getAllByKeyword9($username,$time){
		$sql = "select date1,code,loc2,count(*) as total,sum(price) as amount from ticket where username='$username' and date1='$time' group by date1,code,loc2 order by date1 desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);			
	}			
	function getAllItemsByKeyword5($username,$time,$offset,$rows){
		$sql = "select date1,count(*) as total,sum(price) as amount from ticket where username='$username' and date1='$time' group by date1 order by date1 desc limit $offset,$rows";
		return $this->selectArray($sql);			
	}	
	function getAllByKeyword5($username,$time){
		$sql = "select date1,count(*) as total,sum(price) as amount from ticket where username='$username' and date1='$time' group by date1 order by date1 desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);			
	}
	function getAllItemsByKeyword6($time,$offset,$rows){
		$sql = "select date1,count(*) as total,sum(price) as amount from ticket where date1='$time' group by date1 order by date1 desc limit $offset,$rows";
		return $this->selectArray($sql);			
	}	
	function getAllItemsByKeyword7($time,$offset,$rows){
		$sql = "select date1,code,loc2,count(*) as total,sum(price) as amount from ticket where date1='$time' group by date1,code,loc2 order by date1 desc limit $offset,$rows";
		return $this->selectArray($sql);			
	}		
	function getAllItemsByKeyword8($time,$offset,$rows){
		$sql = "select date1,type,count(*) as total,sum(price) as amount from ticket where date1='$time' group by date1,type order by date1 desc limit $offset,$rows";
		return $this->selectArray($sql);			
	}
	function getAllItemsByKeyword10($time1,$time2,$offset,$rows){
		$sql = "select date1,code,loc2,count(*) as total,sum(price) as amount from ticket where date1>='$time1' and date1 <='$time2' group by date1,code,loc2 order by date1 desc limit $offset,$rows";
		return $this->selectArray($sql);			
	}		
	function getAllItemsByKeyword11($username,$time1,$time2,$offset,$rows){
		$sql = "select date1,code,loc2,count(*) as total,sum(price) as amount from ticket where username='$username' and date1>='$time1' and date1<='$time2' group by date1,code,loc2 order by date1 desc limit $offset,$rows";
		return $this->selectArray($sql);			
	}						
	function getAllByKeyword6($time){
		$sql = "select date1,count(*) as total,sum(price) as amount from ticket where date1='$time' group by date1 order by date1 desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);			
	}				
	function getAllByKeyword7($time){
		$sql = "select date1,code,loc2,count(*) as total,sum(price) as amount from ticket where date1='$time' group by date1,code,loc2 order by date1 desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);			
	}			
	function getAllByKeyword8(){
		$sql = "select date1,code,loc2,count(*) as total,sum(price) as amount from ticket group by date1,code,loc2 order by date1 desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);			
	}			
	function getAllByKeyword10($time){
		$sql = "select date1,type,count(*) as total,sum(price) as amount from ticket where date1='$time' group by date1,type order by date1 desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);			
	}		
	function getAllByKeyword11($time1,$time2){
		$sql = "select date1,code,loc2,count(*) as total,sum(price) as amount from ticket where date1>='$time1' and date1<='$time2' group by date1,code,loc2 order by date1 desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);			
	}	
	function getAllByKeyword12($username,$time1,$time2){
		$sql = "select date1,code,loc2,count(*) as total,sum(price) as amount from ticket where username='$username' and date1>='$time1' and date1<='$time2' group by date1,code,loc2 order by date1 desc";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);			
	}											
	function getAll(){
		$sql = "select * from ticket order by id desc";
		return $this->selectArray($sql);
	}
	function getAll2(){
		$sql = "select date1,count(*) as total from ticket group by date1 order by date1 desc";
		return $this->selectArray($sql);
	}	
	function getAll3($username,$today){
		$sql = "select loc2,type,count(*) as total,sum(price) as amount from ticket where username='$username' and date1='$today' group by loc2,type ";
		return $this->selectArray($sql);
	}			
	function getAll4($username){
		$sql = "select date1,loc2,count(*) as total,sum(price) as amount from ticket where username='$username' group by date1,loc2 order by date1 desc";
		return $this->selectArray($sql);
	}
	function getAll5($username){
		$sql = "select * from ticket where username='$username' order by id desc";
		return $this->selectArray($sql);
	}	

	function getAll6(){
		$sql = "select date1,username,loc2,count(*) as total,sum(price) as amount from ticket group by date1,username,loc2 order by date1 desc";
		return $this->selectArray($sql);
	}	
	function getAll7($username){
		$sql = "select date1,code,loc2,count(*) as total,sum(price) as amount from ticket where username='$username' group by date1,code,loc2 order by date1 desc";
		return $this->selectArray($sql);
	}	
	function getAll8(){
		$sql = "select date1,code,loc2,count(*) as total,sum(price) as amount from ticket  group by date1,code,loc2 order by date1 desc";
		return $this->selectArray($sql);
	}		
	function getAll9($username){
		$sql = "select date1,count(*) as total,sum(price) as amount from ticket where username='$username' group by date1 order by date1 desc";
		return $this->selectArray($sql);
	}		
	function getAll10(){
		$sql = "select date1,count(*) as total,sum(price) as amount from ticket group by date1 order by date1 desc";
		return $this->selectArray($sql);
	}				
	function getAll11($username,$today){
		$today=date("Y-m-d");
		$sql = "select * from ticket where username='$username' and date1='$today' order by id desc";
		return $this->selectArray($sql);
	}	
	function getAll12(){
		$sql = "select date1,type,count(*) as total,sum(price) as amount from ticket group by date1,type order by date1 desc";
		return $this->selectArray($sql);
	}		
	function getAll13($username){
		$sql = "select date1,type,count(*) as total,sum(price) as amount from ticket where username='$username' group by date1,type order by date1 desc";
		return $this->selectArray($sql);
	}	
	function getAll14($refundType){
		$sql = "select date1,count(*) as total,sum(price) as amount from ticket where refundType='$refundType' group by date1 order by date1 desc";
		return $this->selectArray($sql);
	}		
	function getAll15($refundType,$username){
		$sql = "select date1,type,count(*) as total,sum(price) as amount from ticket where refundType='$refundType' and username='$username' group by date1,type order by date1 desc";
		return $this->selectArray($sql);
	}		
	function getAll16($refundType,$username,$time){
		$sql = "select date1,type,count(*) as total,sum(price) as amount from ticket where refundType='$refundType' and username='$username' and date1='$time' group by date1,type order by date1 desc";
		return $this->selectArray($sql);
	}			
	function getAll17($refundType){
		$sql = "select * from ticket where refundType='$refundType' order by id desc ";
		return $this->selectArray($sql);		
	}		
	function getAll18($refundType,$time){
		$sql = "select date1,count(*) as total,sum(price) as amount from ticket where refundType='$refundType' and date1='$time' group by date1 order by date1 desc";
		return $this->selectArray($sql);
	}				
	function getAll19($refundType,$time,$username){
		$sql = "select * from ticket where refundType='$refundType' and date1='$time' and username='$username' order by id desc ";
		return $this->selectArray($sql);		
	}					
	function getAll20($refundType,$username){
		$sql = "select * from ticket where refundType='$refundType' and username='$username' order by id desc ";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}						
	function add($username,$date,$orderCode,$code,$loc1,$loc2,$price,$price2,$status,$time,$type){		
		$sql = "INSERT  INTO ticket(username,date1,orderCode,code,loc1,loc2,price,price2,status,time,type,createTime) Values('$username','$date','$orderCode','$code','$loc1','$loc2','$price','$price2','$status','$time','$type',now())";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
	function update($vercode){
		$sql = "update ticket set status='已用' where ticket='$vercode'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function updateByorderCode($orderCode){
		$sql = "update ticket set refundType=1,refundTime=now() where orderCode='$orderCode'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}
	function del($id){
		$sql = "delete from ticket where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		

}