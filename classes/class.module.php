<?php
require_once('settings/connectionsetting.php');
require_once("classes\class.logs.php");
class MODULE{
	
	
var $id;
var $name;
var $url;
var $parentId;
var $ordering;
var $icon;
var $status;
var $regDate;



	function __construct($id=NULL)
	{
		if($id==NULL){
			//do nothing
		}else
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM [MODULE] WHERE ID=?');
			$stmt->bindParam(1,$id);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{ // 			
				$this->id = $v['ID'];
				$this->name = $v['NAME'];
				$this->url = $v['URL'];
				$this->parentId = $v['PARENTID'];
				$this->status = $v['STATUS'];
				$this->icon = $v['ICON'];
				$this->ordering = $v['ORDERING'];
				$this->regDate = $v['REGDATE'];
			}
		}
	}
	
	function save($name,$url,$parentId,$icon,$ordering)
	{
			if($this->moduleExists($name,$url,$parentId))
			{
				echo 'The module you are trying to save is already defined, Please enter a different module name';
				return false;
			}else
			{
				//do nothing
			}
		try
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare("INSERT INTO [MODULE](NAME,URL,PARENTID,ICON,ORDERING,STATUS) 
											VALUES(?,?,?,?,?,'new')");
			$stmt->bindParam(1,$name);
			$stmt->bindParam(2,$url);
			$stmt->bindParam(3,$parentId);
			$stmt->bindParam(4,$icon);
			$stmt->bindParam(5,$ordering);
			$stmt->execute();
			(new LOGS())->save($_SESSION['email'],$_SERVER['HTTP_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'MODULE','SAVE',json_encode($_POST));
			return true;
		}catch(Exception $e)
		{
			return false;
		}
	}
	
	
	function edit($id,$name,$url,$parentId,$icon,$ordering,$status=null)
	{
			if(!$this->safeToEdit($id,$name,$url,$parentId))
			{
				echo 'You cant change this module to the values selected, there is already another module like it.';
				return false;
			}else{
				//do nothing
			}
			if($status==null)
			{
				$status = 'active';
			}
		try
		{
			global $Myconnection;
			$stmt = $Myconnection->prepare('UPDATE [MODULE] SET NAME=?,URL=?,PARENTID=?,ICON=?,ORDERING=?,STATUS=? WHERE ID=?');
			$stmt->bindParam(1,$name);
			$stmt->bindParam(2,$url);
			$stmt->bindParam(3,$parentId);
			$stmt->bindParam(4,$icon);
			$stmt->bindParam(5,$ordering);
			$stmt->bindParam(6,$status);
			$stmt->bindParam(7,$id);
			$stmt->execute();
			(new LOGS())->save($_SESSION['email'],$_SERVER['HTTP_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'MODULE','EDIT',json_encode($_POST));
			return true;
		}catch(Exception $e)
		{
			return false;
		}
	}
	
	
	
	function moduleExists($name,$url){
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM [MODULE] WHERE NAME=? AND URL=?');
			$stmt->bindParam(1,$name);
			$stmt->bindParam(2,$url);
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
	
	
	function safeToEdit($id,$name,$url){
		try{
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM [MODULE] WHERE NAME=? AND URL=? AND ID<>?');
			$stmt->bindParam(1,$name);
			$stmt->bindParam(2,$url);
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
	
	
	function getModules()
	{
		try{
			$moduleArray = array();
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM [MODULE]');
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				$module = new MODULE();
				$module->id = $v['ID'];
				$module->name = $v['NAME'];
				$module->url = $v['URL'];
				$module->parentId = $v['PARENTID'];
				$module->icon = $v['ICON'];
				$module->ordering = $v['ORDERING'];
				$module->status = $v['STATUS'];
				$module->regDate = $v['REGDATE'];
				$moduleArray[] = $module;
			}
			return $moduleArray;
		}catch(Exception $e)
		{
			return false;
		}
	}
	
	function getModuleByURL($url)
	{
		try
		{
			$module=null;
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM [MODULE] WHERE URL=?');
			$stmt->bindParam(1,$url);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				$module = new MODULE();
				$module->id = $v['ID'];
				$module->name = $v['NAME'];
				$module->url = $v['URL'];
				$module->parentId = $v['PARENTID'];
				$module->icon = $v['ICON'];
				$module->ordering = $v['ORDERING'];
				$module->status = $v['STATUS'];
				$module->regDate = $v['REGDATE'];
				break;
			}
			return $module;
		}catch(Exception $e)
		{
			return false;
		}
	}
	
	function getChildModules($parentId)
	{
		try{
			$moduleArray = array();
			global $Myconnection;
			$stmt = $Myconnection->prepare('SELECT * FROM [MODULE] WHERE PARENTID=?');
			$stmt->bindParam(1,$parentId);
			$stmt->execute();
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$results = $stmt->fetchAll();
			foreach($results as $k=>$v)
			{
				$module = new MODULE();
				$module->id = $v['ID'];
				$module->name = $v['NAME'];
				$module->url = $v['URL'];
				$module->parentId = $v['PARENTID'];
				$module->status = $v['STATUS'];
				$module->icon = $v['ICON'];
				$module->ordering = $v['ORDERING'];
				$module->regDate = $v['REGDATE'];
				$moduleArray[] =$module;
			}
			return $moduleArray;
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
				$stmt = $Myconnection->prepare('DELETE FROM [MODULE] WHERE ID=?');
				$stmt->bindParam(1,$id);
				$stmt->execute();
				(new LOGS())->save($_SESSION['email'],$_SERVER['HTTP_HOST']."(".$_SERVER['REMOTE_ADDR'].")",'MODULE','DELETE',json_encode($_POST));
				return true;
			}catch(Exception $e)
			{
				if(strpos($e->getMessage(),'Integrity constraint'))
				{
				
				echo  '<div class="card bd-0 mg-b-20 bg-danger-transparent alert p-0">
							<div class="card-body text-danger">
								<strong>Oh snap!</strong> 
								
								This Module can not be deleted at the moment. Because the Module is attached to other system records. 
							
							</div>
						</div>';
				}
				return false;
			}
	}
	

}
?>