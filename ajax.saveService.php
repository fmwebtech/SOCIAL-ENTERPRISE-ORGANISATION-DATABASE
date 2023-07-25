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
$myservice =new SERVICES();

if($myservice->save($name,$currency,$seoId,$price,$createdBy))
{
    echo 'Service Has Been Saved sucessesfully !!';
}
 
else
 {
      echo 'service Not Been Saved !!  ';
 }

} 

else 
{
    echo 'Oops No connection !!';
}
