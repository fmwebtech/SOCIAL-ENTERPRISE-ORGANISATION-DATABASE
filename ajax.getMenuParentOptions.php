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
	   echo '<option value="0">No Parent</option>';
	  foreach($md->getModules() as $mod)
	  {
		   echo '<option value="'.$mod->id.'">'.$mod->name.'</option>';
	  }
  }
  
  ?>