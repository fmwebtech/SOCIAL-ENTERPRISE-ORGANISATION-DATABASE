<?php
require_once('classes\class.seoCountry.php');

$myseoCountry =new seoCountry ();
 //$myseoCountry-> save('3', '2');


// $outcome=$myseoCountry->edit(1, 3, 2, 'new', 'Nkaka');
// var_dump($outcome);



// $outcome=$myseoCountry->getSeoCountryByCountryId(3);
// var_dump($outcome);
// $outcome=$myseoCountry->getSeoCountryBySeoIdAndCountryId(2,3);
// var_dump($outcome);

//$id, $countryId, $seoId, $status
$outcome=$myseoCountry->delete(1);
var_dump($outcome);

?>