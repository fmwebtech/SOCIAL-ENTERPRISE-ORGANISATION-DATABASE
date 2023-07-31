<?php
 session_start();
require_once('classes\class.country.php');




    if(!isset($_SESSION['email']))
    {
        echo 'request failed';
		die;
    }


if($_SERVER['REQUEST_METHOD']=='POST')
{
    
    extract($_POST);

    $mycountry = new COUNTRY($id);
    echo json_encode($mycountry);
    
   
}
else
{
    echo 'Ooops something went wrong';

}






?>