<?php

require_once('classes\class.Currency.php');
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