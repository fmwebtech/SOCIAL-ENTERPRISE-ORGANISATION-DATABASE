<?php
session_start();
require_once('classes\class.seo.php');
if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		 die();
	 }

if($_SERVER['REQUEST_METHOD']=='POST')
{
extract($_POST);
$myCurrency = new CURRENCY();
if($mySeo->delete($id))
{
    echo'Edit Successfully';
}

else
{

    echo 'Not saved, Something Went Wrong';
}
}

?>