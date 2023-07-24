<?php
require_once('classes\class.seoCountry.php');

if($_SERVER['REQUEST_METHOD']=='POST'){
    
extract($_POST);
$myseoCountry = new seoCountry();
if($myseoCountry->edit($id, $countryId, $seoId, $status, $modifiedBy))
{
    echo'Edit Sucessfully';
}

else
{

    echo 'Not saved, Something Went Wrong';
}
}

?>