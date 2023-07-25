<?php

	require_once("classes/class.module.php");	
	require_once("classes/class.logs.php");
	require_once("classes/class.userprofiles.php");
	require_once("classes/class.profilemodules.php");
	
	class AUTHORIZATION
	{
	
		var $url;
		var $userId;
		
		function __construct($userId,$url)
		{
			
			$this->url = $url;
			$this->userId = $userId;
			
		}
		
		function authorize()
		{
			$userProfiles = (new USERPROFILES())->getUserProfiles($this->userId);
			$pm = new PROFILEMODULES();	
			$mod = (new MODULE())->getModuleByURL($this->url);
			$found = false;
			foreach($userProfiles as $iprfl)
			{
				if($pm->isMyModule($iprfl->profileId,$mod->id))
				{
					$found = true;
					break;
				}
			}
			return $found;
		}
		
	}
	
?>