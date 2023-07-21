<?php

require_once('classes\class.Service.php');

if ($_SERVER['REQUEST_METHOD']=='POST')
{
extract($_POST);

if($myProduct->delete($id))
{
    echo 'Service Has Been Deleted !!';
}
 
else
 {
      echo 'service Not Been Deleted !!  ';
 }

} 

else 
{
    echo 'Oops No connection !!';
}
