<?php

require_once('settings/connetionsetting.php');
class SERVICES{

    var $id;
    var $seo_id;
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
			$stmt = $Myconnection->prepare('SELECT * FROM SERVICES WHERE ID=?');
			$stmt->bindParam(1,$id);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{ // 			
				$this->id = $v['ID'];
				$this->seo_id= $v['SEO_ID'];
				$this->name = $v['NAME'];
				$this->currency = $v['CURRENCY'];
				$this->price = $v['PRICE'];
				$this->status = $v['STATUS'];
				$this->regDate = $v['REGDATE'];
			}
		}
	}

    function save($name,$currency)
			if($this->userNameExists($name))
			{
				echo 'The name you chose is already taken, choose a different name.';
				return false;
			}else{
				//do nothing
			}
			
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('INSERT INTO branch(NAME,CURRENCY,STATUS) 
											VALUES(?,?,?,"new")');
			
			$stmt->bindParam(1,$name);
			$stmt->bindParam(2,$currency);			
			$stmt->execute();
			return true;
		}catch(Exception $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	function edit($id,$seo_id,$name,$currency,price,$status)
	{
			if($this->safeToEdit($id,$name))
			{
				echo 'The name you chose is already taken, choose a different name.';
				return false;
			}else{
				//do nothing
			}
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('UPDATE branch	SET NAME=?,ADDRESS=?,STATUS=? WHERE ID=?');

			$stmt->bindParam(1,$name);
			$stmt->bindParam(2,$address);
			$stmt->bindParam(3,$status);
			$stmt->bindParam(4,$id);
			$stmt->execute();
			return true;
		}catch(Exception $e)
		{
			return false;
		}
	}

	function getUsers($name)
	{
		try{
			$branchArray = array();
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM PRODUCTS WHERE NAME=?');
			$stmt->bindParam(1,$type);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				$product = new PRODUCTS();
				$product->id = $v['ID'];
                $product->seo_country_id= $v['SEO_COUNTRY_ID'];
				$product->name = $v['NAME'];
				$product->address = $v['ADDRESS'];			
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



    function delete($id)
	{
			try{
				global $Myconnection;
				$stmt = $Myconnection->prepare('DELETE FROM product WHERE ID=?');
				$stmt->bindParam(1,$id);
				$stmt->execute();
				return true;
			}catch(Exception $e)
			{
				return false;
			}
	}
	









?>