<?php

require_once('classes\class.branch.php');
if($_SERVER['REQUEST_METHOD']=='POST')
{
    extract($_POST);

    $mybranch = new BRANCH();

    if($mybranch->getBranch($seoId,$country))
    {
         echo 'Branch has been Retrived';
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