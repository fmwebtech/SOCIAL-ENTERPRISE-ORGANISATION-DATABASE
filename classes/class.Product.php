<?php

require_once('settings\connectionsetting.php');
class PRODUCTS {

    var $id;
    var $seoId;
    var $name;
    var $currency;
	var $modifiedBy;
	var $createdBy;
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
			$stmt = $Myconnection->prepare('SELECT * FROM PRODUCTS WHERE ID=?');
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

    function save($name,$currency,$seoId,$price,$createdBy)
	{
			if($this->productExists($name))
			{
				echo 'The name you chose is already taken, choose a different name.';
				return false;
			}else{
				//do nothing
			}
			
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('INSERT INTO [SERVICE]([NAME],CREATED_BY,CURRENCY,SOE_ID,PRICE,STATUS) 
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

	function edit($id, $seoId,$name,$currency,$price,$modifiedBy,) 
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
			$stmt = $Myconnection->prepare('UPDATE PRODUCTS	SET [NAME]=?,SEO_ID=?,CURRENCY=?,PRICE=?,MODIFIED_BY=? WHERE ID=?');

			$stmt->bindParam(1,$name);
			$stmt->bindParam(2,$seoId);
			$stmt->bindParam(2,$currency);
			$stmt->bindParam(2,$price);
			$stmt->bindparam(4,$modifiedBy);
			$stmt->bindParam(3,$status);
			$stmt->bindParam(4,$id);
			$stmt->execute();
			return true;
		}catch(Exception $e)
		{
			return false;
		}
	}

	function getProduct($seoId)
	{
		try{
			$productArray = array();
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM PRODUCTS WHERE SEO_ID=?');
			$stmt->bindParam(1,$seoId);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				$product = new PRODUCTS();
				$product->id = $v['ID'];
                $product->seoId= $v['SEO_ID'];
				$product->name = $v['NAME'];
				$product->currency = $v['CURRENCY'];
				$product->price = $v['PRICE'];			
				$product->status = $v['STATUS'];
				$product->regDate = $v['REGDATE'];
				$productArray[] =$product;
			}
			return $productArray;
		}catch(Exception $e)
		{
			return false;
		}
	}

    // issues which this function due to the unknown operation

	function productExists($name)
	{
		try
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM PRODUCT WHERE [NAME]=?');
			$stmt->bindParam(1,$name);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				return true;
			}
			return false;
		}
		catch(Exception $e)
		{
			return true;
		}
	}
	
	
	function safeToEdit($seoId,$name,$currency,$price,$modifiedBy){
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM PRODUCTS WHERE [NAME]=?,SEOID=?,MODIFIED=?,CURRENCY=?,PRICE=?');
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
				$stmt = $Myconnection->prepare('DELETE FROM PRODUCTS WHERE ID=?');
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