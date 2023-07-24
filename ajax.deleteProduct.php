<?php

require_once('classes\class.Product.php');

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
