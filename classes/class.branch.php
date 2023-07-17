<?php

require_once('settings/connetionsetting.php');
class Branch{

    var $id;
    var $seo_country_id;
    var $name;
    var $address;
    var $status;
    var $regDate;

    function __construct($id=NULL)
	{
		if($id==NULL){
			//do nothing
		}else
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM branch WHERE ID=?');
			$stmt->bindParam(1,$id);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{ // 			
				$this->id = $v['ID'];
				$this->seo_country_id= $v['SEO_COUNTRY_ID'];
				$this->name = $v['NAME'];
				$this->address = $v['ADDRESS'];
				$this->status = $v['STATUS'];
				$this->regDate = $v['REGDATE'];
			}
		}
	}

    function save($name,$address)
			if($this->userNameExists($name))
			{
				echo 'The name you chose is already taken, choose a different name.';
				return false;
			}else{
				//do nothing
			}
			
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('INSERT INTO branch(NAME,ADDRESS,STATUS) 
											VALUES(?,?,?,"new")');
			
			$stmt->bindParam(1,$name);
			$stmt->bindParam(2,$address);			
			$stmt->execute();
			return true;
		}catch(Exception $e)
		{
			echo $e->getMessage();
			return false;
		}
	}

	function edit($id,$seo_country_id,$name,$address,$status)
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
			$stmt = $Myconnection->prepare('SELECT * FROM branch WHERE NAME=?');
			$stmt->bindParam(1,$type);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				$branch = new Branch();
				$branch->id = $v['ID'];
                $branch->seo_country_id= $v['SEO_COUNTRY_ID'];
				$branch->name = $v['NAME'];
				$branch->address = $v['ADDRESS'];			
				$branch->status = $v['STATUS'];
				$branch->regDate = $v['REGDATE'];
				$branchArray[] =$branch;
			}
			return $branchArray;
		}catch(Exception $e)
		{
			return false;
		}
	}



    function delete($id)
	{
			try{
				global $Myconnection;
				$stmt = $Myconnection->prepare('DELETE FROM branch WHERE ID=?');
				$stmt->bindParam(1,$id);
				$stmt->execute();
				return true;
			}catch(Exception $e)
			{
				return false;
			}
	}
	









?>