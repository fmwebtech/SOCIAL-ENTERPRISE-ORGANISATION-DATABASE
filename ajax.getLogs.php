<?php

require_once('classes\class.logs.php');
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
    
    
    else if(isset($_POST['dateRange']))
    {
        $fetchedlogs  = $mylogs->getLogsByDateRange($startDate, $endDate);
    }


    else if(isset($_POST['user']))
    {
        $fetchedlogs  = $mylogs->getLogsByUser($user);
    }

    else
    {
        $fetchedlogs  = $mylogs->getLogs();
    }

    foreach($fetchedlogs as $log)
    {
            echo '<tr><td>'.$log->name.'</td> <td>'.$log->details.'</td> </tr>';
    }        


}
else
{
    echo 'Ooops something went wrong';

}






?>






















