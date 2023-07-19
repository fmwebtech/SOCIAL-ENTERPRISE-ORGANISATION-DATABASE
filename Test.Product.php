<?php

require_once('classes\class.Product.php');

$myProduct = new PRODUCTS();

//save($name,$currency,$seoId,$price,$createdBy)
$myProduct -> save('Hillary','zmk','','50','')

//edit($id, $seoId,$name,$currency,$price,$status) 

//getProduct($name,$seoId,$currency,$price)

//productExists($name)

//safeToEdit($seoId,$name,$currency,$price,$status)

//delete($id)

?>