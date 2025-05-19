<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta

if (!function_exists('send_email')) {
    // Esta función envía un correo electrónico de confirmación después de recibir un reporte
    function send_email($to, $subject, $message, $tmp_paths = [])
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
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->setFrom('espaciospublicos@muninuevochimbote.gob.pe', 'Daño en parques y jardines públicos');
            $mail->addAddress($to);
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
            // Manejo de errores usando el catch de PHPMailer
            error_log("Error al enviar el correo: {$mail->ErrorInfo}");
            return false;
        }
    }
}
?>