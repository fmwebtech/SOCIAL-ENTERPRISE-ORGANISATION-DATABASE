<?php
	@session_start();
	include_once("classes/class.user.php");
	include_once("classes/class.module.php");
	include_once("classes/class.profile.php");
	include_once("classes/class.userprofiles.php");
	include_once("classes/class.profilemodules.php");
	$user = new USER($_SESSION['id']);
?>

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
									    '<li class="slide">
												<a class="side-menu__item side-menu__label" data-toggle="slide" href="#">
													<small><i class="side-menu__icon '.$mdl->icon.'"></i></small>
													<span class="side-menu__label">'.$mdl->name.'</span>
													<i class="angle fa fa-chevron-down"></i>
												</a>';
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
										
										echo '</li>';
								}
							}
						}
					?>
 
 
 
<!--    <li>
      <a href="#" onclick="goTo('Views/SEO_table.php' , 'mainContent')" >
        <i class="zmdi zmdi-view-dashboard"></i> <span>Social Enterprises</span>
      </a>
    </li>


    <li>
      <a href="#">
        <i class="zmdi zmdi-format-list-bulleted"></i> <span>Services</span>
      </a>
    </li>

    <li>
      <a href="#">
        <i class="zmdi zmdi-format-list-bulleted"></i> <span>Products</span>
      </a>
    </li>

    <li>
      <a href="#" onclick="goTo('Views/users.php' , 'mainContent')">
        <i class="zmdi zmdi-male-female"></i> <span>Users</span>
      </a>
    </li>

      <!-- 
      <li>
        <a href="calendar.html">
          <i class="zmdi zmdi-calendar-check"></i> <span>Calendar</span>
          <small class="badge float-right badge-light">New</small>
        </a>
      </li>
   
    <li>
      <a href="#" onclick="goTo('Views/profile.php' , 'mainContent')">
        <i class="zmdi zmdi-face"></i> <span>Profile</span>
      </a>
    </li>


     <li>
      <a href="#" onclick="goTo('Views/home.php' , 'mainContent')">
        <i class="zmdi zmdi-face"></i> <span>Reports</span>
      </a>
    </li>



    <li>
      <a href="login.html" target="_blank">
        <i class="zmdi zmdi-lock"></i> <span>Login</span>
      </a>
    </li>

    <li>
      <a href="#" target="_blank">
        <i class="zmdi zmdi-lock"></i> <span>Log out</span>
      </a>
    </li>
 -->
      <!--  <li>
        <a href="register.html" target="_blank">
          <i class="zmdi zmdi-account-circle"></i> <span>Registration</span>
        </a>
      </li> -->

     <!--  <li class="sidebar-header">LABELS</li>
      <li><a href="javaScript:void();"><i class="zmdi zmdi-coffee text-danger"></i> <span>Important</span></a></li>
      <li><a href="javaScript:void();"><i class="zmdi zmdi-chart-donut text-success"></i> <span>Warning</span></a></li>
      <li><a href="javaScript:void();"><i class="zmdi zmdi-share text-info"></i> <span>Information</span></a></li> -->

    </ul>

  </div>