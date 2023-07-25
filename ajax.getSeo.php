<?php
session_start();
require_once('classes\class.Seo.php');
if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		 die();
	 }
if($_SERVER['REQUEST_METHOD']=='POST')
{
    extract($_POST);

    $mySeo= new Seo();
    $fetchedSeo= array();

    $fetchedSeo=$mySeo->getSeo();
    
        foreach($fetchedSeo as $seo)
        {
                echo '<tr><td>'.$seo->name.'</td> <td>'.$seo->createdBy.'</td> </tr>';
        }       
   

}
else
{
    echo 'Ooops something went wrong';

}






?>