<?php

require_once('settings\connectionsetting.php');
class BRANCH
{

    var $id;
    var $seoId;
	var $countryId;
	var $name;
    var $address;
	var $createdBy;
	var $modifiedBy;
    
    var $status;
    var $regDate;

	


	//The constructor method initializes the object and retrieves the country data from the database based on the provided ID
    function __construct($id=NULL)
	{

	

		if($id!=NULL)
		
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM BRANCH WHERE ID=?');
			$stmt->bindParam(1,$id);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{ 			
				$this->id = $v['ID'];
				$this->seoId= $v['SEO_ID'];
				$this->countryId= $v['COUNTRY_ID'];
				$this->name = $v['NAME'];
				$this->address = $v['ADDRESS'];
				$this->createdBy=$v['CREATED_BY'];
				$this->modifiedBy=$v['MODIFIED_BY'];
				$this->status = $v['STATUS'];
				$this->regDate = $v['REGDATE'];
			}
		}
	}

function save($seoId,$countryId, $name, $address,$createdBy,$modifiedBy)
 {
    if ($this->branchExists($name, $address)) 
	{
        echo 'The name you chose is already taken, choose a different name.';
        return false;
    } 
	else 
	{
    
    }

    try 
	{
        global $Myconnection;
        $stmt = $Myconnection->prepare("INSERT INTO BRANCH( [SEO_ID], [COUNTRY_ID], [NAME], [ADDRESS], [CREATED_BY], [MODIFIED_BY], [STATUS]) 
                                        VALUES (?, ?, ?, ?, ?, ?, 'new')");
        $stmt->bindParam(1, $seoId);
		$stmt->bindParam(2, $countryId);
		$stmt->bindParam(3, $name);
		$stmt->bindParam(4, $address);
        $stmt->bindParam(5, $createdBy);
        $stmt->bindParam(6, $modifiedBy);
        $stmt->execute();
        return true;
    } 
	catch (Exception $e) 
	{
        echo $e->getMessage();
        return false;
    }
}
	
function branchExists($name, $address) 
	{
		try
		 {
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM branch WHERE [NAME] = ? AND [ADDRESS] = ?');
			$stmt->bindParam(1, $name);
			$stmt->bindParam(2, $address);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
	
			foreach ($results as $k => $v) {
				return true;
			}
			return false;
		}
		 catch (Exception $e) 
		 {
			return true;
		}
	}
	









	// ISSUE
function edit($id, $seoId, $countryId, $name, $address, $modifiedBy, $status)
	{

	  if (!$this->safeToEdit($id,$seoId, $address,$name, $countryId))
	 {
        echo 'The Branch you chose is already taken, choose a different Branch.';
        return false;
    } 
	else 
	{
        //do nothing
    }

    try 
	{
        global $Myconnection;
        $stmt = $Myconnection->prepare('UPDATE BRANCH SET [SEO_ID] =?, [COUNTRY_ID] = ?, [NAME]=?, [ADDRESS]=?, [MODIFIED_BY] = ?, [STATUS]=? WHERE [ID] =?');

        $stmt->bindParam(1, $seoId);
		$stmt->bindParam(2, $countryId);
		$stmt->bindParam(3, $name);
		$stmt->bindParam(4, $address);
        $stmt->bindParam(5, $modifiedBy);
		$stmt->bindParam(6, $status);
        $stmt->bindParam(7, $id);
        $stmt->execute();
        return true;
    }
	 catch (Exception $e) 
	 {
        return false;
    }
}

function safeToEdit($id,$seoId, $address, $name, $countryId)
{
    try
    {
        global $Myconnection;
        $stmt = $Myconnection->prepare('SELECT * FROM BRANCH WHERE [NAME]=? AND [ADDRESS]=? AND [SEO_ID]=? AND [COUNTRY_ID]=? AND [ID]<>?');
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $address);
        $stmt->bindParam(3, $seoId);
        $stmt->bindParam(4, $countryId);
		$stmt->bindParam(5,$id);
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


	function getBranch($seoId, $countryId)
	{
		try
		{
			$branchArray = array();
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM BRANCH WHERE [SEO_ID]=? AND [COUNTRY_ID]=?');
			$stmt->bindParam(1,$seoId);
			$stmt->bindParam(2,$countryId);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				$branch = new BRANCH();
				$branch->id = $v['ID'];
                $branch->seoId= $v['SEO_ID'];
				$branch->countryId=$v['COUNTRY_ID'];
				$branch->name = $v['NAME'];
				$branch->address = $v['ADDRESS'];
				$branch->createdBy=$v['CREATED_BY'];
				$branch->modifiedBy=$v['MODIFIED_BY'];
				$branch->status = $v['STATUS'];
				$branch->regDate = $v['REGDATE'];
				$branchArray[] =$branch;
			}
			return $branchArray;
		}
		catch(Exception $e)
		{
			return false;
		}
	}



	function getBranchBySeo($seoId)
	{
		try
		{
			$branchArray = array();
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM BRANCH WHERE [SEO_ID]=? ');
			$stmt->bindParam(1,$seoId);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				$branch = new BRANCH();
				$branch->id = $v['ID'];
                $branch->seoId= $v['SEO_ID'];
				$branch->countryId=$v['COUNTRY_ID'];
				$branch->name = $v['NAME'];
				$branch->address = $v['ADDRESS'];
				$branch->createdBy=$v['CREATED_BY'];
				$branch->modifiedBy=$v['MODIFIED_BY'];
				$branch->status = $v['STATUS'];
				$branch->regDate = $v['REGDATE'];
				$branchArray[] =$branch;
			}
			return $branchArray;
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
				$stmt = $Myconnection->prepare('DELETE FROM branch WHERE ID=?');
				$stmt->bindParam(1,$id);
				$stmt->execute();
				return true;
			
			}
			catch(Exception $e)
			{
				return false;
			}
	}
	


}






?>
