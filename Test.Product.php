<?php

require_once('classes\class.Product.php');

$myProduct = new PRODUCTS();

//save($name,$currency,$seoId,$price,$createdBy)

$myProduct -> save('Hillary','5','2','70','3');




// $outcome = $myProduct-> save('Mukupa','zm','','70','');

// if($outcome)
// {
//         echo "Saved Successufully";
// }
// else
// {
//         echo "Not Saved";
// }



//$myProduct -> name;

//edit($id, $seoId,$name,$currency,$price,$status) 

//getProduct($name,$seoId,$currency,$price)

//productExists($name)

//safeToEdit($seoId,$name,$currency,$price,$status)

//delete($id)

?>