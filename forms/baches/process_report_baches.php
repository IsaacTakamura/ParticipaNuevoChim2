<?php
/**
 * Procesamiento de reportes de baches
 * 
 * Este script maneja la recepción y procesamiento del formulario de reporte de baches,
 * incluyendo la validación de datos, almacenamiento de imágenes y registro en la base de datos.
 */

// Importación de archivos necesarios
require_once __DIR__ . '/../../data/db_connection.php'; // Conexión a la base de datos
require_once __DIR__ . '/send_email.php';               // Funciones para envío de correos
require_once __DIR__ . '/../../vendor/autoload.php'; // Carga de dependencias
require_once __DIR__ . '/../../email_template.php';     // Plantilla de correo electrónico

// Verificar que la petición sea de tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura de datos del formulario con operador de fusión null
    $Nombres = $_POST['Nombres'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $TipoIdentificacion = $_POST['TipoIdentificacion'] ?? '';
    $idUsuario = $_POST['docNumber'] ?? '';
    $Telefono = $_POST['Telefono'] ?? '';
    $email = $_POST['email'] ?? '';
    $Direccion = $_POST['Direccion'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $categoria_id = 4; // ID fijo para la categoría de baches

    // Validación de campos obligatorios
    if (empty($Nombres) || empty($email) || empty($descripcion)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Verificación de carga de imágenes
    if (empty($_FILES['photos']['name'][0])) {
        die("Debes subir al menos 1 foto");
    }

    // Control de límite máximo de fotos
    if (count($_FILES['photos']['name']) > 3) {
        die("Máximo 3 fotos permitidas");
    }

    // Preparación del directorio para almacenar las imágenes
    $upload_dir = __DIR__ . '/uploads/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    // Procesamiento y almacenamiento de las imágenes
    $foto_paths = [];
    foreach ($_FILES['photos']['tmp_name'] as $key => $tmp_name) {
        if ($_FILES['photos']['error'][$key] === UPLOAD_ERR_OK) {
            // Validación de extensiones permitidas
            $extension = strtolower(pathinfo($_FILES['photos']['name'][$key], PATHINFO_EXTENSION));
            $allowed_extensions = ['jpg', 'jpeg', 'png'];

            if (!in_array($extension, $allowed_extensions)) continue;

            // Generación de nombre único para la imagen
            $unique_name = uniqid('img_', true) . '.' . $extension;
            $destination = $upload_dir . $unique_name;

            // Compresión de imágenes que superen los 2MB
            if ($_FILES['photos']['size'][$key] > 2 * 1024 * 1024) {
                $image = null;
                if ($extension === 'jpg' || $extension === 'jpeg') {
                    $image = imagecreatefromjpeg($tmp_name);
                } elseif ($extension === 'png') {
                    $image = imagecreatefrompng($tmp_name);
                }

                if ($image) {
                    // Reducción progresiva de calidad hasta conseguir tamaño aceptable
                    $quality = 85;
                    do {
                        imagejpeg($image, $destination, $quality);
                        $quality -= 5;
                    } while (filesize($destination) > 2 * 1024 * 1024 && $quality > 10);
                    imagedestroy($image);
                }
            } else {
                // Si la imagen no supera el límite, se mueve directamente
                move_uploaded_file($tmp_name, $destination);
            }

            $foto_paths[] = $destination;
        }
    }

    // Conexión a la base de datos
    $conn = Database::getInstance()->getConnection();

    // Inserción o actualización de datos del usuario (patrón UPSERT)
    $stmt = $conn->prepare("INSERT INTO usuario (idUsuario, TipoIdentificacion, Nombres, Apellidos, Telefono, Direccion, Correo) VALUES (?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE TipoIdentificacion=VALUES(TipoIdentificacion), Nombres=VALUES(Nombres), Apellidos=VALUES(Apellidos), Telefono=VALUES(Telefono), Direccion=VALUES(Direccion), Correo=VALUES(Correo)");
    $stmt->bind_param("issssss", $idUsuario, $TipoIdentificacion, $Nombres, $apellidos, $Telefono, $Direccion, $email);
    if (!$stmt->execute()) {
        echo "Error al insertar el usuario: " . $stmt->error;
        exit;
    }
    $stmt->close();

    // Registro del reporte en la base de datos
    $stmt = $conn->prepare("INSERT INTO reportes (usuario_id, categoria_id, descripcion, Direccion) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $idUsuario, $categoria_id, $descripcion, $Direccion);
    if (!$stmt->execute()) {
        echo "Error al insertar el reporte: " . $stmt->error;
        exit;
    }
    $reporte_id = $stmt->insert_id; // Captura del ID generado para el reporte
    $stmt->close();

    // Envío de correo de confirmación al usuario
    $subject = "Confirmación de reporte de baches";
    $message = generate_email_content($Nombres, $descripcion, $Direccion, $foto_paths);
    if (!send_email($email, $subject, $message, $foto_paths)) {
        echo "Error al enviar el correo de confirmación.";
    }

    // Cierre de la conexión y redirección a página de confirmación
    $conn->close();
    header("Location: ../../confirmacion/confirmacion.php");
    exit;
} else {
    // Si la petición no es POST, mostrar error
    echo "Método no permitido.";
}

// このプロジェクトは Isaac Ivanov Takamura Rojas によって作成されました
?>