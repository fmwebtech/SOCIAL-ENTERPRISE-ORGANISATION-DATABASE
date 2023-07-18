<?php

require_once('settings/connetionsetting.php');
class Branch{

    var $id;
    var $seoCountryId; //camel casing
    var $name;
    var $address;
    var $status;
    var $regDate;

	//


	//The constructor method initializes the object and retrieves the country data from the database based on the provided ID
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
				$this->seoCountryId= $v['SEO_COUNTRY_ID'];
				$this->name = $v['NAME'];
				$this->address = $v['ADDRESS'];
				$this->status = $v['STATUS'];
				$this->regDate = $v['REGDATE'];
			}
		}
	}
// SAVE SEOCOUNTRYID ASWELL
// A BRANCH UNIQUENESS
function save($seoCountryId, $name, $address) {
    if ($this->branchExists($name, $address)) {
        echo 'The name you chose is already taken, choose a different name.';
        return false;
    } else {
        //do nothing
    }

    try {
        global $Myconnection;
        $stmt = $Myconnection->prepare('INSERT INTO branch( SEO_COUNTRY_ID, [NAME], [ADDRESS], [STATUS]) 
                                        VALUES (?, ?, ?, "new")');
        $stmt->bindParam(1, $seoCountryId);
        $stmt->bindParam(2, $name);
        $stmt->bindParam(3, $address);
        $stmt->execute();
        return true;
    } catch (Exception $e) {
        echo $e->getMessage();
        return false;
    }
}
	// new code
	function branchExists($name, $address) {
		try {
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
		} catch (Exception $e) {
			return true;
		}
	}
	









	// ISSUE
	function edit($id, $seoCountryId, $name, $address, $status)
{
    if ($this->safeToEdit($id, $name)) {
        echo 'The name you chose is already taken, choose a different name.';
        return false;
    } else {
        //do nothing
    }

    try {
        global $Myconnection;
        $stmt = $Myconnection->prepare('UPDATE branch SET SEO_COUNTRY_ID=?, [NAME]=?, [ADDRESS]=?, [STATUS]=? WHERE ID=?');

        $stmt->bindParam(1, $seoCountryId);
        $stmt->bindParam(2, $name);
        $stmt->bindParam(3, $address);
        $stmt->bindParam(4, $status);
        $stmt->bindParam(5, $id);
        $stmt->execute();
        return true;
    } catch (Exception $e) {
        return false;
    }
}//hi

function safeToEdit($id,$name){
	try{
		global $Myconnection;
		$stmt = $Myconnection->prepare('SELECT * FROM branch WHERE [NAME]=? AND ID<>?');
		$stmt->bindParam(1,$name);
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








	//MAKE ANOTHER FUNCTION FOR COUNTRY AND 
	function getBranch($seoCountryId)
	{
		try{
			$branchArray = array();
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM branch WHERE SEO_COUNTRY_ID=?');
			$stmt->bindParam(1,$seoCountryId);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				$branch = new Branch();
				$branch->id = $v['ID'];
                $branch->seoCountryId= $v['SEO_COUNTRY_ID'];
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
	


}






?>
