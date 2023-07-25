<?php
require_once('settings/connetionsetting.php');
require_once("classes/class.logs.php");
class PROFILE{
	
	
var $id;
var $name;
var $status;
var $regDate;
//ID	NAME	STATUS	REGDATE	
//profile


	function __construct($id=NULL)
	{
		if($id==NULL){
			//do nothing
		}else
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM profile WHERE ID=?');
			$stmt->bindParam(1,$id);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{ // 			
				$this->id = $v['ID'];
				$this->name = $v['NAME'];
				$this->status = $v['STATUS'];
				$this->regDate = $v['REGDATE'];
			}
		}
	}
	
	function save($name)
	{
			if($this->profileExists($name))
			{
				echo 'The profile you are trying to save is already defined, Please enter a different profile';
				return false;
			}else
			{
				//do nothing
			}
		try
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('INSERT INTO profile(NAME,STATUS) 
											VALUES(?,"new")');
			$stmt->bindParam(1,$name);
			$stmt->execute();
			
			
			(new LOGS())->save($_SESSION['email'],'PROFILE.SAVE','Data : name='.$name);
			
			//USER COMPUTER CLASS FUNCTION DATA
			
		
			(new LOGS())->save($_SESSION['email'],$_SERVER['REMOTE_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'PROFILE','SAVE',json_encode($_POST));
			
			return true;
		}catch(Exception $e)
		{
			return false;
		}
	}
	
	
	function edit($id,$name,$status=null)
	{
			if(!$this->safeToEdit($id,$name))
			{
				echo 'You cant change this profile to the values selected, there is already another profile like it.';
				return false;
			}else{
				//do nothing
			}
			if($status==null)
			{
				$status = 'edited';
			}
		try
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('UPDATE profile SET NAME=?,STATUS=? WHERE ID=?');
			$stmt->bindParam(1,$name);
			$stmt->bindParam(2,$status);
			$stmt->bindParam(3,$id);
			$stmt->execute();
			(new LOGS())->save($_SESSION['email'],'PROFILE.EDIT','Data : name='.$name.',id='.$id);
			return true;
		}catch(Exception $e)
		{
			return false;
		}
	}
	
	
	
	function profileExists($name){
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM profile WHERE NAME=?');
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
	
	
	function safeToEdit($id,$name){
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM profile WHERE NAME=? AND ID<>?');
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
	
	
	function getprofiles()
	{
		try{
			$profileArray = array();
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM profile');
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				$profile = new PROFILE();
				$profile->id = $v['ID'];
				$profile->name = $v['NAME'];
				$profile->status = $v['STATUS'];
				$profile->regDate = $v['REGDATE'];
				$profileArray[] =$profile;
			}
			return $profileArray;
		}catch(Exception $e)
		{
			return false;
		}
	}
	

	
	
	function delete($id)
	{
			try{
				global $Myconnection;
				$stmt = $Myconnection->prepare('DELETE FROM profile WHERE ID=?');
				$stmt->bindParam(1,$id);
				$stmt->execute();
				(new LOGS())->save($_SESSION['email'],'PROFILE.DELETE','Data :id='.$id);
				return true;
			}catch(Exception $e)
			{
				
				if(strpos($e->getMessage(),'Integrity constraint'))
				{
				
				echo  '<div class="card bd-0 mg-b-20 bg-danger-transparent alert p-0">
							<div class="card-body text-danger">
								<strong>Oh snap!</strong> 
								
								This Profile can not be deleted at the moment. Because the Profile is attached to other system records. 
							
							</div>
						</div>';
				}
				return false;
			}
	}
	

}
?>