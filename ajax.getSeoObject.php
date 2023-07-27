<?php
 session_start();
require_once('classes\class.seo.php');




    if(!isset($_SESSION['email']))
    {
        echo 'request failed';
		 die;
    }


if($_SERVER['REQUEST_METHOD']=='POST')
{
    
    extract($_POST);

    $mySeo= new SEO($id);
    echo json_encode($mySeo);
    
   
}
else
{
    echo 'Ooops something went wrong';

}






?>