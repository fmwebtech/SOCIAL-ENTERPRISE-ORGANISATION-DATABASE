<?php
require_once('classes\class.currency.php');

if($SERVER['REQUEST_METHOD']=='POST')
extract($_POST);
$myCurrency = new CURRENCY();
if($myCurrency->edit($id, $name, $modifiedBy, $status))
{
    echo'Edit Successfully';
}

else
{

    echo 'Not saved, Something Went Wrong'
}

?>