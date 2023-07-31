<?php
session_start();
require_once('classes\class.logs.php');

if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		die();
	}





if($_SERVER['REQUEST_METHOD']=='POST')
{
    extract($_POST);

    $mylogs = new LOGS();

    if($mylogs->save($user, $computer, $class, $function, $data))
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