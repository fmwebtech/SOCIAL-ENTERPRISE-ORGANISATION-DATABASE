<?php
require_once('classes\class.country.php');

$mycountry = new COUNTRY();


//save($name,$code)
//countryExists($code)
//edit($id,$name,$code,$status)
//safeToEdit($id,$code)




// $outcome = $mycountry-> save('South Africa', 'SA');

// if($outcome)
// {
//         echo "Saved Successufully";
// }
// else
// {
//         echo "Not Saved";
// }


//var_dump($outcome);



//$mycountry-> edit(2, 'Malawi','MW','EDITED');


$outcome = $mycountry->getCountry();
var_dump($outcome);
// if($outcome)
// {
//     echo 'Countries Retrieved';
// }
// else

// {
//     echo 'Countries not Retrived';
// }




// $outcome = $mycountry->delete(2);

// if($outcome)
// {
//     echo 'Countriy Deleted';
// }
// else

// {
//     echo 'Country not Deleted';
// }







?>