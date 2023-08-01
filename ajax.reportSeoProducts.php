<?php
 session_start();
require_once('classes\class.Product.php');
require_once('classes\class.currency.php');
require_once('classes\class.seo.php');

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





	if ($_SERVER['REQUEST_METHOD']=='POST')
	{
					extract($_POST);

					$myproduct = new PRODUCTS();
					$fetchedproduct= array();

					if(isset($_POST['seoId']))
					{
						
						$fetchedproduct  = $myproduct->getProducts($seoId);
						
					}

					else
						{
							echo "Nothing is passed";
						}




						$count = 1;
					foreach($fetchedproduct as $product)
								{

								
									$mycu = new CURRENCY($product->currency);
									echo '
									
									<tr> <td style="padding-left:20px">'.$count.'. '.$product->name.'</td> <td>'.$mycu->code.' '.$product->price.'
									<i onclick="deleteProduct('.$product->id.')" title="Delete" style = "margin-left:10px" type="button" class="pull-right"> <i class="fa fa-trash"></i> </i>
									<i onclick="editProduct('.$product->id.',\''.$product->name.'\',\''.$product->currency.'\',\''.$product->price.'\',\''.$product->seoId.'\')" title="Edit" type="button" class="pull-right"> <i class="fa fa-edit"></i> </i>
									
									</td> </tr>
									
									';
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