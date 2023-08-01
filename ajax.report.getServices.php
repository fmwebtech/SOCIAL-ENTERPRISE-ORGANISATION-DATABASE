<?php
session_start();
require_once('classes\class.Service.php');
require_once('classes\class.currency.php');
require_once('classes\class.seo.php');

if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
        echo 'request failed';
         die();
     }

if ($_SERVER['REQUEST_METHOD']=='POST')
{
extract($_POST);
$myService = new SERVICES();
$mySeo = new SEO($seoId);
$fetchedService  = $myService->getServices($seoId);
    $count = 1;
foreach($fetchedService as $service)
{

   
    $mycu = new CURRENCY($service->currency);
    echo '
    
    <tr> <td style="padding-left:20px">'.$count.'.</td> <td>'.$mySeo->name.'</td> <td> '.$service->name.'</td><td>'.$mycu->name.' </td><td>'.$mycu->code.' '.$service->price.'</td> </tr>
    
    ';
    $count++;
}        


}
else
{
echo 'Ooops something went wrong';

}
?>







