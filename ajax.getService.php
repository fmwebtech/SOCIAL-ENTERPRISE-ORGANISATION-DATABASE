<?php
session_start();
require_once('classes\class.Service.php');

if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		 die();
	 }

if ($_SERVER['REQUEST_METHOD']=='POST')
{
extract($_POST);

$myservice = new SERVICES();
$fetchedservice= array();

if(isset($_POST['seoId']))
{
    
    $fetchedservice  = $myservice->getservice($seoId);
}

else
{
    echo "Nothing is passed";
}


foreach($fetchedservice as $service)
{
        echo '<tr><td>'.$service->id;
        echo '<tr><td>'.$service->seoId;
        echo '<tr><td>'.$service->name;
        echo '<tr><td>'.$service->currency;
        echo '<tr><td>'.$service->price;

}        


}
else
{
echo 'Ooops something went wrong';

}
