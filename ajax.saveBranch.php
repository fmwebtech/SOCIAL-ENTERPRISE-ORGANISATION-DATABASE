<?php
session_start();
require_once('classes\class.branch.php');
require_once('classes\class.seoCountry.php');


if(!isset($_SESSION['email'])) {
    echo 'request failed';
     die();
}



if($_SERVER['REQUEST_METHOD']=='POST')
{
    extract($_POST);

    $mybranch = new BRANCH();
    $createdBy = $_SESSION['email'];
    $myseoCountry = new seoCountry();
    $myseoCountry->save($countryId, $seoId);
    if($mybranch->save($seoId,$countryId,$name,$address,$createdBy))
    {
        
         echo 'Branch has been saved';
    }
    else
    {
        echo 'Ooops something went wrong';
    }



}
else
{
    echo 'Ooops something went wrong';

}






?>