<?php
session_start();
require_once('classes\class.Service.php');

if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		die();
	}

if ($_SERVER['REQUEST_METHOD']=='POST')
{
extract($_POST);

$myservice = new SERVICES();

if($myservice->delete($id))
{
    echo 'Service Has Been Deleted !!';
}
 
else
 {
      echo 'service Not Been Deleted !!  ';
 }

} 

else 
{
    echo 'Oops No connection !!';
}
