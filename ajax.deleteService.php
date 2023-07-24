<?php

require_once('classes\class.Service.php');

if ($_SERVER['REQUEST_METHOD']=='POST')
{
extract($_POST);

$myservice = new SERVICES();

if($myservice->delete($id))
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
