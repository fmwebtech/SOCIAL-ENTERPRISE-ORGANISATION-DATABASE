<?php
require_once('classes\class.seo.php');
$myseo= new Seo();
//save($name, $established, $ownership, $governance, $hqCountry, $countryFounded, $incomePerAnnum, $expenditurePerAnnum)
//function SeoExists($name,$ownership)
//edit($id, $name, $established, $ownership, $governance, $hqCountry, $countryFounded, $incomePerAnnum, $expenditurePerAnnum, $status)
//safeToEdit($id,$name)
//getSeo($name)
//delete($id)
//$mySeo->save(1,'sydney', '200', 'CC', 'JAY','200', );

$myseo->save('AEY', 12, 10, 'FaY', 'KABWE', 'Judey','ZAMBIA', 1300,000, 1100,000);


?>