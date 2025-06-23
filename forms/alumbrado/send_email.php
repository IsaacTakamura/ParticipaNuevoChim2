<?php
/**
 * Módulo de envío de correos electrónicos para el sistema de Alumbrado Público
 * Este archivo contiene la función para enviar correos electrónicos con PHPMailer
 */

// Importación de las clases necesarias de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Carga del autoloader de Composer para incluir las dependencias
require_once __DIR__ . '/../../vendor/autoload.php';

// Verifica si la función ya existe para evitar redefiniciones
if (!function_exists('send_email')) {
    /**
     * Envía un correo electrónico usando PHPMailer
     * 
     * @param string $to        Dirección de correo del destinatario
     * @param string $subject   Asunto del correo
     * @param string $message   Contenido del mensaje (HTML)
     * @param array  $tmp_paths Rutas temporales de archivos adjuntos (opcional)
     * 
     * @return boolean          Retorna true si el envío fue exitoso, false en caso contrario
     */
    function send_email($to, $subject, $message, $tmp_paths = [])
    {
        // Inicialización de PHPMailer con manejo de excepciones
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'mail.muninuevochimbote.gob.pe';
            $mail->SMTPAuth = true;
            $mail->Username = 'alumbradopublico@muninuevochimbote.gob.pe';
            $mail->Password = 'MDNCH*2025';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            // Configuración de codificación de caracteres
            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';
            
            // Configuración de remitente y destinatarios
            $mail->setFrom('alumbradopublico@muninuevochimbote.gob.pe', 'Alumbrado Público');
            $mail->addAddress('alumbradopublico@muninuevochimbote.gob.pe'); // Siempre se envía copia al correo de la municipalidad
            
            // Añade el destinatario original solo si es un correo válido
            if (filter_var($to, FILTER_VALIDATE_EMAIL)) {
                $mail->addAddress($to);
            }
            
            // Configuración del asunto
            $mail->Subject = $subject;

            // Añade información sobre los archivos adjuntos al mensaje
            if (!empty($tmp_paths)) {
                $message .= "<p>Se han adjuntado " . count($tmp_paths) . " imágenes como evidencia.</p>";
            }

            // Configuración del cuerpo del mensaje
            $mail->Body = $message;
            $mail->isHTML(true);

            // Procesamiento de archivos adjuntos
            foreach ($tmp_paths as $tmp_path) {
                if (file_exists($tmp_path)) {
                    $mail->addAttachment($tmp_path, basename($tmp_path));
                }
            }

            // Envío del correo
            $mail->send();
            return true;
        } catch (Exception $e) {
            // Registro del error en el log del sistema
            error_log("Error al enviar el correo: {$mail->ErrorInfo}");
            return false;
        }
    }
}
?>