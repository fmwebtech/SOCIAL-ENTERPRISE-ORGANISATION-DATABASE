<?php

require_once('classes\class.Product.php');

if ($_SERVER['REQUEST_METHOD']=='POST')
{
extract($_POST);

if($myProduct->getProduct($seoId))
{
    echo 'Product Has Been Retrived !!';
}
 
else
 {
      echo 'Product Not Retrived   ';
 }

} 

else 
{
    echo 'Oops No connection !!';
}
