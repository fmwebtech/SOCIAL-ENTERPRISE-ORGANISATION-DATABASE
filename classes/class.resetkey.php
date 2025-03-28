<?php
require_once('settings/connectionsetting.php');
require_once("classes/class.logs.php");
require_once("phpmailer/sendMail.php");
class RESETKEY{
	
	
var $id;
var $resetkey;
var $email;
var $status;
var $regDate;



	function __construct($id=NULL)
	{
		if($id==NULL){
			//do nothing
		}else
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM RESETKEY WHERE ID=?');
			$stmt->bindParam(1,$id);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{ // 			
				$this->id = $v['ID'];
				$this->email = $v['EMAIL'];
				$this->resetkey = $v['RESETKEY'];
				$this->status = $v['STATUS'];
				$this->regDate = $v['REGDATE'];
			}
		}
	}
	
	function save($email,$returnPath,$message)
	{
			$resetkey = md5($email.date_format(new DateTime(),'yiusd')); // generate new reset key
			$serverAddress = $_SERVER['SERVER_ADDR'];
			if($serverAddress=='::1')
			{
				$serverAddress ='localhost';
			}
			$appURL =  'http://'.$serverAddress.'/'.explode('/',$_SERVER['PHP_SELF'])[1];
		try
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare("INSERT INTO resetkey(EMAIL,RESETKEY,STATUS) 
											VALUES(?,?,'new')");
			$stmt->bindParam(1,$email);
			$stmt->bindParam(2,$resetkey);
			$stmt->execute();
			// send to recipient.
			sendmail($email,"SEOD",$message.' To complete this action please go to : '.$appURL.'/'.$returnPath.'?z='.$resetkey.'');
			return true;
		}
		catch(Exception $e)
		{
			echo $e->getMessage();
			return false;
		}
	}
	
	
	function resetkeyExists($email,$resetkey)
	{
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM RESETKEY WHERE EMAIL=? AND RESETKEY=?');
			$stmt->bindParam(1,$email);
			$stmt->bindParam(2,$resetkey);
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
	
	
	function getResetKey($resetkey)
	{
		try
		{
			$resetkeyArray = array();
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM RESETKEY WHERE RESETKEY=?');
			$stmt->bindParam(1,$resetkey);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				$resetkey = new RESETKEY();
				$resetkey->id = $v['ID'];
				$resetkey->email = $v['EMAIL'];
				$resetkey->resetkey = $v['RESETKEY'];
				$resetkey->status = $v['STATUS'];
				$resetkey->regDate = $v['REGDATE'];
				$resetkeyArray[] =$resetkey;
			}
			return $resetkeyArray;
		}catch(Exception $e)
		{
			return false;
		}
	}
	
	function userExists($email)
	{
		try
		{
			$resetkeyArray = array();
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM [USER] WHERE EMAIL=?');
			$stmt->bindParam(1,$email);
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
			echo $e->getMessage();
			return false;
		}
	}
	

	function delete($email)
	{
		try
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('DELETE FROM RESETKEY WHERE EMAIL=?');
			$stmt->bindParam(1,$email);
			$stmt->execute();
			return true;
			
		}catch(Exception $e)
		{
			if(strpos($e->getMessage(),'Integrity constraint'))
			{				
			echo  '<div class="card bd-0 mg-b-20 bg-danger-transparent alert p-0">
						<div class="card-body text-danger">
							<strong>Oh snap!</strong> 								
							This Reset key can not be deleted at the moment. Because the Reset key is attached to other system records. 
						
						</div>
					</div>';
			}
			return false;
		}
	}
	

}
?>