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
	  $pr = new PROFILE($id);
	  echo  json_encode($pr);
  }
  
  ?>