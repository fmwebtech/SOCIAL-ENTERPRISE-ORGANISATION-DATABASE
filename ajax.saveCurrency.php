<?php
require_once('classes\class.Currency.php');

if($_SERVER['REQUEST_METHOD']=='POST')
{
    extract($_POST);
$myCurrency = new CURRENCY();
if($myCurrency->save($name, $createdBy,))
{
    echo 'The Currency Has Been Added';
}
else
{
    echo 'Not saved, Something Went Wrong';
}
}



?>