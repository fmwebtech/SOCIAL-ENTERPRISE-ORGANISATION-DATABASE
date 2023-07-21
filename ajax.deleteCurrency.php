<?php
require_once('classes\class.seo.php');

if($SERVER['REQUEST_METHOD']=='POST')
extract($_POST);
$myCurrency = new CURRENCY();
if($mySeo->delete($id))
{
    echo'Edit Successfully';
}

else
{

    echo 'Not saved, Something Went Wrong'
}

?>