<?php
session_start();
require_once('classes\class.Seo.php');
require_once('classes\class.country.php');
require_once('classes\class.branch.php');
if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		 die();
	 }
if($_SERVER['REQUEST_METHOD']=='POST')
{
    extract($_POST);

    $mySeo= new Seo();
    $fetchedSeo= array();

    $fetchedSeo=$mySeo->getSeo();
    
            $count =1;
        foreach($fetchedSeo as $seo)
        {
            $brans = sizeof((new BRANCH())->getBranchBySeo($seo->id));
                echo '<tr>
                            <td>'.$count.'</td>
                            <td>'.$seo->name.'</td>
                            <td>'.$seo->established.'</td>
                            <td>'.$brans.'</td>
                            
                            
                            <td>'.$seo->incomePerAnnum.'</td>
                            <td>'.$seo->expenditurePerAnnum.'</td>
                                       
                            <td><button onclick="editSeo(\''.$seo->id.'\')" class="btn btn-success">
                            <i class="zmdi zmdi-edit"></i> Edit </button>
                        
                            
                            <button onclick="deleteSeo(\''.$seo->id.'\')" class="btn btn-danger">
                                <i class="zmdi zmdi-delete"></i> Delete  </button>
                                </td>
                 
                 
                 
                        </tr>';
                        $count++;
        }       
   

}
else
{
    echo 'Ooops something went wrong';

}






?>