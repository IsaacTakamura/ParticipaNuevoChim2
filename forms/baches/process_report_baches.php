<?php
require_once '../../data/db_connection.php';
require_once 'send_email.php';
require_once '../../vendor/autoload.php';
require_once '../../email_template.php';

// Eliminar cualquier referencia a upload_image.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nombres = $_POST['Nombres'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $TipoIdentificacion = $_POST['TipoIdentificacion'] ?? '';
    $idUsuario = $_POST['docNumber'] ?? '';
    $Telefono = $_POST['Telefono'] ?? '';
    $email = $_POST['email'] ?? '';
    $Direccion = $_POST['Direccion'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $categoria_id = 4;

    if (empty($Nombres) || empty($email) || empty($descripcion)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Verificar que se subió al menos 1 foto
    if (empty($_FILES['photos']['name'][0])) {
        die("Debes subir al menos 1 foto");
    }

    // Limitar a 3 fotos máximo
    if (count($_FILES['photos']['name']) > 3) {
        die("Máximo 3 fotos permitidas");
    }

    // Procesar las fotos subidas
    $foto_urls = [];
    //revisar este codigo porque ya no deberia ser necesario
    $upload_dir = '../../uploads/';
    foreach ($_FILES['photos']['tmp_name'] as $key => $tmp_name) {
        if ($_FILES['photos']['error'][$key] === UPLOAD_ERR_OK) {
            $file_name = uniqid() . '_' . basename($_FILES['photos']['name'][$key]);
            $target_file = $upload_dir . $file_name;
            if (move_uploaded_file($tmp_name, $target_file)) {
                $foto_urls[] = $target_file;
            }
        }
    }

    $conn = Database::getInstance()->getConnection();

    $stmt = $conn->prepare("INSERT INTO usuario (idUsuario, TipoIdentificacion, Nombres, Apellidos, Telefono, Direccion, Correo) VALUES (?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE TipoIdentificacion=VALUES(TipoIdentificacion), Nombres=VALUES(Nombres), Apellidos=VALUES(Apellidos), Telefono=VALUES(Telefono), Direccion=VALUES(Direccion), Correo=VALUES(Correo)");
    $stmt->bind_param("issssss", $idUsuario, $TipoIdentificacion, $Nombres, $apellidos, $Telefono, $Direccion, $email);
    if (!$stmt->execute()) {
        echo "Error al insertar el usuario: " . $stmt->error;
        exit;
    }
    $stmt->close();

    $stmt = $conn->prepare("INSERT INTO reportes (usuario_id, categoria_id, descripcion, Direccion) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $idUsuario, $categoria_id, $descripcion, $Direccion);
    if (!$stmt->execute()) {
        echo "Error al insertar el reporte: " . $stmt->error;
        exit;
    }
    $reporte_id = $stmt->insert_id;
    $stmt->close();

    // Guardar las fotos en la base de datos (opcional, si tienes una tabla de fotos)
    if (!empty($foto_urls)) {
        $stmt = $conn->prepare("INSERT INTO fotos (reporte_id, url) VALUES (?, ?)");
        foreach ($foto_urls as $url) {
            $stmt->bind_param("is", $reporte_id, $url);
            $stmt->execute();
        }
        $stmt->close();
    }

    $subject = "Confirmación de reporte de baches";
    $message = generate_email_content($Nombres, $descripcion, $Direccion, $foto_urls);
    if (!send_email($email, $subject, $message, $foto_urls)) {
        echo "Error al enviar el correo de confirmación.";
    }

    $conn->close();
    header("Location: ../../confirmacion/confirmacion.php");
    exit;
} else {
    echo "Método no permitido.";
}
?>