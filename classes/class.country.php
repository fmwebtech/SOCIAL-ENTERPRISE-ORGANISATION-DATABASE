<?php
//Frank
require_once('settings/connetionsetting.php');
class COUNTRY{

    var $id;
    var $name;
    var $code;
    var $status;
    var $regDate;

    function __construct($id=NULL)
	{
		if($id==NULL){
			//do nothing
		}else
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM country WHERE ID=?');
			$stmt->bindParam(1,$id);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{ // 			
				$this->id = $v['ID'];				
				$this->name = $v['NAME'];
				$this->code = $v['CODE'];
				$this->status = $v['STATUS'];
				$this->regDate = $v['REGDATE'];
			}
		}
	}


	//CREATE FUNCTION FOR CODE =CODEEXIST=
    function save($name,$code){
			if($this->countryExists($code))
			{
				echo 'The name you chose is already taken, choose a different name.';
				return false;
			}else{
				//do nothing
			}
			
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('INSERT INTO country([NAME], [CODE] ,[STATUS]) 
											VALUES(?,?,"new")');
			
			$stmt->bindParam(1,$name);
			$stmt->bindParam(2,$code);			
			$stmt->execute();
			return true;
		}catch(Exception $e)
		{
			echo $e->getMessage();
			return false;
		}
	}



	function countryExists($code) {
		try {
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM branch WHERE [CODE] = ? ');
			$stmt->bindParam(1, $code);			
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
	
			foreach ($results as $k => $v) {
				return true;
			}
	
			return false;
		} catch (Exception $e) {
			return true;
		}
	}
	





	function edit($id,$name,$code,$status)
	{
			if($this->safeToEdit($id,$code))
			{
				echo 'The code you chose is already taken, choose a different code.';
				return false;
			}else{
				//do nothing
			}
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('UPDATE country	SET NAME=?,CODE =?,STATUS=? WHERE ID=?');

			$stmt->bindParam(1,$name);
			$stmt->bindParam(2,$code);
			$stmt->bindParam(3,$status);
			$stmt->bindParam(4,$id);
			$stmt->execute();
			return true;
		}catch(Exception $e)
		{
			return false;
		}
	}


	function safeToEdit($id,$code){
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM branch WHERE [CODE]=? AND ID<>?');
			$stmt->bindParam(1,$code);
			$stmt->bindParam(2,$id);
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






	//GETcOUNTRY
	function getCountry($code)
	{
		try{
			$countryArray = array();
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM country WHERE CODE=?');
			$stmt->bindParam(1,$code);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				$country = new COUNTRY();
				$country->id = $v['ID'];
                $country->code= $v['CODE'];
				$country->name = $v['NAME'];		
				$country->status = $v['STATUS'];
				$country->regDate = $v['REGDATE'];
				$countryArray[] =$country;
			}
			return $countryArray;
		}catch(Exception $e)
		{
			return false;
		}
	}

//testing

    function delete($id)
	{
			try{
				global $Myconnection;
				$stmt = $Myconnection->prepare('DELETE FROM country WHERE ID=?');
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
