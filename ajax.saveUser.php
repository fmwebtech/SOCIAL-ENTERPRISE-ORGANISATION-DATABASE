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
	  if(!isset($_POST['id']))
	  {
		  $password = md5(time());
		 if((new USER())->save($firstName,$lastName,$email,$password))
		  {
			  
			   echo 'User saved';
		  }
		  else
		  {
			  echo 'Something went wrong, please try again later.';
		  }
	  }
	  else
	  {
		  if((new USER())->edit($id,$firstName,$lastName,$email,"edited"))
		  {
			   echo 'User saved';
		  }
		  else
		  {
			  echo 'Something went wrong, please try again later.';
		  } 
	  }
  }
  
  ?>