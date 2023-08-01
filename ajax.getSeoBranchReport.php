<?php 
require_once('classes\class.country.php');
require_once('classes\class.seoCountry.php');
require_once('classes\class.branch.php');
require_once('classes\class.seo.php');


if($_SERVER['REQUEST_METHOD']=='POST')
{
    
    extract($_POST);

      $mySeo = new SEO($id);
      $count = 1;
      foreach((new BRANCH())->getBranchBySeo($id) as $br)
      {
        $myCountry = new COUNTRY($br->countryId);
          echo '
          
          <tr> <td style="padding-left:20px">'.$count.'</td><td> '.$mySeo->name.'</td> <td>'.$myCountry->name.'</td> <td>'.$br->name.' </td> <td>'.$br->address.'</td> </tr>
          
          ';
          $count++;
      }
     



}
else
{

}



?>