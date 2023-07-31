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
    $count=1;
        foreach($fetchedCurrency as $currency)
        {
                echo '<tr> <td>'.$count.'</td><td>'.$currency->name.'</td> <td>'.$currency->code.'</td>

                <td><button onclick="editCurrency(\''.$currency->id.'\')" class="btn btn-success">
												<i class="zmdi zmdi-edit"></i> Edit </button>
											
												
												<button onclick="deleteCurrency(\''.$currency->id.'\')" class="btn btn-danger">
													<i class="zmdi zmdi-delete"></i> Delete  </button>
                                                    </td>
                                                    
                                                </tr>';
                $count++;
        }       
   

}
else
{
    echo 'Ooops something went wrong';

}






?>