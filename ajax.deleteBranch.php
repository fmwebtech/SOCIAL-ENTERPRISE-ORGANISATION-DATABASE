<?php
session_start();
require_once('classes\class.branch.php');
require_once('classes\class.seoCountry.php');


if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		die();
	}

if($_SERVER['REQUEST_METHOD']=='POST')
{
    extract($_POST);

    $mybranch = new BRANCH($id);

    if($mybranch->delete($id))
    {

        if(sizeof($mybranch->getBranch($mybranch->seoId,$mybranch->countryId))==0)
        {
           $mySeoCountry =  (new SEOCOUNTRY())->getSeoCountryBySeoIdAndCountryId($mybranch->seoId,$mybranch->countryId)[0];
           $mySeoCountry->delete($mySeoCountry->id);
        }else
        {
           
        }
               

            echo 'Branch has been Deleted';
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