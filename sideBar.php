<?php
	@session_start();
	include_once("classes/class.user.php");
	include_once("classes/class.module.php");
	include_once("classes/class.profile.php");
	include_once("classes/class.userprofiles.php");
	include_once("classes/class.profilemodules.php");
	$user = new USER($_SESSION['id']);
?>
	
	<style>
.collapsible {

}

.active, .collapsible:hover {
  
}

.collapsible:after {


}

.active:after {

  
}

.content {

  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
  
}
</style>


<!--Start sidebar-wrapper-->
    <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
     <div class="brand-logo">
      <a href="index.php">
       <!-- <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon"> -->
       <h5 class="logo-text">SEOD</h5>
     </a>
   </div>
   <ul class="sidebar-menu do-nicescrol">
    <li class="sidebar-header">MAIN NAVIGATION</li>
 
 <?php
						
						
						
						//get user profiles
						// get first level menues of user in every profile
						// get user sub menues on each menu in very profile
						
						$up = new USERPROFILES();
						$pm = NEW PROFILEMODULES();
						$addedMenus = array();
						$addedChildMenus = array();
						
						$userProfiles = $up->getUserProfiles($user->id);
						
						foreach($userProfiles as $prfl)
						{
							$profileModules = $pm->getProfileModules($prfl->profileId);
							foreach($profileModules as $prflMdl)
							{
								$mdl = new MODULE($prflMdl->moduleId);
								if(!in_array($mdl->id,$addedMenus)){
								 $addedMenus[]=$mdl->id;
								}else
								{
									continue;
								}
								
								if(($mdl->parentId==0) && ($mdl->parentId!=null))
								{
									 echo 
									    '<li class="slide collapsible" onclick="toglethis('.$mdl->id.')">
												<a class="side-menu__item side-menu__label" data-toggle="slide" href="#">
													<small><i class="side-menu__icon '.$mdl->icon.'"></i></small>
													<span class="side-menu__label">'.$mdl->name.'</span>
													<i  id="'.$mdl->id.'i" class=""></i>
												</a><div id="'.$mdl->id.'" class="content"><div>';
											foreach($mdl->getChildModules($mdl->id) as $item)
											{
												
												foreach($userProfiles as $iprfl)
												{
												
													if($pm->isMyModule($iprfl->profileId,$item->id))
													{
														if(!in_array($item->id,$addedChildMenus) )
														{
															$addedChildMenus[]=$item->id;
														}
														else
														{
															continue;
														}
															echo '<ul class="">
																	<li><a class="slide-item" href="'.$item->url.'"><i class="'.$item->icon.'"></i><span style="padding-left:5px;"></span>'.$item->name.'</a></li>
																</ul>
														';
													}
												}
												
											}
										
										echo '</div></div></li>';
								}
							}
						}
					?>
 
 
 


    </ul>


<script>
function toglethis(id)
{
	
	var cont  = document.getElementById(id+"");
	var conti  = document.getElementById(id+"i");
	//cont.style.maxHeight= 0;
	
	if(cont.style.maxHeight=='0px' || cont.style.maxHeight=="")
	{
		
		//conti.classList.toggle("fa-chevron-down");
		cont.style.maxHeight = cont.scrollHeight+'px';
	}
	else
	{
		//conti.classList.toggle("fa-chevron-right");
		//conti.classList.toggle("fa-chevron-right");
		cont.style.maxHeight = '0px';
	}
	
	//cont.style.maxHeight = '10';
}
</script>
  </div>