 <?php
 session_start();
 require_once("classes/class.profilemodules.php");
  
 if(!isset($_SESSION['email'])) //check if this request is sent while logged in
 {
	 echo 'request failed';
	 die();
 }
 
  if($_SERVER['REQUEST_METHOD']=="POST")
  {
	  extract($_POST);
		  $pm = new PROFILEMODULES();
	  if(!isset($_POST['id']))
	  {
		 if($pm-> save($profileId,$moduleId))
		  {
			   echo 'Profile Module saved';
		  }
		  else
		  {
			  echo 'Something went wrong, please try again later.';
		  }
	  }
	  else
	  {
		  if($pm->edit($id,$profileId,$moduleId))
		  {
			    echo 'Profile Module saved';
		  }
		  else
		  {
			  echo 'Something went wrong, please try again later.';
		  } 
	  }
  }
  
  ?>