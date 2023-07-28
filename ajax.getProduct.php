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
    
    $fetchedproduct  = $myproduct->getProductS($seoId);
    
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
    <button  onclick="deleteBranch('.$product->id.')" type="button" class="btn btn-light btn-round btn-sm px-5 pull-right"> <i class="fa fa-edit"></i> </button>
    </td> </tr>
    
    ';
    $count++;
}        


}
else
{
echo 'Ooops something went wrong';

}







