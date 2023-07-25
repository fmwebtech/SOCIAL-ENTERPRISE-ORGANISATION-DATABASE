 <?php
 session_start();
 require_once("context.php");
 require_once("classes/class.profile.php");
  
 if(!isset($_SESSION['email'])) //check if this request is sent while logged in
 {
	 echo 'request failed';
	 die();
 }
 
  if($_SERVER['REQUEST_METHOD']=="POST")
  {
	  extract($_POST);
		  $pro = new PROFILE();
	  if(!isset($_POST['id']))
	  {
		 if($pro->save($name))
		  {
			   echo 'Profile saved';
		  }
		  else
		  {
			  echo 'Something went wrong, please try again later.';
		  }
	  }
	  else
	  {
		  if($pro->edit($id,$name))
		  {
			    echo 'Profile saved';
		  }
		  else
		  {
			  echo 'Something went wrong, please try again later.';
		  } 
	  }
  }
  
  ?>