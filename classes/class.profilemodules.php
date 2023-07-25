<?php
require_once('settings/connetionsetting.php');
require_once("classes/class.logs.php");
class PROFILEMODULES{
	
	
var $id;
var $profileId;
var $moduleId;
var $status;
var $regDate;
//ID	PROFILEID	MODULEID	STATUS	REGDATE	



	function __construct($id=NULL)
	{
		if($id==NULL){
			//do nothing  ID	PROFILEID	MODULEID	STATUS	REGDATE	
		}else
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM profilemodules WHERE ID=?');
			$stmt->bindParam(1,$id);
			$stmt->execute();
			 $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{ // 			
				$this->id = $v['ID'];
				$this->profileId = $v['PROFILEID'];
				$this->moduleId = $v['MODULEID'];
				$this->status = $v['STATUS'];
				$this->regDate = $v['REGDATE'];
			}
		}
	}
	
	function save($profileId,$moduleId)
	{
			if($this->thisExists($profileId,$moduleId))
			{
				echo 'There is already a record for the options you have choosen. kindly choose something else';
				return false;
			}else
			{
				//do nothing
			}
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('INSERT INTO profilemodules(PROFILEID,MODULEID,STATUS) 
											VALUES(?,?,"new")');
			$stmt->bindParam(1,$profileId);
			$stmt->bindParam(2,$moduleId);
			$stmt->execute();
			(new LOGS())->save($_SESSION['email'],'PROFILEMODULE.SAVE','Data : profileId='.$profileId.',moduleId='.$moduleId);
			return true;
		}catch(Exception $e)
		{
			return false;
		}
	}
	
	
	function edit($id,$profileId,$moduleId,$status=null)
	{
			if(!$this->safeToEdit($id,$profileId,$moduleId))
			{
				echo 'There is already that matches with the values you have selected.';
				return false;
			}else{
				//do nothing
			}
			if($status==null){
				$status='new';
			}
			
		try
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('UPDATE profilemodules	SET PROFILEID=?,MODULEID=?,STATUS=? WHERE ID=?');
			$stmt->bindParam(1,$profileId);
			$stmt->bindParam(2,$moduleId);
			$stmt->bindParam(3,$status);
			$stmt->bindParam(4,$id);
			$stmt->execute();
			(new LOGS())->save($_SESSION['email'],'PROFILEMODULE.EDIT','Data : id='.$id.',profileId='.$profileId.',moduleId='.$moduleId);
			return true;
		}catch(Exception $e)
		{
			return false;
		}
	}
	
	
	
	function thisExists($profileId,$moduleId){
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM profilemodules WHERE PROFILEID=? AND MODULEID=?');
			$stmt->bindParam(1,$profileId);
			$stmt->bindParam(2,$moduleId);
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
	
	
	function safeToEdit($id,$profileId,$moduleId){
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM profilemodules WHERE PROFILEID=? AND MODULEID=? AND ID<>?');
			$stmt->bindParam(1,$profileId);
			$stmt->bindParam(2,$moduleId);
			$stmt->bindParam(3,$id);
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
	
	
	function getProfileModules($profileId=null)
	{
		try{
			global $Myconnection;
			$stmt=null;
			if($profileId==null)
			{
				$stmt = $Myconnection->prepare('SELECT * FROM profilemodules');
				
			}else
			{
				$stmt = $Myconnection->prepare('SELECT * FROM profilemodules WHERE PROFILEID=?');
				$stmt->bindParam(1,$profileId);
			}
			$ppsArray = array();
			
			
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				$pps = new PROFILEMODULES();
				$pps->id = $v['ID'];
				$pps->profileId = $v['PROFILEID'];
				$pps->moduleId = $v['MODULEID'];
				$pps->status = $v['STATUS'];
				$pps->regDate = $v['REGDATE'];
				$ppsArray[] =$pps;
			}
			return $ppsArray;
		}catch(Exception $e)
		{
			return false;
		}
	}
	
	

	
	function isMyModule($profileId,$moduleId)
	{
		try
		{
			
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM profilemodules WHERE PROFILEID=? AND MODULEID=?');
			$stmt->bindParam(1,$profileId);
			$stmt->bindParam(2,$moduleId);
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
			return false;
		}
	}
	

	
	function delete($id)
	{
			try{
				global $Myconnection;
				$stmt = $Myconnection->prepare('DELETE FROM profilemodules WHERE ID=?');
				$stmt->bindParam(1,$id);
				$stmt->execute();
				(new LOGS())->save($_SESSION['email'],'PROFILEMODULE.DELETE','Data : id='.$id);
				return true;
			}catch(Exception $e)
			{
				if(strpos($e->getMessage(),'Integrity constraint'))
				{
				
				echo  '<div class="card bd-0 mg-b-20 bg-danger-transparent alert p-0">
							<div class="card-body text-danger">
								<strong>Oh snap!</strong> 								
								This Profile Module can not be deleted at the moment. Because the Profile Module is attached to other system records. 
							
							</div>
						</div>';
				}
				return false;
			}
	}
	

}
?>