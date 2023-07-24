<?php

require_once('classes\class.Product.php');

if ($_SERVER['REQUEST_METHOD']=='POST')
{
    
extract($_POST);

$myProduct = new PRODUCTS();

if($myProduct->save($name,$currency,$seoId,$price,$createdBy))
{
    echo 'Product Has Been Saved !!';
}
 
else
 {
      echo 'Product Not Saved  ';
 }

} 

else 
{
    echo 'Oops No connection !!';
}





?>