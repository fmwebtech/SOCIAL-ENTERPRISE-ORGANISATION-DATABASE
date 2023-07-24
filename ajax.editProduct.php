<?php

require_once('classes\class.Product.php');

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
