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

$myProduct = new PRODUCTS();

if($myProduct->delete($id))
{
    echo 'Product Deleted !!';
}
 
else
 {
      echo 'Product Not Deleted   ';
 }

} 

else 
{
    echo 'Oops No connection !!';
}
