<?php

require_once('classes\class.logs.php');
if($_SERVER['REQUEST_METHOD']=='POST')
{
    extract($_POST);

    $mylogs = new LOGS();

    if($mylogs->getLogsByDateRange($startDate, $endDate))
    {
         echo 'Log has been Saved';
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