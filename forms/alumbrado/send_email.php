<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta

if (!function_exists('send_email')) {
    function send_email($to, $subject, $message, $attachments = [])
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
            $mail->setFrom('alumbradopublico@muninuevochimbote.gob.pe', 'Problemas de alumbrado público');
            $mail->addAddress($to);
            $mail->Subject = $subject;
            $mail->Body = $message;
            $mail->isHTML(true);

            if (!empty($attachments)) {
                foreach ($attachments as $attachment) {
                    $mail->addAttachment($attachment);
                }
            }

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
            return false;
        }
    }
}
?>