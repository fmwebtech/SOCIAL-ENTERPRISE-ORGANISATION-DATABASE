<?php
session_start();
require_once('classes\class.Seo.php');
require_once('classes\class.country.php');
require_once('classes\class.branch.php');
require_once('classes\class.product.php');
if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		 die();
	 }
if($_SERVER['REQUEST_METHOD']=='POST')
{
    extract($_POST);

    $mySeo= new Seo();
    $fetchedSeo= array();

    $fetchedSeo=$mySeo->getSeo();
    
            $count =1;
        foreach($fetchedSeo as $seo)
        {
            $brans = sizeof((new BRANCH())->getBranchBySeo($seo->id));
            $pro = sizeof((new PRODUCTS())->getProducts($seo->id));
                echo '<tr>
                            <td>'.$count.'</td>
                            <td>'.$seo->name.'</td>
                            <td>'.(new COUNTRY($seo->established))->name.'</td>
                            <td>'.$brans.'</td>
                            <td>'.$seo->primaryCountry.'</td>
                            <td>'.$seo->governance.'</td>
                            <td>'.$seo->hqCountry.'</td>
                            <td>'.$seo->countryFounded.'</td>
                            <td>'.$seo->incomePerAnnum.'</td>
                            <td>'.$seo->expenditurePerAnnum.'</td>
                 
                 
                 
                 
                 
                        </tr>';
                        $count++;
        }       
   

}
else
{
    echo 'Ooops something went wrong';

}






?>