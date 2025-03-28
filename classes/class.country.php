<?php
//Frank
require_once('settings\connectionsetting.php');
require_once('classes\class.logs.php');

class COUNTRY
{

    var $id;
    var $name;
    var $code;
	var $createdBy;
	var $modifiedBy;
    var $status;
    var $regDate;

    function __construct($id=NULL)
	{

		if($id!=NULL)
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM COUNTRY WHERE ID=?');
			$stmt->bindParam(1,$id);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{ 		
				$this->id = $v['ID'];				
				$this->name = $v['NAME'];
				$this->code = $v['CODE'];
				$this->createdBy = $v['CREATED_BY'];
				$this->modifiedBy = $v['MODIFIED_BY'];
				$this->status = $v['STATUS'];
				$this->regDate = $v['REGDATE'];
			}
		}
	}


	

    function save($name,$code, $createdBy,)
{
		if($this->countryExists($code, $name))
		{
			echo 'The country name or code you chose is already taken, choose a different country name or code.';
			return false;
		}
		
		try
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare("INSERT INTO COUNTRY([NAME], [CODE], [CREATED_BY],[STATUS]) 
											VALUES(?,?,?,'new')");
			
			$stmt->bindParam(1,$name);
			$stmt->bindParam(2,$code);
			$stmt->bindParam(3,$createdBy);			
			$stmt->execute();

			(new LOGS())->save($_SESSION['email'],$_SERVER['HTTP_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'COUNTRY','SAVE',json_encode($_POST));
			return true;
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			return false;
		}
	}



	function countryExists($code,$name) 
	{
		try
		 {
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM COUNTRY WHERE [CODE] = ? OR [NAME] =?');
			$stmt->bindParam(1, $code);
			$stmt->bindParam(2, $name);				
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
	
			foreach ($results as $k => $v)
			 {
				return true;
			}
	
			return false;
		} 
		catch (Exception $e)
		 {
			echo $e->getMessage();
			return true;
		}
	}
	





	function edit($id, $name, $code,  $modifiedBy, $status='edited')
	{
			if(!$this->safeToEdit($id,$code))
			{
				echo 'The code you chose is already taken, choose a different code.';
				return false;
			}
			else
			{
				
			}
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('UPDATE COUNTRY	SET [NAME]=?,[CODE] =?, [MODIFIED_BY]=?, [STATUS]=? WHERE ID=?');

			$stmt->bindParam(1,$name);
			$stmt->bindParam(2,$code);
			$stmt->bindParam(3,$modifiedBy);
			$stmt->bindParam(4,$status);
			$stmt->bindParam(5,$id);
			$stmt->execute();

			(new LOGS())->save($_SESSION['email'],$_SERVER['HTTP_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'COUNTRY','EDIT',json_encode($_POST));
			return true;
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			return false;
		}
	}


	function safeToEdit($id,$code)
	{
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM COUNTRY WHERE [CODE]=? AND ID<>?');
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
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			return false;
		}
	}





	function getCountry()
	{
		try
		{
			$countryArray = array();
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM country');
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				$country = new COUNTRY();
				$country->id = $v['ID'];
                $country->code= $v['CODE'];
				$country->name = $v['NAME'];
				$country->createdBy = $v['CREATED_BY'];
				$country->modifiedBy = $v['MODIFIED_BY'];		
				$country->status = $v['STATUS'];
				$country->regDate = $v['REGDATE'];
				$countryArray[] =$country;
			}
			return $countryArray;
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			return false;
		}
	}


    function delete($id)
	{
			try
			{
				global $Myconnection;
				$stmt = $Myconnection->prepare('DELETE FROM country WHERE ID=?');
				$stmt->bindParam(1,$id);
				$stmt->execute();
				(new LOGS())->save($_SESSION['email'],$_SERVER['HTTP_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'COUNTRY','DELETE',json_encode($_POST));
				return true;
			}
			catch(Exception $e)
			{
				if(strpos($e->getMessage(),'statement conflicted'))
				{
				
				echo  '<div class="card bd-0 mg-b-20 bg-danger-transparent alert p-0">
							<div class="card-body text-danger">
								<strong>Oh snap!</strong> 
								
								This country can not be deleted at the moment. because the country is attached to other system records. 
							
							</div>
						</div>';
				}
				return false;
			}
	}
	

}




?>
