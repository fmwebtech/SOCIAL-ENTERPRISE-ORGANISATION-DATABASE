<?php
session_start();
require_once('classes\class.seoCountry.php');
if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		 die();
     }

if($_SERVER['REQUEST_METHOD']=='POST')
{

extract($_POST);
$myseoCountry = new seoCountry();
if($myseoCountry->save($countryId, $seoId))
{
    echo'Saved';
}

else
{

    echo 'Not saved  Something Went Wrong';
}
}

?>