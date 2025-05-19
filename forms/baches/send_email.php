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
            $mail->Username = 'huecos@muninuevochimbote.gob.pe'; // Correo de autenticación
            $mail->Password = 'MDNCH*2025'; // Contraseña
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Usar SSL
            $mail->Port = 465; // Puerto SMTP con SSL

            // Configuración del correo
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->setFrom('huecos@muninuevochimbote.gob.pe', 'Daño en la calle publica');
            $mail->addAddress($to);
            $mail->Subject = $subject;

            // Adjuntar las fotos al correo
            if (!empty($_FILES['photos'])) {
                foreach ($_FILES['photos']['tmp_name'] as $key => $tmpName) {
                    if ($_FILES['photos']['error'][$key] === UPLOAD_ERR_OK) {
                        $mail->addAttachment(
                            $tmpName,
                            $_FILES['photos']['name'][$key]
                        );
                    }
                }
                // Agregar texto genérico sobre las imágenes adjuntas
                $message .= "<p>Se han adjuntado " . count($_FILES['photos']['name']) . " imágenes como evidencia.</p>";
            }

            $mail->Body = $message;
            $mail->isHTML(true);

            // Enviar el correo
            $mail->send();
            return true;
        } catch (Exception $e) {
            // Manejo de errores usando el catch de PHPMailer
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
            return false;
        }
    }
}
?>