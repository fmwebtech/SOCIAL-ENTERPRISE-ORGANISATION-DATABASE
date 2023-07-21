<?php

require_once('classes\class.country.php');
if($_SERVER['REQUEST_METHOD']=='POST')
{
    extract($_POST);

    $mycountry = new COUNTRY();

    if($mycountry->delete($id))
    {
         echo 'Country Deleted';
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