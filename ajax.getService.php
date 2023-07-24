<?php

require_once('classes\class.Service.php');

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
