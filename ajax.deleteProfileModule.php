 <?php
 
	  session_start();
	  require_once("context.php");
	  require_once("classes/class.profilemodules.php");
	   
	 if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		 die();
	 }
 
	  if($_SERVER['REQUEST_METHOD']=="POST")
	  {
		  extract($_POST);
		  $pro = new PROFILEMODULES();
		  $count = 1;
		  if($pro->delete($id))
		  {
			   echo 'Profile Module deleted';
		  }
		  else
		  {
			  echo 'Something went wrong, please try again later.';
		  }
	  }
  
  ?>