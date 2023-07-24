<?php

require_once('classes\class.Seo.php');
if($_SERVER['REQUEST_METHOD']=='POST')
{
    extract($_POST);

    $mySeo= new Seo();
    $fetchedSeo= array();

    $fetchedSeo=$mySeo->getSeo();
    
        foreach($fetchedSeo as $seo)
        {
                echo '<tr><td>'.$seo->name.'</td> <td>'.$seo->createdBy.'</td> </tr>';
        }       
   

}
else
{
    echo 'Ooops something went wrong';

}






?>