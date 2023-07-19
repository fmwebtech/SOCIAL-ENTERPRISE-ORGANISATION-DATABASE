<?php

require_once('settings/connetionsetting.php');
class SERVICES {

    var $id;
    var $seoId;
    var $name;
    var $currency;
	var $price;
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
				$this->price = $v['PRICE'];
				$this->status = $v['STATUS'];
				$this->regDate = $v['REGDATE'];
			}
		}
	}

    function save($name,$currency,$seoId,$price)
			if($this->serviceExits($seoId))
			{
				echo 'The name you chose is already taken, choose a different name.';
				return false;
			}else{
				//do nothing
			}
			
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('INSERT INTO [SERVICES]([NAME],CURRENCY,SOE_ID,PRICE,STATUS) 
											VALUES(?,?,?,?"new")'); 
			
			$stmt->bindParam(1,$name);
			$stmt->bindParam(2,$currency);
			$stmt->bindParam(3,$seoId);
			$stmt->bindParam(4,$price);			
			$stmt->execute();
			return true;
		}catch(Exception $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	function edit($seoId,$name,$currency,$price,$status) 
	{
			if($this->safeToEdit($seoId,$currency,$price,$name)) 
			{
				echo 'The name you chose is already taken, choose a different name.';
				return false;
			}else{
				//do nothing
			}
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('UPDATE [SERVICES] SET [NAME]=?,SEO_ID=?,CURRENCY=?,PRICE=?,WHERE ID=?');

			$stmt->bindParam(1,$name);
			$stmt->bindParam(2,$seoId);
			$stmt->bindParam(2,$currency);
			$stmt->bindParam(2,$price);
			$stmt->bindParam(3,$status);
			$stmt->bindParam(4,$id);
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
				$product = new SERVICES();
				$product->id = $v['ID'];
                $product->seoId= $v['SEO_ID'];
				$product->name = $v['NAME'];
				$product->currency = $v['CURRENCY'];
				$product->price = $v['PRICE'];			
				$product->status = $v['STATUS'];
				$product->regDate = $v['REGDATE'];
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
			$stmt = $Myconnection->prepare('SELECT * FROM [SERVICES] WHERE [NAME]=?');
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
	
	
	function safeToEdit($seoId,$name,$currency,$price,$status){
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM [SERVICES] WHERE [NAME]=?,SEOID=?,CURRENCY=?,PRICE=?');
			$stmt->bindParam(1,$name);
			$stmt->bindParam(2,$seoId);
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
	









?>