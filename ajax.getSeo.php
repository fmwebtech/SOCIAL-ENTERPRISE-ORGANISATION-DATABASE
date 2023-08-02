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



                echo '<tr >
                            <span onclick= "goToSeo('.$seo->id.')">
                            <td onclick= "goToSeo('.$seo->id.')">'.$count.'</td>
                            <td  onclick= "goToSeo('.$seo->id.')">'.$seo->name.'</td>
                            <td  onclick= "goToSeo('.$seo->id.')">'.$seo->established.'</td>
                            <td>'.$brans.'</td>
                            
                            
                            <td  onclick= "goToSeo('.$seo->id.')">'.$seo->incomePerAnnum.'</td>
                            <td  onclick= "goToSeo('.$seo->id.')">'.$seo->expenditurePerAnnum.'</td>
                              </span>         
                            <td><button onclick="editSeo(\''.$seo->id.'\')" class="btn btn-sm btn-success">
                            <i class="zmdi zmdi-edit"></i> Edit </button>
                        
                            
                            <button onclick="deleteSeo(\''.$seo->id.'\')" class="btn btn-sm btn-danger">
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