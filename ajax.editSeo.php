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
$mySeo = new SEO();
if($mySeo->edit($id, $name, $established, $ownership, $primaryCountry, $modifiedBy, $governance, $hqCountry, $countryFounded, $incomePerAnnum, $expenditurePerAnnum, $status))
{
    echo'Edit Sucessfully';
}

else
{

    echo 'oops, Something Went Wrong';
}
}
?>