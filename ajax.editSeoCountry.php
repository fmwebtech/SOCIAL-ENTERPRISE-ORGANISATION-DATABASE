<?php
require_once('classes\class.seoCountry.php');

if($SERVER['REQUEST_METHOD']=='POST')
extract($_POST);
$myCurrency = new CURRENCY();
if($myseoCountry->edit($id, $countryId, $seoId, $status, $modifiedBy))
{
    echo'Edit Sucessfully';
}

else
{

    echo 'Not saved, Something Went Wrong'
}

?>