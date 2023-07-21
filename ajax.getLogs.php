<?php

require_once('classes\class.logs.php');
if($_SERVER['REQUEST_METHOD']=='POST')
{
    extract($_POST);
    $mylogs = new LOGS();
    $fetchedlogs= array();
    if(isset($_POST['id']))
    {
        $fetchedlogs  = $mylogs->getLogsById($id);
    }
    else if(isset($_POST['class']) AND isset($_POST['function']))
    {
        $fetchedlogs  = $mylogs->getLogsByClasAndFunction($class,$function);
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






















