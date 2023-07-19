<?php
require_once('classes\class.country.php');

$mycountry = new COUNTRY();


//save($name,$code)
//countryExists($code)
//edit($id,$name,$code,$status)
//safeToEdit($id,$code)


//$mycountry-> save('Zambia', 'ZM');

$mycountry-> edit(2, 'Malawi','MW','EDITED');


?>