<?php
session_start();
require_once('classes\class.currency.php');
if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		 die();
	 }

if($_SERVER['REQUEST_METHOD']=='POST')
{
extract($_POST);
$myCurrency = new CURRENCY();
$modifiedBy=$_SESSION['email'];
if($myCurrency->edit($id, $name,$code, $modifiedBy,))
{
    echo'Edit Successfully';
}

else
{

    echo 'OOPS, Something Went Wrong';
}
}
?>