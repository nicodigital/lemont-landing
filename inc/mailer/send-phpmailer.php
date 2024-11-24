<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'mailer/phpMailer/Exception.php';
require 'mailer/phpMailer/PHPMailer.php';
require 'mailer/phpMailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {

    // Message Server settings
    $mail->CharSet = "UTF-8";
    $mail->Encoding = 'base64';
    $mail->SMTPDebug = 0;
    // $mail->SMTPDebug = 2;
    $mail->isSMTP();

    // SMTP GMAIL
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'nicolook.pro@gmail.com';    
    $mail->Password   = 'tmdphjgshjovcdjr';          
    
    // SMTP I+D
    // $mail->Host       = 'testing.idmedia.uy';
    // $mail->SMTPAuth   = true;
    // $mail->Username   = 'send@testing.idmedia.uy';    
    // $mail->Password   = 'v67abHu5A@@p';          
    
    $mail->SMTPSecure = 'ssl';                       //Enable implicit TLS encryption
    // $mail->SMTPSecure = 'tls';                    //Enable implicit TLS encryption
    $mail->Port       = 465;

    // Establecer el idioma del correo electrónico
    $mail->setLanguage('es'); // Cambia 'es' por el código del idioma que desees

    $subject          = "Consulta — Título del sitio";

    //Recipients
    $mail->setFrom( 'nicolook.pro@gmail.com', 'Nombre del remitente', 'UTF-8' );

    $mail->addAddress( 'nicolook.pro@gmail.com' );     //Add a recipient
    //$mail->addAddress('ellen@example.com');   //Add a recipient

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = '=?UTF-8?B?' . base64_encode( $subject ) . '?='; // Codificación UTF-8
    
    $messageHtml = nl2br($message);
    $mail->Body    = $messageHtml;

    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    /*//////////////////////////// CORREO DE RESPUESTA ////////////////////////////////*/
    // $response = new PHPMailer(true);

    // // Response Server settings
    // $response->CharSet = "UTF-8";
    // $response->Encoding = 'base64';
    // $response->SMTPDebug = 0;
    // // $response->SMTPDebug = 2;
    // $response->isSMTP();
    // $response->Host       = 'smtp.gmail.com';
    // $response->SMTPAuth   = true;
    // $response->Username   = 'nicolook.pro@gmail.com';    //SMTP username
    // $response->Password   = 'tmdphjgshjovcdjr';          //SMTP password
    // $response->SMTPSecure = 'ssl';                       //Enable implicit TLS encryption
    // // $response->SMTPSecure = 'tls';                    //Enable implicit TLS encryption
    // $response->Port       = 465;

    // $subjectResponse = "Re: " . $subject; // Asunto de la respuesta

    // // Remitente del correo de respuesta
    // $response->setFrom( 'nicolook.pro@gmail.com', 'Nombre del remitente', 'UTF-8' );

    // // Destinatario del correo de respuesta (usando la dirección del remitente original)
    // $response->addAddress($field_email);

    // // Contenido del correo de respuesta
    // $response->isHTML(true); // Formato HTML
    // $response->Subject = '=?UTF-8?B?' . base64_encode( $subjectResponse ) . '?='; // Codificación UTF-8
    // $response->Body = '"Hemos recibido tu mensaje. Nos pondremos en contacto dentro de las próximas 24 horas hábiles (de lunes a viernes).';

    // // Enviar el correo de respuesta
    // $response->send();

    /*//////////////////////////////// OUTPUT ///////////////////////////////////*/

    if( !$mail->send() ){

        echo 'Mailer Error: ' . $mail->ErrorInfo;

    }else{

        $output = json_encode(array('type' => 'message', 'text' => "Tu mensaje ha sido enviado exitosamente. Gracias." ) );
        die($output);

    }

} catch (Exception $e) {

    // $output = json_encode(array('type' => 'error', 'text' => $error_mssg ) );
    $output = json_encode(array('type' => 'error', 'text' => $mail->ErrorInfo ) );
    die($output);

}