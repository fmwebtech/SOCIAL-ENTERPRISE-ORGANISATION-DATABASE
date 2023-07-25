<?php
session_start();
require_once('classes/class.seo.php');
if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		 die();
	 }

if($_SERVER['REQUEST_METHOD']=='POST')
{
extract($_POST);
$mySeo = new  SEO();
if($mySeo->save($name,$governance,$incomePerAnnum,$primaryCountry, $expenditurePerAnnum, $countryFounded, $established, $hqCountry,$createdBy,$ownership))
{
    echo'The Company Has Been Added';
}

else
{

    echo 'Not saved, Something Went Wrong';
}
}

?>