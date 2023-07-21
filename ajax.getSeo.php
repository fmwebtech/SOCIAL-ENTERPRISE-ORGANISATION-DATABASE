<?php
require_once('classes\class.seo.php');

if($SERVER['REQUEST_METHOD']=='POST')
extract($_POST);
$mySeo = new SEO();
if($mySeo->getSeo($name))
{
    echo'Done';
}

else
{

    echo 'Not saved, Something Went Wrong'
}

?>