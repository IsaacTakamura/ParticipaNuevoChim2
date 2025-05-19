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
            $mail->Host = 'mail.muninuevochimbote.gob.pe';
            $mail->SMTPAuth = true;
            $mail->Username = 'basura@muninuevochimbote.gob.pe';
            $mail->Password = 'MDNCH*2025';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            // Configuración del correo
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            $mail->setFrom('basura@muninuevochimbote.gob.pe', 'Reporte de Basura');
            $mail->addAddress($to);
            $mail->Subject = $subject;
            $mail->isHTML(true);

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

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$e->getMessage()}";
            return false;
        }
    }
}
?>