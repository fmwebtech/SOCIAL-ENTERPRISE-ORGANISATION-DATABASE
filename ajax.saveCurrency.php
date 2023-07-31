<?php
session_start();
require_once('classes\class.Currency.php');
if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		 die();
	 }

if($_SERVER['REQUEST_METHOD']=='POST')
{
    extract($_POST);
$myCurrency = new CURRENCY();
$createdBy=$_SESSION['email'];
//echo $_SESSION['email'];
if($myCurrency->save($name,$code, $createdBy,))
{
    echo 'The Currency Has Been Added';
}
else
{
    echo 'Not saved, Something Went Wrong';
}
}



?>