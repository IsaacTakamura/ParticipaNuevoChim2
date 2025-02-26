<?php
require_once '../../data/db_connection.php'; // Asegúrate de que este archivo existe y tiene la conexión correcta
require_once 'send_email.php';
require_once '../../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta
require_once '../../upload_image.php'; // Asegúrate de que este archivo existe y tiene la conexión correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nombres = $_POST['Nombres'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $TipoIdentificacion = $_POST['TipoIdentificacion'] ?? '';
    $idUsuario = $_POST['docNumber'] ?? ''; // Usar el número de documento como idUsuario
    $Telefono = $_POST['Telefono'] ?? '';
    $email = $_POST['email'] ?? '';
    $Direccion = $_POST['Direccion'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $categoria_id = 4; // Basura por defecto

    if (empty($Nombres) || empty($email) || empty($descripcion)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Subir la foto
    $foto_url = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $foto_url = upload_image($_FILES['photo']);
    }

    // Obtener la instancia de la base de datos
    $conn = Database::getInstance()->getConnection();

    // Insertar usuario si no existe
    $stmt = $conn->prepare("INSERT INTO usuario (idUsuario, TipoIdentificacion, Nombres, Apellidos, Telefono, Direccion, Correo) VALUES (?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE TipoIdentificacion=VALUES(TipoIdentificacion), Nombres=VALUES(Nombres), Apellidos=VALUES(Apellidos), Telefono=VALUES(Telefono), Direccion=VALUES(Direccion), Correo=VALUES(Correo)");
    $stmt->bind_param("issssss", $idUsuario, $TipoIdentificacion, $Nombres, $apellidos, $Telefono, $Direccion, $email);
    if (!$stmt->execute()) {
        echo "Error al insertar el usuario: " . $stmt->error;
        exit;
    }
    $stmt->close();

    // Insertar reporte
    $stmt = $conn->prepare("INSERT INTO reportes (usuario_id, categoria_id, descripcion, Direccion, foto_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iisss", $idUsuario, $categoria_id, $descripcion, $Direccion, $foto_url);
    if (!$stmt->execute()) {
        echo "Error al insertar el reporte: " . $stmt->error;
        exit;
    }
    $stmt->close();

    // Enviar correo electrónico de confirmación
    $subject = "Confirmación de reporte de basura";
    $message = "Hola $Nombres,\n\nGracias por enviar tu reporte. Hemos recibido la siguiente información:\n\nDescripción: $descripcion\nDirección: $Direccion\n\nSaludos,\nEquipo de ParticipaNuevoChimbotano";
    if (!send_email($email, $subject, $message)) {
        echo "Error al enviar el correo de confirmación.";
    }

    $conn->close();
    echo "Reporte enviado correctamente.";
} else {
    echo "Método no permitido.";
}
?>