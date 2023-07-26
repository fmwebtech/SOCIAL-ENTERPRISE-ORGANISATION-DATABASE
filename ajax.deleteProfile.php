 <?php
 
	  session_start();
	  require_once("classes/class.profile.php");
	   
	 if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		 die();
	 }
 
	  if($_SERVER['REQUEST_METHOD']=="POST")
	  {
		  extract($_POST);
		  if((new PROFILE())->delete($id))
		  {
			   echo 'Profile deleted';
		  }
		  else
		  {
			  echo 'Something went wrong, please try again later.';
		  }
	  }
  
  ?>