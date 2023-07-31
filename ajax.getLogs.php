<?php
session_start();
require_once('classes\class.logs.php');

if(!isset($_SESSION['email'])) //check if this request is sent while logged in
	 {
		 echo 'request failed';
		die();
	}


if($_SERVER['REQUEST_METHOD']=='POST')
{
    extract($_POST);
    $mylogs = new LOGS();
    $fetchedlogs= array();

    if(isset($_POST['class']) AND isset($_POST['function']))
    {
        $fetchedlogs  = $mylogs->getLogsByClassAndFunction($class,$function);
    }


    else if(isset($_POST['class']) AND !isset($_POST['function']))
    {
    $fetchedlogs  = $mylogs->getLogsByClass($class);

    }
    
    
    else if(isset($_POST['startDate']) AND isset($_POST['endDate']) )
    {
        $fetchedlogs  = $mylogs->getLogsByDateRange($startDate, $endDate);
    }


    else if(isset($_POST['user']) AND !isset($_POST['function']))
    {
       
        $fetchedlogs  = $mylogs->getLogsByUser($user);
        
    }

    else
    {
        $fetchedlogs  = $mylogs->getLogs();
    }

    foreach($fetchedlogs as $log)
    {
            echo '<tr><td>'.$log->user.'</td> <td>'.$log->data.'</td> </tr>';
    }        


}
else
{
    echo 'Ooops something went wrong';

}






?>






















