<?php
require_once('settings/connetionsetting.php');
require_once("classes/class.logs.php");
require_once('class.resetkey.php');
class USER{
	
var $id;
var $email;
var $password;
var $firstName;
var $lastName;
var $status;
var $regDate;
//	ID	FIRSTNAME	LASTNAME	EMAIL	PASSWORD	STATUS	REGDATE	



	function __construct($id=NULL)
	{
		if($id==NULL){
			//do nothing
		}else
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM [USER] WHERE ID=?');
			$stmt->bindParam(1,$id);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{ 			
				$this->id = $v['ID'];
				$this->email = $v['EMAIL'];
				$this->firstName = $v['FIRSTNAME'];
				$this->lastName = $v['LASTNAME'];
				$this->status = $v['STATUS'];
				$this->regDate = $v['REGDATE'];
			}
		}
	}
	
	function save($firstName,$lastName,$email,$password)
	{
			if($this->userNameExists($email))
			{
				echo 'The email you chose is already taken, choose a different email.';
				return false;
			}else{
				//do nothing
			}
			$password = MD5($password);
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('INSERT INTO [USER](FIRSTNAME,LASTNAME,EMAIL,PASSWORD,STATUS) 
											VALUES(?,?,?,?,"new")');
			$stmt->bindParam(1,$firstName);
			$stmt->bindParam(2,$lastName);
			$stmt->bindParam(3,$email);
			$stmt->bindParam(4,$password);
			$stmt->execute();
			(new RESETKEY())->save($email,'resetpassword.php',"You have been registered as a user on social enterprise organisation database. kindly create your credentials to log into the system.");
			(new LOGS())->save($_SESSION['email'],$_SERVER['REMOTE_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'USER','SAVE',json_encode($_POST));
			return true;
		}catch(Exception $e)
		{
			//echo $e->getMessage();
			return false;
		}
	}
	
	
	function edit($id,$firstName,$lastName,$email,$status="edited")
	{
			if(!$this->safeToEdit($id,$email))
			{
				echo 'The email you chose is already taken, choose a different email.';
				return false;
			}else{
				//do nothing
			}
		try
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('UPDATE [USER]	SET FIRSTNAME=?,LASTNAME=?,EMAIL=?,STATUS=? WHERE ID=?');
			$stmt->bindParam(1,$firstName);
			$stmt->bindParam(2,$lastName);
			$stmt->bindParam(3,$email);
			$stmt->bindParam(4,$status);
			$stmt->bindParam(5,$id);
			$stmt->execute();
			(new LOGS())->save($_SESSION['email'],$_SERVER['REMOTE_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'USER','EDIT',json_encode($_POST));
			return true;
		}catch(Exception $e)
		{
			return false;
		}
	}
	
	function updatepassword($email,$password)
	{
			$password = MD5($password);
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('UPDATE [USER] SET PASSWORD=? WHERE EMAIL=?');
			$stmt->bindParam(1,$password);
			$stmt->bindParam(2,$email);
			$stmt->execute();
			(new LOGS())->save($_SESSION['email'],$_SERVER['REMOTE_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'USER','UPDATEPASSWORD','PASSWORD CHANGED');
			return true;
		}catch(Exception $e)
		{
			return false;
		}
	}
	
	
	function updatepassword2($id,$password)
	{
			$password = MD5($password);
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('UPDATE [USER] SET PASSWORD=? WHERE ID=?');
			$stmt->bindParam(1,$password);
			$stmt->bindParam(2,$id);
			$stmt->execute();
			(new LOGS())->save($_SESSION['email'],$_SERVER['REMOTE_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'USER','UPDATEPASSWORD2','PASSWORD CHANGED');
			return true;
		}catch(Exception $e)
		{
			return false;
		}
	}
	
	
	
	
	
	function userNameExists($email)
	{
		try
		{
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
			return true;
		}
	}
	
	
	function safeToEdit($id,$email){
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM [USER] WHERE EMAIL=? AND ID<>?');
			$stmt->bindParam(1,$email);
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
	
	
	function authenticate($email,$password)
	{
		$password = MD5($password);
		try
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM [USER] WHERE EMAIL=? AND PASSWORD=?');
			$stmt->bindParam(1,$email);
			$stmt->bindParam(2,$password);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				(new LOGS())->save($_SESSION['email'],$_SERVER['REMOTE_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'USER','AUTHENTICATE','The user logged in successfuly');

				
				return new USER($v['ID']);
				break;
			}
			(new LOGS())->save($_SESSION['email'],$_SERVER['REMOTE_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'USER','AUTHENTICATE','Authentication failed.');
			return false;
		}catch(Exception $e)
		{
			return false;
		}
	}
	
	
	function getUsers()
	{
		try
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM [USER]');
			$stmt->execute();
			$usersArray = array();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				$user = new USER();
				$user->id = $v['ID'];
				$user->email = $v['EMAIL'];
				$user->firstName = $v['FIRSTNAME'];
				$user->lastName = $v['LASTNAME'];
				$user->status = $v['STATUS'];
				$user->regDate = $v['REGDATE'];
				$usersArray[] =$user;
			}
			return $usersArray;
		}catch(Exception $e)
		{
			return false;
		}
	}
	
	function delete($id)
	{
			try
			{
				global $Myconnection;
				$stmt = $Myconnection->prepare('DELETE FROM [USER] WHERE ID=?');
				$stmt->bindParam(1,$id);
				$stmt->execute();
				(new LOGS())->save($_SESSION['email'],$_SERVER['REMOTE_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'USER','DELETE',json_encode($_POST));
				return true;
			}catch(Exception $e)
			{
				if(strpos($e->getMessage(),'Integrity constraint'))
				{
				
				echo  '<div class="card bd-0 mg-b-20 bg-danger-transparent alert p-0">
							<div class="card-body text-danger">
								<strong>Oh snap!</strong> 
								
								This user can not be deleted at the moment. because the user is attached to other system records. 
							
							</div>
						</div>';
				}
				return false;
			}
	}
	

}
?>