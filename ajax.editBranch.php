<?php
session_start();
require_once('classes\class.branch.php');




if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		 die();
	 }



if($_SERVER['REQUEST_METHOD']=='POST')
{
    extract($_POST);

    $mybranch = new BRANCH();

    if($mybranch->edit($id,$seoId,$countryId,$name,$address,$modifiedBy,$status))
    {
         echo 'Branch has been Edited';
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