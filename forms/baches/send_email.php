<?php
/**
 * Script para el envío de correos electrónicos usando PHPMailer
 * 
 * Este archivo contiene la función principal para enviar correos de notificación
 * para reportes de baches/daños en calles públicas.
 */

// Importación de las clases necesarias de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Carga del autoloader de Composer para gestionar dependencias
require_once __DIR__ . '/../../vendor/autoload.php';

// Verificación para evitar redefinición de funciones en caso de múltiples inclusiones
if (!function_exists('send_email')) {
    /**
     * Envía un correo electrónico de confirmación para reportes de baches
     * 
     * @param string $to - Dirección de correo del destinatario
     * @param string $subject - Asunto del correo
     * @param string $message - Contenido del mensaje en formato HTML
     * @param array $tmp_paths - Array con rutas temporales de archivos a adjuntar
     * @return bool - True si el envío fue exitoso, False si hubo error
     */
    function send_email($to, $subject, $message, $tmp_paths = [])
    {
        // Inicialización de PHPMailer con manejo de excepciones
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();                                      // Uso de protocolo SMTP
            $mail->Host = 'mail.muninuevochimbote.gob.pe';        // Servidor SMTP
            $mail->SMTPAuth = true;                               // Habilitación de autenticación SMTP
            $mail->Username = 'huecos@muninuevochimbote.gob.pe';  // Usuario SMTP
            $mail->Password = 'MDNCH*2025';                       // Contraseña SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;      // Habilitación de cifrado TLS
            $mail->Port = 465;                                    // Puerto TCP para conexión

            // Configuración de los parámetros del correo
            $mail->CharSet = 'UTF-8';                             // Conjunto de caracteres
            $mail->Encoding = 'base64';                           // Codificación del mensaje
            $mail->setFrom('huecos@muninuevochimbote.gob.pe', 'Daño en la calle publica'); // Remitente
            $mail->addAddress('huecos@muninuevochimbote.gob.pe'); // Destinatario principal (municipalidad)
            
            // Verificación de email del usuario antes de agregarlo como destinatario
            if (filter_var($to, FILTER_VALIDATE_EMAIL)) {
                $mail->addAddress($to); // Agrega el email del usuario si es válido
            }
            
            $mail->Subject = $subject;                            // Asunto del correo

            // Procesamiento y adjunto de imágenes desde las rutas temporales proporcionadas
            if (!empty($tmp_paths)) {
                foreach ($tmp_paths as $tmp_path) {
                    if (file_exists($tmp_path)) {
                        $mail->addAttachment($tmp_path, basename($tmp_path));
                    }
                }

                // Adición de información sobre los archivos adjuntos al mensaje
                $message .= "<p>Se han adjuntado " . count($tmp_paths) . " imágenes como evidencia.</p>";
            }

            // Configuración del cuerpo del mensaje
            $mail->Body = $message;                               // Cuerpo del mensaje
            $mail->isHTML(true);                                  // Formato HTML para el mensaje

            // Envío del correo
            $mail->send();
            return true;
        } catch (Exception $e) {
            // Manejo de errores durante el envío
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
            return false;
        }
    }
}
?>