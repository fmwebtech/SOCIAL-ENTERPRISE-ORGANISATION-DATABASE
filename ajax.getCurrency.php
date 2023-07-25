<?php
session_start();
require_once('classes\class.Currency.php');
if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		 die();
	 }
if($_SERVER['REQUEST_METHOD']=='POST')
{
    extract($_POST);

    $myCurrency= new CURRENCY();
    $fetchedCurrency= array();

    $fetchedCurrency=$myCurrency->getCurrency();
    
        foreach($fetchedCurrency as $currency)
        {
                echo '<tr><td>'.$currency->name.'</td> <td>'.$currency->status.'</td> </tr>';
        }       
   

}
else
{
    echo 'Ooops something went wrong';

}






?>