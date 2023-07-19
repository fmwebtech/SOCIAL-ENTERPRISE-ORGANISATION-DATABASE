<?php
$iudicbiwugfijhdgfiwe = '10.10.0.215';
$tjhscjhds = 'intern';
$iwuebfjhf = 'internpassword';
$ifuweifwid = 'DHIPS';
$Myconnection = new PDO("sqlsrv:server=$iudicbiwugfijhdgfiwe;database=$ifuweifwid",$tjhscjhds, $iwuebfjhf);
$Myconnection -> setAttribute(PDO::ATTR_ERRMODE, 
PDO::ERRMODE_EXCEPTION);
//echo (explode('/',$_SERVER['PHP_SELF'])[sizeof(explode('/',$_SERVER['PHP_SELF']))-1]);
?>