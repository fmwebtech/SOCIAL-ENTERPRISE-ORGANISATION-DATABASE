<div class="card-title">Products
 <button onclick="addProduct(<?php echo $_POST['seoId']?>)"  type="button" class="btn btn-light btn-round btn-sm px-5 pull-right">
      Add Product</button>
</div>

<div >
<table class="col-lg-12">
  <tr> <td></td> <td></td> </tr>
</tbody>
<?php
session_start();
require_once('classes\class.Product.php');
require_once('classes\class.currency.php');


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
    
    <tr> <td style="padding-left:20px">'.$count.'. '.$product->name.'</td> <td>'.$mycu->name.' '.$product->price.'
    <i onclick="deleteproduct('.$product->id.')" style = "margin-left:10px" type="button" class="pull-right"> <i class="fa fa-trash"></i> </i>
    <i onclick="editProduct('.$product->id.',\''.$product->name.'\',\''.$product->currency.'\',\''.$product->price.'\',\''.$product->seoId.'\')" type="button" class="pull-right"> <i class="fa fa-edit"></i> </i>
    
    </td> </tr>
    
    ';
    $count++;
}        


}
else
{
echo 'Ooops something went wrong';

}







