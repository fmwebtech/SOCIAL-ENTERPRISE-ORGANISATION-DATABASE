<?php
require_once('classes\class.branch.php');

$mybranch = new BRANCH(2);



//save(save(mixed $seoId, mixed $countryId, mixed $name, mixed $address, mixed $createdBy, mixed $modifiedBy): bool)
//branchExists($name, $address)
//edit($id, $seoCountryId, $name, $address, $status)
//safeToEdit($id,$name
//getBranch($seoCountryId)
//delete($id)

// $outcome= $mybranch ->save(2, 3, 'LUSAKA','SOCIETY BUSINESS PARK','Frank', 'Hillary');
// var_dump($outcome);
// if($outcome)
// {
//     echo "Saved Successufully!!";
// }
// else
// {
//     echo "Not Saved!!";
// }


//edit(mixed $id, mixed $seoId, mixed $countryId, mixed $name, mixed $address, mixed $createdBy, mixed $modifiedBy, mixed $status): bool
$outcome = $mybranch->edit(3, 4, 2,'lUNDAZI','Msuzi','Frank','Sydney','Edited');
var_dump($outcome);
if($outcome)
{
    echo "Saved Successufully!!";
}
else
{
    echo "Not Saved!!";
}
























?>