<?php
/**
 * Archivo: send_email.php
 * Descripción: Contiene la función para enviar correos electrónicos utilizando PHPMailer.
 * Este archivo permite el envío de correos con archivos adjuntos, principalmente
 * para la notificación de reportes de basura.
 */

// Importación de las clases necesarias de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Carga del autoloader de Composer para cargar las dependencias
require_once __DIR__ . '/../../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta

// Verifica si la función ya existe para evitar redefiniciones
if (!function_exists('send_email')) {
    /**
     * Envía un correo electrónico de confirmación después de recibir un reporte
     * 
     * @param string $to       Dirección de correo electrónico del destinatario
     * @param string $subject  Asunto del correo
     * @param string $message  Contenido del mensaje en formato HTML
     * @param array $tmp_paths Rutas temporales de las imágenes a adjuntar (opcional)
     * 
     * @return boolean Retorna true si el correo se envió exitosamente, false en caso de error
     */
    function send_email($to, $subject, $message, $tmp_paths = [])
    {
        // Inicialización de la instancia PHPMailer con manejo de excepciones habilitado
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();                                      // Establecer el uso de SMTP
            $mail->Host = 'mail.muninuevochimbote.gob.pe';        // Servidor SMTP
            $mail->SMTPAuth = true;                               // Habilitar autenticación SMTP
            $mail->Username = 'basura@muninuevochimbote.gob.pe';  // Usuario SMTP
            $mail->Password = 'MDNCH*2025';                       // Contraseña SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;      // Habilitar cifrado TLS implícito
            $mail->Port = 465;                                    // Puerto TCP para conectarse

            // Configuración del formato y codificación del correo
            $mail->CharSet = 'UTF-8';                             // Juego de caracteres
            $mail->Encoding = 'base64';                           // Codificación del mensaje
            
            // Configuración de remitente y destinatarios
            $mail->setFrom('basura@muninuevochimbote.gob.pe', 'Reporte de Basura'); // Remitente
            $mail->addAddress('basura@muninuevochimbote.gob.pe');  // Correo principal de la municipalidad
            
            // Validar y agregar el correo del usuario si es válido
            if (filter_var($to, FILTER_VALIDATE_EMAIL)) {
                $mail->addAddress($to); // Solo se agrega si el correo es válido
            }
            
            // Configuración del contenido del correo
            $mail->Subject = $subject;                            // Asunto del correo
            $mail->isHTML(true);                                  // Formato HTML habilitado

            // Procesar archivos adjuntos si existen
            if (!empty($tmp_paths)) {
                // Recorrer cada ruta de archivo temporal
                foreach ($tmp_paths as $tmp_path) {
                    // Verificar que el archivo exista antes de adjuntarlo
                    if (file_exists($tmp_path)) {
                        $mail->addAttachment($tmp_path, basename($tmp_path));
                    }
                }

                // Agregar información sobre los archivos adjuntos al mensaje
                $message .= "<p>Se han adjuntado " . count($tmp_paths) . " imágenes como evidencia.</p>";
            }

            // Asignar el contenido del mensaje
            $mail->Body = $message;

            // Enviar el correo
            $mail->send();
            return true; // Retornar éxito
        } catch (Exception $e) {
            // Capturar y mostrar cualquier error durante el envío
            echo "Error al enviar el correo: {$e->getMessage()}";
            return false; // Retornar fracaso
        }
    }
}
?>