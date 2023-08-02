<?php
require_once('settings\connectionsetting.php');
require_once('classes\class.logs.php');
class PRODUCTS 
{

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


		if($id!=NULL)
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
			if($this->productExists($name, $seoId))
			{
				echo 'The name you chose is already taken, choose a different name.';
				return false;
			}
			else
			{
				//do nothing
			}
			
		try
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare("INSERT INTO [PRODUCTS]([NAME],CURRENCY,SEO_ID,PRICE,CREATED_BY,STATUS) 
											VALUES(?,?,?,?,?,'new')"); 
			
			$stmt->bindParam(1,$name);
			$stmt->bindParam(2,$currency);
			$stmt->bindParam(3,$seoId);
			$stmt->bindParam(4,$price);
			$stmt->bindParam(5,$createdBy);			
			$stmt->execute();

			(new LOGS())->save($_SESSION['email'],$_SERVER['HTTP_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'PRODUCTS','SAVE',json_encode($_POST));

			return true;
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	function edit($id,$seoId,$name,$currency,$price,$modifiedBy,  $status='edited' ) 
	{
			if(!$this->safeToEdit($id,$seoId,$name)) 
			{
				echo 'The name you chose is already taken, choose a different name.';
				return false;
			}
			else
			{
				//do nothing
			}
		try
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('UPDATE PRODUCTS	SET [NAME]=?,CURRENCY=?,PRICE=?,MODIFIED_BY=?, [STATUS]=? WHERE ID=?');

			
			$stmt->bindParam(1,$name);
			$stmt->bindParam(2,$currency);
			$stmt->bindParam(3,$price);
		 	$stmt->bindparam(4,$modifiedBy);
			$stmt->bindParam(5,$status);
			$stmt->bindParam(6,$id);
			$stmt->execute();

			(new LOGS())->save($_SESSION['email'],$_SERVER['HTTP_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'PRODUCTS','EDIT',json_encode($_POST));

			return true;
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	function getProducts($seoId)
	{
		try
		{
			$productArray = array();
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM PRODUCTS WHERE SEO_ID=?');
			$stmt->bindparam(1,$seoId);
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
		}
		catch(Exception $e)
		{
			return false;
		}
	}

	function getAllProducts()
	{
		try
		{
			$productArray = array();
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM PRODUCTS');
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
		}
		catch(Exception $e)
		{
			return false;
		}
	}

    // issues which this function due to the unknown operation

	function productExists($name, $seoId)
	{
		try
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM PRODUCTS WHERE [NAME]=? AND SEO_ID=?');
			$stmt->bindParam(1,$name,);
			$stmt->bindParam(2,$seoId);
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
	
	
	function safeToEdit($id,$seoId,$name)
	{
		try
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM PRODUCTS WHERE [NAME]=? AND SEO_ID=? AND ID!=?');
			$stmt->bindParam(1,$name);
			$stmt->bindparam(2,$seoId);
			$stmt->bindparam(3,$id);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				return false;
			}
			return true;
		}
		catch(Exception $e)
		{
			return false;
		}
	}
	


    function delete($id)
	{
			try
			{
				global $Myconnection;
				$stmt = $Myconnection->prepare('DELETE FROM PRODUCTS WHERE ID=?');
				$stmt->bindParam(1,$id);
				$stmt->execute();

				(new LOGS())->save($_SESSION['email'],$_SERVER['HTTP_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'PRODUCTS','DELETE',json_encode($_POST));

				return true;
			}
			catch(Exception $e)
			{
				return false;
			}
	}
	





}



?>