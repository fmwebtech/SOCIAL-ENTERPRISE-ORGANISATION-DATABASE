<div class="card-title">Services
 <button onclick="addService(<?php echo $_POST['seoId']?>)"  type="button" class="btn btn-light btn-round btn-sm px-5 pull-right">
      Add Service</button>
</div>

<div >
<table class="col-lg-12">
  <tr> <td></td> <td></td> </tr>
</tbody>
<?php
session_start();
require_once('classes\class.Service.php');
require_once('classes\class.currency.php');

$createdBy = $_SESSION['email'];
if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
        echo 'request failed';
         die();
     }

if ($_SERVER['REQUEST_METHOD']=='POST')
{
extract($_POST);

$myService = new SERVICES();
$fetchedService= array();

if(isset($_POST['seoId']))
{
    
    $fetchedService  = $myService->getServices($seoId);
    
}

else
{
    echo "Nothing is passed";
}




    $count = 1;
foreach($fetchedService as $service)
{

   
    $mycu = new CURRENCY($service->currency);
    echo '
    
    <tr> <td style="padding-left:20px">'.$count.'. '.$service->name.'</td> <td>'.$mycu->code.' '.$service->price.'
    <i onclick="deleteService('.$service->id.')" title="Delete" style = "margin-left:10px" type="button" class="pull-right"> <i class="fa fa-trash"></i> </i>
    <i onclick="editService('.$service->id.',\''.$service->name.'\',\''.$service->currency.'\',\''.$service->price.'\',\''.$service->seoId.'\')" title="Edit" type="button" class="pull-right"> <i class="fa fa-edit"></i> </i>
    
    </td> </tr>
    
    ';
    $count++;
}        


}
else
{
echo 'Ooops something went wrong';

}







