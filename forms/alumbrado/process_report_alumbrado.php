<?php
/**
 * Procesamiento de reportes de alumbrado público
 * 
 * Este script maneja la recepción y procesamiento de reportes de problemas
 * de alumbrado público enviados desde un formulario.
 */

// Inclusión de archivos necesarios para la funcionalidad
require_once '../../data/db_connection.php'; // Conexión a la base de datos
require_once 'send_email.php'; // Funciones para envío de correos
require_once __DIR__ . '/../../vendor/autoload.php'; // Autoloader de dependencias
require_once '../../email_template.php'; // Plantilla de correo electrónico

// Verificamos que la solicitud sea mediante método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura de datos del formulario con operador de fusión null (??)
    $Nombres = $_POST['Nombres'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $TipoIdentificacion = $_POST['TipoIdentificacion'] ?? '';
    $idUsuario = $_POST['docNumber'] ?? '';
    $Telefono = $_POST['Telefono'] ?? '';
    $email = $_POST['email'] ?? '';
    $Direccion = $_POST['Direccion'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $categoria_id = 1; // ID fijo para la categoría de alumbrado público

    // Validación de campos obligatorios
    if (empty($Nombres) || empty($email) || empty($descripcion)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Verificación de carga de imágenes (al menos 1 foto es obligatoria)
    if (empty($_FILES['photos']['name'][0])) {
        die("Debes subir al menos 1 foto");
    }

    // Limitación de número de fotos (máximo 3)
    if (count($_FILES['photos']['name']) > 3) {
        die("Máximo 3 fotos permitidas");
    }

    // Creación del directorio para almacenar las imágenes si no existe
    $upload_dir = __DIR__ . '/uploads/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // Procesamiento de cada foto subida
    $foto_paths = [];
    foreach ($_FILES['photos']['tmp_name'] as $key => $tmp_name) {
        if ($_FILES['photos']['error'][$key] === UPLOAD_ERR_OK) {
            // Obtener y validar la extensión del archivo
            $extension = strtolower(pathinfo($_FILES['photos']['name'][$key], PATHINFO_EXTENSION));
            $allowed_extensions = ['jpg', 'jpeg', 'png'];

            // Saltar archivos con extensiones no permitidas
            if (!in_array($extension, $allowed_extensions)) continue;

            // Generar nombre único para el archivo
            $unique_name = uniqid('img_', true) . '.' . $extension;
            $destination = $upload_dir . $unique_name;

            // Compresión de imágenes mayores a 2MB
            if ($_FILES['photos']['size'][$key] > 2 * 1024 * 1024) {
                $image = null;
                // Crear recurso de imagen según extensión
                if ($extension === 'jpg' || $extension === 'jpeg') {
                    $image = imagecreatefromjpeg($tmp_name);
                } elseif ($extension === 'png') {
                    $image = imagecreatefrompng($tmp_name);
                }

                // Comprimir la imagen iterativamente reduciendo calidad hasta lograr tamaño adecuado
                if ($image) {
                    $quality = 85;
                    do {
                        imagejpeg($image, $destination, $quality);
                        $quality -= 5;
                    } while (filesize($destination) > 2 * 1024 * 1024 && $quality > 10);
                    imagedestroy($image);
                }
            } else {
                // Mover archivo directamente si no requiere compresión
                move_uploaded_file($tmp_name, $destination);
            }

            // Guardar ruta de la imagen para uso posterior
            $foto_paths[] = $destination;
        }
    }

    // Obtener conexión a base de datos
    $conn = Database::getInstance()->getConnection();

    // Insertar o actualizar información del usuario
    $stmt = $conn->prepare("INSERT INTO usuario (idUsuario, TipoIdentificacion, Nombres, Apellidos, Telefono, Direccion, Correo) VALUES (?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE TipoIdentificacion=VALUES(TipoIdentificacion), Nombres=VALUES(Nombres), Apellidos=VALUES(Apellidos), Telefono=VALUES(Telefono), Direccion=VALUES(Direccion), Correo=VALUES(Correo)");
    $stmt->bind_param("issssss", $idUsuario, $TipoIdentificacion, $Nombres, $apellidos, $Telefono, $Direccion, $email);
    if (!$stmt->execute()) {
        echo "Error al insertar el usuario: " . $stmt->error;
        exit;
    }
    $stmt->close();

    // Insertar el reporte en la base de datos
    $stmt = $conn->prepare("INSERT INTO reportes (usuario_id, categoria_id, descripcion, Direccion) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $idUsuario, $categoria_id, $descripcion, $Direccion);
    if (!$stmt->execute()) {
        echo "Error al insertar el reporte: " . $stmt->error;
        exit;
    }
    $stmt->close();

    // Enviar correo de confirmación al usuario
    $subject = "Confirmación de reporte de alumbrado público";
    $message = generate_email_content($Nombres, $descripcion, $Direccion, $foto_paths[0] ?? null);
    if (!send_email($email, $subject, $message, $foto_paths)) {
        echo "Error al enviar el correo de confirmación.";
    }

    // Cerrar conexión y redirigir a página de confirmación
    $conn->close();
    header("Location: ../../confirmacion/confirmacion.php");
    exit;
} else {
    // Respuesta en caso de que el método de solicitud no sea POST
    echo "Método no permitido.";
}
?>