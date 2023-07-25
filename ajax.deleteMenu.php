 <?php
 
	  session_start();
	  require_once("context.php");
	  require_once("classes/class.module.php");
	   
	 if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		 die();
	 }
	 
	  if($_SERVER['REQUEST_METHOD']=="POST")
	  {
		  extract($_POST);
		  $md = new MODULE();
		  $count = 1;
		  if($md->delete($id))
		  {
			   echo 'Menu deleted';
		  }
		  else
		  {
			  echo 'Something went wrong, please try again later.';
		  }
	  }
  
  ?>