<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta

if (!function_exists('send_email')) {
    // Esta función envía un correo electrónico de confirmación después de recibir un reporte
    function send_email($to, $subject, $message, $attachment = null)
    {
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'mail.muninuevochimbote.gob.pe'; // Servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'espaciospublicos@muninuevochimbote.gob.pe'; // Correo de autenticación
            $mail->Password = 'MDNCH*2025'; // Contraseña
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Usar SSL
            $mail->Port = 465; // Puerto SMTP con SSL

            // Configuración del correo
            $mail->CharSet = 'UTF-8'; // Establecer la codificación de caracteres a UTF-8
            $mail->Encoding = 'base64'; // Establecer la codificación del contenido a base64
            $mail->setFrom('espaciospublicos@muninuevochimbote.gob.pe', 'Daño en parques y jardines públicos');
            $mail->addAddress($to); // Correo destinatario
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->isHTML(true); // Establecer el formato del correo a HTML

            // Adjuntar la imagen si existe
            if ($attachment) {
                $mail->addAttachment($attachment);
            }

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