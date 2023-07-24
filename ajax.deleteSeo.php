<?php
require_once('classes\class.Seo.php');

if($SERVER['REQUEST_METHOD']=='POST')
{

extract($_POST);
$mySeo = new Seo();
if($mySeo->delete($id))
{
    echo'Deleted';
}
else
{

    echo 'Not saved, Something Went Wrong'
}
}

?>