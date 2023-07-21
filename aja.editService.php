<?php

require_once('classes\class.Service.php');

if ($_SERVER['REQUEST_METHOD']=='POST')
{
extract($_POST);

if($myProduct->edit($id, $seoId,$name,$currency,$price,$status,$modifiedBy))
{
    echo 'Service Has Been Edtied !!';
}
 
else
 {
      echo 'service Not Been Edited  !!  ';
 }

} 

else 
{
    echo 'Oops No connection !!';
}
