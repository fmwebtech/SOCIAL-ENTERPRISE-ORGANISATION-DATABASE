<?php

require_once('classes\class.logs.php');

$mylogs = new LOGS();

// //save($user, $computer,  $class, $function,$data): bool
// $outcome = $mylogs->save('Frank','HP Model','Branch','Save','Name of Branch');

// if($outcome)
// {
//     echo 'Logs Saved';
// }

// else
// {
// echo 'Log Not Saved';
// }



$outcome = $mylogs->getLogs();
var_dump($outcome);


// if($outcome)
// {
//     echo 'Logs Retrived';
// }

// else
// {
// echo 'Log Not Retrived';
// }

?>