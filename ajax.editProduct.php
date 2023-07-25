<?php
session_start();
require_once('classes\class.Product.php');

if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		 die();
	 }

if ($_SERVER['REQUEST_METHOD']=='POST')
{
extract($_POST);

$myeditProduct = new ProductS();

if($myProduct->edit($name,$currency,$seoId,$price,$createdBy))
{
    echo 'Product Has Been Edited !!';
}
 
else
 {
      echo 'Product Not Edited   ';
 }

} 

else 
{
    echo 'Oops No connection !!';
}
