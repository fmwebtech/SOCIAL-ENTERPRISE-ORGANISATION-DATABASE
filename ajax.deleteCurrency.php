<?php
session_start();
require_once('classes\class.currency.php');
if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		 die();
	 }

if($_SERVER['REQUEST_METHOD']=='POST')
{
extract($_POST);
$myCurrency = new CURRENCY();
if($myCurrency->delete($id))
{
    echo'Deleted';
}

else
{

    echo 'Opps, Something Went Wrong';
}
}

?>