<?php

require_once('settings/connetionsetting.php');
class SERVICES {

    var $id;
    var $seoId;
    var $name;
    var $currency;
	var $price;
	var $modifiedBy;
	var $createdBy;
    var $status;
    var $regDate;

    function __construct($id=NULL)
	{
		if($id==NULL){
			//do nothing
		}else
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM [SERVICES] WHERE ID=?');
			$stmt->bindParam(1,$id);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{ // 			
				$this->id = $v['ID'];
				$this->seoId= $v['SEO_ID'];
				$this->name = $v['NAME'];
				$this->currency = $v['CURRENCY'];
				$this->modifiedBy = $v['MODIFIED_BY'];
				$this->createdBy = $v['CREATED_BY'];
				$this->price = $v['PRICE'];
				$this->status = $v['STATUS'];
				$this->regDate = $v['REGDATE'];
			}
		}
	}

    function save($name,$currency,$seoId,$price,$createdBy){
			if($this->serviceExists($name))
			{
				echo 'The name you chose is already taken, choose a different name.';
				return false;
			}else{
				//do nothing
			}
			
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('INSERT INTO [SERVICES]([NAME],CREATED_BY,CURRENCY,SOE_ID,PRICE,STATUS) 
											VALUES(?,?,?,?,?,"new")'); 
			
			$stmt->bindParam(1,$name);
			$stmt->bindParam(2,$currency);
			$stmt->bindParam(3,$seoId);
			$stmt->bindParam(4,$price);
			$stmt->bindParam(5,$createdBy);			
			$stmt->execute();
			return true;
		}catch(Exception $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	function edit($id, $seoId,$name,$currency,$price,$status,$modifiedBy) 
	{
			if($this->safeToEdit($seoId,$currency,$price,$name,$modifiedBy)) 
			{
				echo 'The name you chose is already taken, choose a different name.';
				return false;
			}else{
				//do nothing
			}
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('UPDATE [SERVICES] SET [NAME]=?,SEO_ID=?,CURRENCY=?,MODIFIED_BY=?,PRICE=? WHERE ID=?');

			$stmt->bindParam(1,$name);
			$stmt->bindParam(2,$seoId);
			$stmt->bindParam(3,$currency);
			$stmt->bindparam(4,$modifiedBy);
			$stmt->bindParam(5,$price);
			$stmt->bindParam(6,$status);
			$stmt->bindParam(7,$id);
			$stmt->execute();
			return true;
		}catch(Exception $e)
		{
			return false;
		}
	}

	function getService($name,$seoId,$currency,$price)
	{
		try{
			$serviceArray = array();
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM [SERVICES] WHERE [NAME]=?,SEO_ID=?,CURRENCY=?,PRICE=?');
			$stmt->bindParam(1,$name);
			$stmt->bindParam(1,$seoId);
			$stmt->bindParam(1,$currency);
			$stmt->bindParam(1,$price);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				$service = new SERVICES();
				$service->id = $v['ID'];
                $service->seoId= $v['SEO_ID'];
				$service->name = $v['NAME'];
				$service->currency = $v['CURRENCY'];
				$service->price = $v['PRICE'];			
				$service->status = $v['STATUS'];
				$service->regDate = $v['REGDATE'];
				$serviceArray[] =$service;
			}
			return $serviceArray;
		}catch(Exception $e)
		{
			return false;
		}
	}

    // issues which this function due to the unknown operation

	function serviceExists($name){
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM services WHERE [NAME]=?');
			$stmt->bindParam(1,$name);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				return true;
			}
			return false;
		}catch(Exception $e)
		{
			return true;
		}
	}
	
	
	function safeToEdit($seoId,$name,$currency,$price,$modifiedBy){
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM [SERVICES] WHERE [NAME]=?,SEOID=?,MODIFIED=?,CURRENCY=?,PRICE=?');
			$stmt->bindParam(1,$name);
			$stmt->bindParam(2,$seoId);
			$stmt->bindparam(4,$modified_by);
			$stmt->bindParam(3,$currency);
			$stmt->bindParam(1,$price);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				return false;
			}
			return true;
		}catch(Exception $e)
		{
			return false;
		}
	}
	

   



    function delete($id)
	{
			try{
				global $Myconnection;
				$stmt = $Myconnection->prepare('DELETE FROM [SERVICES] WHERE ID=?');
				$stmt->bindParam(1,$id);
				$stmt->execute();
				return true;
			}catch(Exception $e)
			{
				return false;
			}
	}
	





}



?>