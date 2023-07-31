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
       
       $count=1;
        foreach($fetchedcountry as $country)
        {
           
                echo '<tr>
                <td>'.$count.'</td>
                <td>'.$country->name.'</td>
                 <td>'.$country->code.'</td> 
                 <td>

                 <button onclick="editCountry(\''.$country->id.'\')" class="btn btn-success">
                 <i class="zmdi zmdi-edit"></i> Edit </button>
             
                 
                 <button onclick="deleteCountry(\''.$country->id.'\')" class="btn btn-danger">
                     <i class="zmdi zmdi-delete"></i> Delete  </button>


                 </td>
                 
                 
                 
                 
                 
                 
                 
                 </tr>';
                $count++;
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