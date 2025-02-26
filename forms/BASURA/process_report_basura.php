<?php
require_once '../../data/db_connection.php';
require_once 'send_email.php';
require_once '../../vendor/autoload.php';
require_once '../../upload_image.php';
require_once '../../email_template.php';

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

    $foto_url = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $foto_url = upload_image($_FILES['photo']);
    }

    $conn = Database::getInstance()->getConnection();

    $stmt = $conn->prepare("INSERT INTO usuario (idUsuario, TipoIdentificacion, Nombres, Apellidos, Telefono, Direccion, Correo) VALUES (?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE TipoIdentificacion=VALUES(TipoIdentificacion), Nombres=VALUES(Nombres), Apellidos=VALUES(Apellidos), Telefono=VALUES(Telefono), Direccion=VALUES(Direccion), Correo=VALUES(Correo)");
    $stmt->bind_param("issssss", $idUsuario, $TipoIdentificacion, $Nombres, $apellidos, $Telefono, $Direccion, $email);
    if (!$stmt->execute()) {
        echo "Error al insertar el usuario: " . $stmt->error;
        exit;
    }
    $stmt->close();

    $stmt = $conn->prepare("INSERT INTO reportes (usuario_id, categoria_id, descripcion, Direccion, foto_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $idUsuario, $categoria_id, $descripcion, $Direccion, $foto_url);
    if (!$stmt->execute()) {
        echo "Error al insertar el reporte: " . $stmt->error;
        exit;
    }
    $stmt->close();

    $subject = "Confirmación de reporte de basura";
    $message = generate_email_content($Nombres, $descripcion, $Direccion, $foto_url);
    if (!send_email($email, $subject, $message, [$foto_url])) {
        echo "Error al enviar el correo de confirmación.";
    }

    $conn->close();
    header("Location: ../../confirmacion/confirmacion.php");
    exit;
} else {
    echo "Método no permitido.";
}
?>