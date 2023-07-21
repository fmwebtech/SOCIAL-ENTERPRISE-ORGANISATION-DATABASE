<?php

require_once('classes\class.country.php');
if($_SERVER['REQUEST_METHOD']=='POST')
{
    extract($_POST);

    $mycountry = new COUNTRY();

    if($mycountry->edit($id,$name,$code,$status))
    {
         echo 'Country has been Edited';
    }
    else
    {
        echo 'Ooops something went wrong';
    }



}
else
{
    echo 'Ooops something went wrong';

}






?>