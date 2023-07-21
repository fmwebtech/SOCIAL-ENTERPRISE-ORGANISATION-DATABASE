<?php
require_once('classes\class.seo.php');

if($SERVER['REQUEST_METHOD']=='POST')
extract($_POST);
$mySeo = new SEO();
if($mySeo->edit($id, $name, $established, $ownership,$primaryCountry, $modifiedBy, $governance, $hqCountry, $countryFounded, $incomePerAnnum, $expenditurePerAnnum, $status))
{
    echo'Edit Sucessfully';
}

else
{

    echo 'Not saved, Something Went Wrong'
}

?>