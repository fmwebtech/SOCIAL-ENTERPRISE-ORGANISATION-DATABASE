<?php
require_once('classes\class.seo.php');

if($SERVER['REQUEST_METHOD']=='POST')
extract($_POST);
$myCurrency = new CURRENCY();
if($mySeo->save($name, $createdBy,))
{
    echo'The Currency Has Been Added';
}

else
{

    echo 'Not saved, Something Went Wrong'
}

?>