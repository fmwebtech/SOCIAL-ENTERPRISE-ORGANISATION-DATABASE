<?php
require_once('classes\class.branch.php');

$mybranch = new BRANCH(2);



//save(save(mixed $seoId, mixed $countryId, mixed $name, mixed $address, mixed $createdBy, mixed $modifiedBy): bool)
//branchExists($name, $address)
//edit($id, $seoCountryId, $name, $address, $status)
//safeToEdit($id,$name
//getBranch($seoCountryId)
//delete($id)

// $outcome= $mybranch ->save(3, 4, 'NDOLA','Ndeke','Mwale', 'Hillary');
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
// $outcome = $mybranch->edit(4, 2, 3,'KABWE','MULUNGUSHI','Frank','Sydney','Edited');
// var_dump($outcome);
// if($outcome)
// {
//     echo "Edited Successufully!!";
// }
// else
// {
//     echo "Not edited!!";
// }



// $outcome = $mybranch->getBranch(2,3);
// var_dump($outcome);

// if($outcome)
// {
//     echo 'Branch Retrived Successufully';

// }
// else
// {
//     echo 'Branch Not Retrieved';
// }



// $outcome = $mybranch->getBranchByCountry(4);
// var_dump($outcome);

// if($outcome)
// {
//     echo 'Branch Retrived Successufully';

// }
// else
// {
//     echo 'Branch Not Retrieved';
// }



// $outcome = $mybranch->getBranchBySeo(2,);
// var_dump($outcome);

// if($outcome)
// {
//     echo 'Branch Retrived Successufully';

// }
// else
// {
//     echo 'Branch Not Retrieved';
// }








$outcome = $mybranch->delete(4);
var_dump($outcome);

if($outcome)
{
    echo 'Branch Deleted';
}
else
{
    echo 'Branch Not Deleted';
}






?>