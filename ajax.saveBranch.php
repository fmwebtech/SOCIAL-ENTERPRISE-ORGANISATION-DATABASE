<?php

require_once('classes\class.branch.php');
if($_SERVER['REQUEST_METHOD']=='POST')
{
    extract($_POST);

    $mybranch = new BRANCH();

    if($mybranch->save($seoId,$countryId,$name,$address,$createdBy,$modifiedBy))
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