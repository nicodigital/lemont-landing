<?php

$to_email = 'nicolook.pro@gmail.com';
$headers = "From: ".$name." <". $email .">\r\n";
$headers .= "MIME-Version:1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";

$subject = "PONT BLEU - Consulta";

$sendemail = @mail($to_email, $subject, $message, $headers);

if (!$sendemail) {

    $output = json_encode(array('type' => 'error', 'text' => $error_mssg));
    die($output);

} else {

    $output = json_encode(array('type' => 'message', 'text' => $success_mssg));
    die($output);
    
}