<?php
require_once('classes\class.currency.php');

if($_SERVER['REQUEST_METHOD']=='POST')
{
extract($_POST);
$myCurrency = new CURRENCY();
if($myCurrency->edit($id, $name, $modifiedBy, $status))
{
    echo'Edit Successfully';
}

else
{

    echo 'OOPS, Something Went Wrong';
}
}
?>