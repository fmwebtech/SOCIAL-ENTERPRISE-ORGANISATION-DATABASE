<?php
 session_start();
require_once('classes\class.Product.php');
require_once('classes\class.currency.php');
require_once('classes\class.seo.php');


if($_SERVER['REQUEST_METHOD']=='POST')
{
    
    extract($_POST);

      $mySeo = new SEO($id);
      $count = 1;
      foreach((new PRODUCTS())->getProducts($id) as $pr)
      {
        $myCur = new CURRENCY($pr->currency);
          echo '
          
          <tr> <td style="padding-left:20px">'.$count.'</td><td> '.$mySeo->name.'</td> <td>'.$pr->name.'</td> <td>'.$myCur->name.' </td> <td>'.$myCur->code.' '.$pr->price.'</td> </tr>
          
          ';
          $count++;
      }
     



}
else
{

}







?>