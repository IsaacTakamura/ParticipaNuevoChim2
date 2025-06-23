<?php
/**
 * Módulo de Envío de Correos para la Aplicación de Espacios Públicos
 * 
 * Este archivo maneja el envío de correos electrónicos de notificación sobre reportes
 * de daños en espacios públicos utilizando PHPMailer con configuración SMTP.
 */

// Importar las clases necesarias de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Cargar el autocargador de Composer para incluir todas las dependencias necesarias
require_once __DIR__ . '/../../vendor/autoload.php';

if (!function_exists('send_email')) {
    /**
     * Envía un correo electrónico de confirmación después de recibir un reporte de daño en espacio público
     * 
     * @param string $to        Dirección de correo electrónico del destinatario
     * @param string $subject   Asunto del correo
     * @param string $message   Contenido del cuerpo del correo (formato HTML)
     * @param array  $tmp_paths Array de rutas temporales de archivos para adjuntar imágenes
     * 
     * @return bool Verdadero si el correo se envió con éxito, falso en caso contrario
     */
    function send_email($to, $subject, $message, $tmp_paths = [])
    {
        // Crear una nueva instancia de PHPMailer con excepciones habilitadas
        $mail = new PHPMailer(true);

        try {
            // Configuración del Servidor SMTP
            $mail->isSMTP();                                           // Configurar mailer para usar SMTP
            $mail->Host = 'mail.muninuevochimbote.gob.pe';             // Dirección del servidor SMTP
            $mail->SMTPAuth = true;                                    // Habilitar autenticación SMTP
            $mail->Username = 'espaciospublicos@muninuevochimbote.gob.pe'; // Usuario SMTP
            $mail->Password = 'MDNCH*2025';                            // Contraseña SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;           // Habilitar encriptación SSL
            $mail->Port = 465;                                         // Puerto TCP para conexión SSL

            // Configuración del Contenido del Correo
            $mail->CharSet = 'UTF-8';                                  // Establecer codificación de caracteres
            $mail->Encoding = 'base64';                                // Establecer codificación del contenido
            $mail->setFrom('espaciospublicos@muninuevochimbote.gob.pe', 'Daño en parques y jardines públicos');
            $mail->addAddress('espaciospublicos@muninuevochimbote.gob.pe'); // Correo de la municipalidad
            
            // Validar y agregar el correo del usuario como destinatario
            if (filter_var($to, FILTER_VALIDATE_EMAIL)) {
                $mail->addAddress($to);
            }
            
            $mail->Subject = $subject;

            // Agregar información sobre las imágenes adjuntas si hay alguna
            if (!empty($tmp_paths)) {
                $message .= "<p>Se han adjuntado " . count($tmp_paths) . " imágenes como evidencia.</p>";
            }

            $mail->Body = $message;                                    // Establecer cuerpo del correo
            $mail->isHTML(true);                                       // Habilitar formato HTML

            // Procesar y adjuntar imágenes desde rutas temporales
            foreach ($tmp_paths as $tmp_path) {
                if (file_exists($tmp_path)) {
                    $mail->addAttachment($tmp_path, basename($tmp_path));
                }
            }

            // Enviar el correo
            $mail->send();
            return true;
        } 
        catch (Exception $e) {
            // Registrar mensaje de error y retornar fallo
            error_log("Error al enviar el correo: {$mail->ErrorInfo}");
            return false;
        }
    }
}
?>