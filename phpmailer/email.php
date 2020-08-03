<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    ob_start();
    error_reporting(E_ALL & ~E_NOTICE);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'wwecuador.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'smite.mail@wwecuador.com';                     // SMTP username
    $mail->Password   = 'S58E{-sD+gix';                               // SMTP password
    $mail->SMTPSecure = "ssl";         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('smite.mail@wwecuador.com', 'Formulario | Ziba Web');
    $mail->addAddress('samuel.perez@ucuenca.edu.ec');     // Add a recipient
    $mail->addAddress('beatriz.floresr@ucuenca.edu.ec');               // Name is optional
    $mail->addReplyTo($_POST["correo"], 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
    

    // Attachments
    //$mail->addAttachment('http://localhost/TiendaOnline/factura/pdfGenerator.php?id=20&c=true', 'factura');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Nuevo Mensaje desde Ziba Web';
    $mail->Body    = "Nombre: ".$_POST["nombre"]."<br><br/>Correo: ".$_POST["correo"]."<br><br/>Mensaje: ".$_POST["mensaje"];
    $mail->AltBody = "Nombre: ".$_POST["nombre"]."\n\nCorreo: ".$_POST["correo"]."\n\nMensaje: ".$_POST["mensaje"];

    $mail->send();
    ob_end_clean();
    header("Location: ../contacto.php?m=1");
} catch (Exception $e) {
    header("Location: ../contacto.php?m=2");
}