<?php
session_start();
require_once('classes\class.Product.php');

if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		 die();
	 }

if ($_SERVER['REQUEST_METHOD']=='POST')
{
extract($_POST);

$myproduct = new PRODUCTS();
$fetchedproduct= array();

if(isset($_POST['seoId']))
{
    
    $fetchedproduct  = $myproduct->getproduct($seoId);
}

else
{
    echo "Nothing is passed";
}


foreach($fetchedproduct as $product)
{
        echo '<tr><td>'.$product->id;
        echo '<tr><td>'.$product->seoId;
        echo '<tr><td>'.$product->name;
        echo '<tr><td>'.$product->currency;
        echo '<tr><td>'.$product->price;

}        


}
else
{
echo 'Ooops something went wrong';

}
