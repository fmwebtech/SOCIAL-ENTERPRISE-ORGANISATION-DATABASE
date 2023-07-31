<?php
session_start();
require_once('classes\class.Service.php');

if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		 die();
	 }

$modifiedBy=$_SESSION['email'];
if ($_SERVER['REQUEST_METHOD']=='POST')
{
extract($_POST);
 $myservice = new SERVICES();

if($myservice->edit($id, $seoId,$name,$currency,$price,$modifiedBy))
{
    echo 'Service Has Been Edtied !!';
}
 
else
 {
      echo 'service Not Been Edited  !!  ';
 }

} 

else 
{
    echo 'Oops No connection !!';
}
