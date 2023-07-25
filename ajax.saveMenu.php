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
	  if(!isset($_POST['id']))
	  {
		 if($md->save($name,$url,$parentId,$icon,$ordering))
		  {
			   echo 'Menu saved';
		  }
		  else
		  {
			  echo 'Something went wrong, please try again later.';
		  }
	  }
	  else
	  {
		  if($md->edit($id,$name,$url,$parentId,$icon,$ordering))
		  {
			   echo 'Menu saved';
		  }
		  else
		  {
			  echo 'Something went wrong, please try again later.';
		  } 
	  }
  }
  
  ?>