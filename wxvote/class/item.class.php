<?php
require_once 'database_wcc.php';
setlocale(LC_ALL, 'zh_CN.utf-8');

class itemClass extends database_wcc {
	private $test_datasource = 'test_datasource';
	function __construct ($config=NULL){
		parent::__construct($this->test_datasource);
	}
	function getCount(){
		$sql = "select count(*) as number from item";
    	return $this->getTotalNumber($sql);
	}
	function getCount2($website){
		$sql = "select count(*) as number from item where website='$website'";
    	return $this->getTotalNumber($sql);
	}	
	function getCount3($website){
		$sql = "select count(*) as number from item where website='$website' and status='1'";
    	return $this->getTotalNumber($sql);
	}		
	function getCountByKey($website,$date1){
		$sql = "select count(*) as number from item where website='$website' and date1='$date1'";
    	return $this->getTotalNumber($sql);
	}			
	function getCountByKeyword($website,$date1,$date2){
		$sql = "select count(*) as number from item where website = '$website' and date1 >= '$date1' and date1 <= '$date2'";
		//echo $sql;
		//echo '<br>';
    	return $this->getTotalNumber($sql);
	}	
	function getCountByKeyword2($website,$date1,$date2){
		$sql = "select count(*) as number from item where website = '$website' and date1 >= '$date1' and date1 <= '$date2' and status='1'";
		//echo $sql;
		//echo '<br>';
    	return $this->getTotalNumber($sql);
	}	

	function getAllItems($offset,$rows){
		$sql = "select a.*,b.sale1,b.sale2,b.cpm from item a left join sale b on a.date1=b.date1 order by a.id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}
	function getAllItems2($website,$offset,$rows){
		$sql = "select a.*,b.sale1,b.sale2,b.cpm from item a left join sale b on a.date1=b.date1 where a.website='$website' order by a.id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}	

	function getAllTotal($website,$offset,$rows){
		$sql = "select sum(tb.t1) as t1,sum(tb.t2) as t2,sum(tb.c1) as c1,sum(tb.c2) as c2,sum(tb.rate2) as rate2,sum(tb.income) as income  from (select a.t1 as t1,a.t2 as t2,a.c1 as c1,a.c2 as c2,a.rate2 as rate2,a.income as income from item a left join sale b on a.date1=b.date1 where a.website='$website' order by a.id desc limit $offset,$rows) tb";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}	


	function getAllItems3($website,$offset,$rows){
		$sql = "select a.*,b.sale1,b.sale2,b.cpm from item a left join sale b on a.date1=b.date1 where a.website='$website' and a.status='1' order by a.id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}	

	function getAllTotal3($website,$offset,$rows){
		$sql = "select sum(tb.t1) as t1,sum(tb.t2) as t2,sum(tb.c1) as c1,sum(tb.c2) as c2,sum(tb.rate2) as rate2,sum(tb.income) as income  from (select a.t1 as t1,a.t2 as t2,a.c1 as c1,a.c2 as c2,a.rate2 as rate2,a.income as income from item a left join sale b on a.date1=b.date1 where a.website='$website' order by a.id desc limit $offset,$rows) tb";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}	
	function getAllItemsByKeyword($website,$date1,$date2,$offset,$rows){
		$sql = "select a.*,b.sale1,b.sale2,b.cpm from item a left join sale b on a.date1=b.date1 where a.website = '$website' and a.date1 >= '$date1' and a.date1 <= '$date2' order by a.id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}

	function getAllTotal2($website,$date1,$date2,$offset,$rows){
		$sql = "select sum(tb.t1) as t1,sum(tb.t2) as t2,sum(tb.c1) as c1,sum(tb.c2) as c2,sum(tb.rate2) as rate2,sum(tb.income) as income from (select a.t1 as t1,a.t2 as t2,a.c1 as c1,a.c2 as c2,a.rate2 as rate2,a.income as income from item a left join sale b on a.date1=b.date1 where a.website = '$website' and a.date1 >= '$date1' and a.date1 <= '$date2' order by a.id desc limit $offset,$rows) tb";
		return $this->selectArray($sql);		
	}		

	function getAllItemsByKeyword2($website,$date1,$date2,$offset,$rows){
		$sql = "select a.*,b.sale1,b.sale2,b.cpm from item a left join sale b on a.date1=b.date1 where a.website = '$website' and a.date1 >= '$date1' and a.date1 <= '$date2' and a.status='1' order by a.id desc limit $offset,$rows";
		return $this->selectArray($sql);		
	}	
	function getAllTotal4($website,$date1,$date2,$offset,$rows){
		$sql = "select sum(tb.t1) as t1,sum(tb.t2) as t2,sum(tb.c1) as c1,sum(tb.c2) as c2,sum(tb.rate2) as rate2,sum(tb.income) as income from (select a.t1 as t1,a.t2 as t2,a.c1 as c1,a.c2 as c2,a.rate2 as rate2,a.income as income from item a left join sale b on a.date1=b.date1 where a.website = '$website' and a.date1 >= '$date1' and a.date1 <= '$date2' and a.status='1'  order by a.id desc limit $offset,$rows) tb";
		//echo $sql;
		//echo '<br>';
		return $this->selectArray($sql);		
	}	
	function getAll(){
		$sql = "select * from item order by id desc";
		return $this->selectArray($sql);
	}	
	function getAll2($website,$date1,$date2){
		$sql = "select a.*,b.sale1,b.sale2,b.cpm from item a left join sale b on a.date1=b.date1 where a.website = '$website' and a.date1 >= '$date1' and a.date1 <= '$date2' order by a.id desc ";
		return $this->selectArray($sql);
	}	
	function add($website,$date1,$t1,$t2){		
		$sql = "INSERT  INTO item(website,date1,t1,t2,createTime) Values('$website','$date1','$t1','$t2',now())";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
	function update(){
		$sql = "update item set status='1' where status='0'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}
	function update1($id,$c1){
		$sql = "update item set total=total+1,c1='$c1' where id='$id'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
	function update2($id,$c2){
		$sql = "update item set total=total+1,c2='$c2' where id='$id'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
	function update3($id,$rate2){
		$sql = "update item set total=total+1,rate2='$rate2' where id='$id'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
	function update4($id,$income){
		$sql = "update item set total=total+1,income='$income' where id='$id'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}				
	function del($id){
		$sql = "delete from item where id='$id'";
    	//echo $sql;
    	//echo '<br>';
    	$this->update_sql($sql);
	}		
	function drop($website){
		$sql = "delete from item where website='$website'";
    	echo $sql;
    	echo '<br>';
    	$this->update_sql($sql);
	}	
}