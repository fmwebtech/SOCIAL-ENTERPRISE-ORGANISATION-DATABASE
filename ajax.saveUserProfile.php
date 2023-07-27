 <?php
 session_start();
 require_once("classes/class.userprofiles.php");
  
 if(!isset($_SESSION['email'])) //check if this request is sent while logged in
 {
	 echo 'request failed';
	 die();
 }
 
  if($_SERVER['REQUEST_METHOD']=="POST")
  {
	  extract($_POST);
		  $up = new USERPROFILES();
	  if(!isset($_POST['id']))
	  {
		 if($up-> save($userId,$profileId))
		  {
			   echo 'User Profile  saved';
		  }
		  else
		  {
			  echo 'Something went wrong, try again later.';
		  }
	  }
	  else
	  {
		  if($up->edit($id,$profileId,$userId))
		  {
			    echo 'User Profile saved';
		  }
		  else
		  {
			  echo 'Something went wrong, please try again later.';
		  } 
	  }
  }
  
  ?>