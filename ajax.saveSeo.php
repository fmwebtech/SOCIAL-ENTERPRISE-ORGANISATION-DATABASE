<?php
require_once('classes/class.seo.php');

if($_SERVER['REQUEST_METHOD']=='POST')
{
extract($_POST);
$mySeo = new  SEO();
if($mySeo->save($name,$governance,$incomePerAnnum,$primaryCountry, $expenditurePerAnnum, $countryFounded, $established, $hqCountry,$createdBy,$ownership))
{
    echo'The Company Has Been Added';
}

else
{

    echo 'Not saved, Something Went Wrong';
}
}

?>