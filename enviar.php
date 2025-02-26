<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Si usaste Composer
require 'vendor/autoload.php';

// Si descargaste manualmente PHPMailer
// require 'phpmailer/PHPMailer.php';
// require 'phpmailer/Exception.php';
// require 'phpmailer/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'mail.muninuevochimbote.gob.pe'; // Servidor SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'alumbradopublico@muninuevochimbote.gob.pe'; // Correo de autenticación
    $mail->Password = 'MDNCH*2025'; // Contraseña
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Usar SSL
    $mail->Port = 465; // Puerto SMTP con SSL

    // Configuración del correo
    $mail->setFrom('alumbradopublico@muninuevochimbote.gob.pe', 'Alumbrado Público');
    $mail->addAddress('alumbradopublico@muninuevochimbote.gob.pe'); // Correo destinatario
    $mail->Subject = 'Prueba de correo desde XAMPP';
    $mail->Body = 'Este es un correo de prueba enviado desde XAMPP con PHPMailer.';

    // Enviar el correo
    $mail->send();
    echo 'El correo se ha enviado correctamente.';
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}
?>