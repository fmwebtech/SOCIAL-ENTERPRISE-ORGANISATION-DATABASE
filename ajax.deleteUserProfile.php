 <?php
 
	  session_start();
	  require_once("context.php");
	  require_once("classes/class.userprofiles.php");
	   
		 if(!isset($_SESSION['email'])) //check if this request is sent while logged in
		 {
			 echo 'request failed';
			 die();
		 }
 
	  if($_SERVER['REQUEST_METHOD']=="POST")
	  {
		  extract($_POST);
		  $pro = new USERPROFILES();
		  $count = 1;
		  if($pro->delete($id))
		  {
			   echo 'User Profile deleted';
		  }
		  else
		  {
			  echo 'Something went wrong, please try again later.';
		  }
	  }
  
  ?>