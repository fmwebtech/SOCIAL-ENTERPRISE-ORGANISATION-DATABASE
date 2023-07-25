<?php
session_start();
require_once('classes\class.Seo.php');
if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		 die();
	 }

if($_SERVER['REQUEST_METHOD']=='POST')
{

extract($_POST);
$mySeo = new Seo();
if($mySeo->delete($id))
{
    echo'Deleted';
}
else
{

    echo 'Not saved, Something Went Wrong';
}
}

?>