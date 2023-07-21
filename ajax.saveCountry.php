<?php

require_once('classes\class.country.php');
if($_SERVER['REQUEST_METHOD']=='POST')
{
    extract($_POST);

    $mycountry = new COUNTRY();

    if($mycountry->save($name,$code))
    {
         echo 'Country has been Saved';
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