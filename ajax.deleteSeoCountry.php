<?php
require_once('classes\class.seoCountry.php');

if($_SERVER['REQUEST_METHOD']=='POST')
{
extract($_POST);
$myseoCountry = new seoCountry();
if($myseoCountry-> delete($id))
{
    echo'Done';
}

else
{

    echo 'Not Deleted, Something Went Wrong';
}
}
?>