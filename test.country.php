<?php
require_once('classes\class.country.php');

$mycountry = new COUNTRY();


//save($name,$code)
//countryExists($code)
//edit($id,$name,$code,$status)
//safeToEdit($id,$code)




//$outcome = $mycountry-> save('South Africa', 'SA');

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


$mycountry->getCountry('MW');


?>