<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta

if (!function_exists('send_email')) {
    // Esta función envía un correo electrónico de confirmación después de recibir un reporte
    function send_email($to, $subject, $message)
    {
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
            $mail->setFrom('alumbradopublico@muninuevochimbote.gob.pe', 'Daños en espacios públicos');
            $mail->addAddress("alumbradopublico@muninuevochimbote.gob.pe"); // Correo destinatario
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->isHTML(true); // Establecer el formato del correo a HTML

            // Enviar el correo
            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
            return false;
        }
    }
}
?>