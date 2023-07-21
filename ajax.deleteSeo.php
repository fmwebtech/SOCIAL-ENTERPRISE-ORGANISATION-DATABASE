<?php
require_once('classes\class.seo.php');

if($SERVER['REQUEST_METHOD']=='POST')
{

extract($_POST);
$mySeo = new SEO();
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