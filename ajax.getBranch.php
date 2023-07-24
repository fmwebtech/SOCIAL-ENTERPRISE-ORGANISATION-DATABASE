<?php



require_once('classes\class.branch.php');
if($_SERVER['REQUEST_METHOD']=='POST')
{
   
    extract($_POST);
    $mybranch = new BRANCH();
    $fetchedbranch= array();

    if(isset($_POST['seoId'])AND isset($_POST['countryId']))
    {
        
        $fetchedbranch  = $mybranch->getBranch($seoId, $countryId);
    }


    else if(isset($_POST['seoId'])AND !isset($_POST['countryId']))
    {
        echo " hi";
    $fetchedbranch  = $mybranch->getBranchBySeo($seoId);

    }
    else
    {
        echo "Nothing is passed";
    }
   

    foreach($fetchedbranch as $branch)
    {
            echo '<tr><td>'.$branch->name.'</td> <td>'.$branch->address.'</td> </tr>';
    }        


}
else
{
    echo 'Ooops something went wrong';

}






?>






















