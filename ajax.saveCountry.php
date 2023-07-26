<?php
@session_start();
require_once('classes\class.country.php');


if(!isset($_SESSION['email']))
{
    echo 'request failed';
     die;
}


if($_SERVER['REQUEST_METHOD']=='POST')
{
    extract($_POST);
//print_r($_SERVER);
    $mycountry = new COUNTRY();
$createdBy=$_SESSION['email'];
    if($mycountry->save($name,$code,$createdBy))
    {
         echo 'Country has been Saved';
    }
    else
    {
        echo 'Ooops something went wrong';
    }

}






?>