<?php
 session_start();
require_once('classes\class.country.php');




    if(!isset($_SESSION['email']))
    {
        echo 'request failed';
		 die;
    }


if($_SERVER['REQUEST_METHOD']=='POST')
{
    
    extract($_POST);

    $mycountry = new COUNTRY();
    $fetchedcountry= array();

    if($fetchedcountry = $mycountry->getCountry())
    {
       
       
        foreach($fetchedcountry as $country)
        {
           
                echo '<tr><td>'.$country->name.'</td> <td>'.$country->code.'</td> </tr>';
        }        
    }
    
    else
    {
        echo 'Ooops something went wrong';
    }
   

}
else
{
    echo 'Ooops something went wrong';

}






?>