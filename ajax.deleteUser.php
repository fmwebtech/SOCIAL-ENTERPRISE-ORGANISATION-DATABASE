 <?php
 
	  session_start();
	  require_once("classes/class.user.php");
	   
	 if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		 die();
	 }
 
	  if($_SERVER['REQUEST_METHOD']=="POST")
	  {
		  extract($_POST);
		  $user = new USER();
		  $count = 1;
		  if($user->delete($id))
		  {
			   echo 'User deleted';
		  }
		  else
		  {
			  echo 'Something went wrong, please try again later.';
		  }
	  }
  
  ?>