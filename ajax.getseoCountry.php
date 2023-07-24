<?php



require_once('classes\class.seoCountry.php');
if($_SERVER['REQUEST_METHOD']=='POST')
{
   
    extract($_POST);
    $myseoCountry = new seoCountry();
    $fetchedseoCountry= array();

    if(isset($_POST['seoId']) AND isset($_POST['countryId']))
    {
        
        $fetchedseoCountry  = $myseoCountry-getSeoCountryBySeoIdAndCountryId($seoId,$countryId);
    }
    else if(isset($_POST['seoId']) AND !isset($_POST['countryId']))
    {
       // echo " hi";
    $fetchedseoCountry  = $myseoCountry->getSeoCountryBySeoId($seoId);

    }
    else if(!isset($_POST['seoId']) AND isset($_POST['countryId']))
    {
       echo " hi";
        $fetchedseoCountry  = $myseoCountry->getSeoCountryByCountryId($countryId);
    }
    else
    {
        echo "no condition was met!";
    }
    
    foreach($fetchedseoCountry as $seoCountry)
    {
            echo '<tr><td>'.$seoCountry->seoId.'</td> <td>'.$seoCountry->countryId.'</td> </tr>';
    }        


}
else
{
    echo 'Ooops something went wrong';

}






?>






















