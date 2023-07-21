<?php
require_once('classes\class.seoCountry.php');

if($SERVER['REQUEST_METHOD']=='POST')
extract($_POST);
$myseoCountry = new seoCountry();
if($myseoCountry->save($countryId, $seoId))
{
    echo'Saved';
}

else
{

    echo 'Not saved, Something Went Wrong'
}

?>