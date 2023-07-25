<?php
require 'class.phpmailer.php';
$mail = new PHPMailer();



function sendmail($toAddress , $subject ,$message){

    
$mail = new PHPMailer();
$mail->IsSMTP();
 
$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
 
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = "smtp.gmail.com"; 
$mail->Port = 465; // or 587
$mail->IsHTML(true);
$mail->Username = "procurearc@gmail.com"; //mepgqfedavkzdxyk
$mail->Password = "mepgqfedavkzdxyk";

 
$mail->SetFrom("procurearc@gmail.com");
$mail->Subject = $subject;
$mail->Body = $message;  

if (strpos($toAddress, ',') !== false) {
        // If the email addresses contain a comma, split the string into an array and send an email to each address separately
        $toAddresses = explode(',', $toAddress);
        foreach ($toAddresses as $address) {
            $mail->AddAddress(trim($address));
        }
    } else {
        // If the email addresses do not contain a comma, send an email to the single address
        $mail->AddAddress(trim($toAddress));
    }

 
  
if(!$mail->Send()) {
			return true;
}
else
{
		return true;			
		
		}


    

}
 // create a new object
  

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

