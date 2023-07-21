<?php

require_once('classes\class.Service.php');

if ($_SERVER['REQUEST_METHOD']=='POST')
{
extract($_POST);

if($myProduct->getService($seoId))
{
    echo 'Service Has Been Retrived  !!';
}
 
else
 {
      echo 'service Not Retrived !!  ';
 }

} 

else 
{
    echo 'Oops No connection !!';
}
