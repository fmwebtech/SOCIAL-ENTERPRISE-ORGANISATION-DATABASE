<?php

require_once('classes\class.branch.php');
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