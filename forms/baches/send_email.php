<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';

if (!function_exists('send_email')) {
    // Esta función envía un correo electrónico de confirmación después de recibir un reporte
    function send_email($to, $subject, $message, $tmp_paths = [])
    {
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'mail.muninuevochimbote.gob.pe';
            $mail->SMTPAuth = true;
            $mail->Username = 'huecos@muninuevochimbote.gob.pe';
            $mail->Password = 'MDNCH*2025';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            // Configuración del correo
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->setFrom('huecos@muninuevochimbote.gob.pe', 'Daño en la calle publica');
            $mail->addAddress('huecos@muninuevochimbote.gob.pe'); // Correo de la municipalidad
            $mail->addAddress($to); // Correo del usuario (confirmación)
            $mail->Subject = $subject;

            // Adjuntar imágenes desde rutas temporales
            if (!empty($tmp_paths)) {
                foreach ($tmp_paths as $tmp_path) {
                    if (file_exists($tmp_path)) {
                        $mail->addAttachment($tmp_path, basename($tmp_path));
                    }
                }
                $message .= "<p>Se han adjuntado " . count($tmp_paths) . " imágenes como evidencia.</p>";
            }

            $mail->Body = $message;
            $mail->isHTML(true);

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