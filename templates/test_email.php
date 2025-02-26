<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'mail.muninuevochimbote.gob.pe';
    $mail->SMTPAuth = true;
    $mail->Username = 'basura@muninuevochimbote.gob.pe';
    $mail->Password = 'MDNCH*2025';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->setFrom('basura@muninuevochimbote.gob.pe', 'Reporte de Basura');
    $mail->addAddress('basura@muninuevochimbote.gob.pe');
    $mail->Subject = 'Correo de prueba';
    $mail->Body = 'Este es un correo de prueba.';
    $mail->isHTML(true);

    $mail->send();
    echo 'Correo enviado correctamente';
} catch (Exception $e) {
    echo "Error al enviar el correo: {$mail->ErrorInfo}";
}
?>