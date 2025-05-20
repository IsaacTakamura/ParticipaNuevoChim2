<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta

if (!function_exists('send_email')) {
    function send_email($to, $subject, $message, $tmp_paths = [])
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'mail.muninuevochimbote.gob.pe';
            $mail->SMTPAuth = true;
            $mail->Username = 'alumbradopublico@muninuevochimbote.gob.pe';
            $mail->Password = 'MDNCH*2025';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->setFrom('alumbradopublico@muninuevochimbote.gob.pe', 'Alumbrado Público');
            $mail->addAddress('alumbradopublico@muninuevochimbote.gob.pe'); // Correo de la municipalidad
            $mail->addAddress($to); // Correo del usuario (confirmación)
            $mail->Subject = $subject;

            // Agregar texto genérico sobre las imágenes adjuntas
            if (!empty($tmp_paths)) {
                $message .= "<p>Se han adjuntado " . count($tmp_paths) . " imágenes como evidencia.</p>";
            }

            $mail->Body = $message;
            $mail->isHTML(true);

            // Adjuntar imágenes desde rutas temporales
            foreach ($tmp_paths as $tmp_path) {
                if (file_exists($tmp_path)) {
                    $mail->addAttachment($tmp_path, basename($tmp_path));
                }
            }

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Error al enviar el correo: {$mail->ErrorInfo}");
            return false;
        }
    }
}
?>