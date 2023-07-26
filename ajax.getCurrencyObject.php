<?php
session_start();
require_once('classes\class.Currency.php');
if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		 die();
	 }
if($_SERVER['REQUEST_METHOD']=='POST')
{
    extract($_POST);
    $myCurrency= new CURRENCY($id);
    echo json_encode($myCurrency);
}
else
{
    echo 'Ooops something went wrong';

}






?>