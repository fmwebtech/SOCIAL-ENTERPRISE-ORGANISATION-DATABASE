<?php
require_once("classes/class.logs.php");
require_once('settings/connectionsetting.php');
class USERPROFILES{
	
	
var $id;
var $profileId;
var $userId;
var $status;
var $regDate;
//ID	PROFILEID	USERID	STATUS	REGDATE	



	function __construct($id=NULL)
	{
		if($id==NULL)
		{
			//do nothing  ID	PROFILEID	USERID	STATUS	REGDATE	
		}
		else
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM USERPROFILES WHERE ID=?');
			$stmt->bindParam(1,$id);
			$stmt->execute();
			 $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{ // 			
				$this->id = $v['ID'];
				$this->profileId = $v['PROFILEID'];
				$this->userId = $v['USERID'];
				$this->status = $v['STATUS'];
				$this->regDate = $v['REGDATE'];
			}
		}
	}
	
	function save($userId,$profileId)
	{
			if($this->thisExists($userId,$profileId))
			{
				echo 'There is already a record for the options you have choosen. kindly choose something else';
				return false;
			}else
			{
				//do nothing
			}
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare("INSERT INTO USERPROFILES(USERID,PROFILEID,STATUS) 
											VALUES(?,?,'new')");
			$stmt->bindParam(1,$userId);
			$stmt->bindParam(2,$profileId);
			$stmt->execute();
			(new LOGS())->save($_SESSION['email'],$_SERVER['HTTP_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'USERPROFILES','SAVE',json_encode($_POST));
			return true;
		}catch(Exception $e)
		{
			echo $e->getMessage();
			return false;
		}
	}
	
	
	function edit($id,$profileId,$userId,$status=null)
	{
			if(!$this->safeToEdit($id,$profileId,$userId))
			{
				echo 'There is already that matches the values you have selected.';
				return false;
			}else{
				//do nothing
			}
			if($status==null)
			{
				$status='edited';
			}
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('UPDATE USERPROFILES	SET PROFILEID=?,USERID=?,STATUS=? WHERE ID=?');
			$stmt->bindParam(1,$profileId);
			$stmt->bindParam(2,$userId);
			$stmt->bindParam(3,$status);
			$stmt->bindParam(4,$id);
			$stmt->execute();
			(new LOGS())->save($_SESSION['email'],$_SERVER['HTTP_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'USERPROFILES','EDIT',json_encode($_POST));
			return true;
		}catch(Exception $e)
		{
			return false;
		}
	}
	
	
	
	function thisExists($userId,$profileId){
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM USERPROFILES WHERE PROFILEID=? AND USERID=?');
			$stmt->bindParam(1,$profileId);
			$stmt->bindParam(2,$userId);
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
	
	
	function safeToEdit($id,$profileId,$userId){
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM USERPROFILES WHERE PROFILEID=? AND USERID=? AND ID<>?');
			$stmt->bindParam(1,$profileId);
			$stmt->bindParam(2,$userId);
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
	
	
	function getUserProfiles($userId=null)
	{
		try{
			global $Myconnection;
			$stmt=null;
			if($userId==null)
			{
				$stmt = $Myconnection->prepare('SELECT * FROM USERPROFILES');
				
			}
			else
			{
				$stmt = $Myconnection->prepare('SELECT * FROM USERPROFILES WHERE USERID=?');
				$stmt->bindParam(1,$userId);
			}
			$ppsArray = array();
			
			
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				$pps = new USERPROFILES();
				$pps->id = $v['ID'];
				$pps->profileId = $v['PROFILEID'];
				$pps->userId = $v['USERID'];
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
	

	
	function delete($id)
	{
			try{
				global $Myconnection;
				$stmt = $Myconnection->prepare('DELETE FROM USERPROFILES WHERE ID=?');
				$stmt->bindParam(1,$id);
				$stmt->execute();
				(new LOGS())->save($_SESSION['email'],$_SERVER['HTTP_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'USERPROFILES','DELETE',json_encode($_POST));
				return true;
			}catch(Exception $e)
			{
				if(strpos($e->getMessage(),'Integrity constraint'))
				{
				
				echo  '<div class="card bd-0 mg-b-20 bg-danger-transparent alert p-0">
							<div class="card-body text-danger">
								<strong>Oh snap!</strong> 								
								This User profile can not be deleted at the moment. Because the User profile is attached to other system records. 
							
							</div>
						</div>';
				}
				return false;
			}
	}
	

}
?>