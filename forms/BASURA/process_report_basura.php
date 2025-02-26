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
        die("Error: Todos los campos obligatorios deben estar llenos");
    }

    // Subir la foto
    $foto_url = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
        $foto_tmp = $_FILES['photo']['tmp_name'];
        $foto_name = basename($_FILES['photo']['name']);
        $foto_dir = '../../ImgSubidas/' . $foto_name;
        if (move_uploaded_file($foto_tmp, $foto_dir)) {
            $foto_url = $foto_dir;
        }
    }

    // Obtener la instancia de la base de datos
    $conn = Database::getInstance()->getConnection();

    // Insertar usuario si no existe
    $stmt = $conn->prepare("INSERT INTO usuario (idUsuario, TipoIdentificacion, Nombres, Apellidos, Telefono, Direccion, Correo) VALUES (?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE TipoIdentificacion=VALUES(TipoIdentificacion), Nombres=VALUES(Nombres), Apellidos=VALUES(Apellidos), Telefono=VALUES(Telefono), Direccion=VALUES(Direccion), Correo=VALUES(Correo)");
    $stmt->bind_param("issssss", $idUsuario, $TipoIdentificacion, $Nombres, $apellidos, $Telefono, $Direccion, $email);
    if (!$stmt->execute()) {
        echo "Error al insertar el usuario: " . $stmt->error;
        $stmt->close();
        $conn->close();
        exit();
    }
    $stmt->close();

    // Verificar si el usuario se insertó correctamente
    $stmt = $conn->prepare("SELECT idUsuario FROM usuario WHERE idUsuario = ?");
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Insertar reporte
        $stmt = $conn->prepare("INSERT INTO reportes (usuario_id, categoria_id, descripcion, Direccion, foto_url) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", $idUsuario, $categoria_id, $descripcion, $Direccion, $foto_url);

        if ($stmt->execute()) {
            // Crear el cuerpo del correo con todos los datos del reporte
            $message = "
                <h2>Nuevo Reporte de Basura</h2>
                <p><strong>Nombres:</strong> $Nombres</p>
                <p><strong>Apellidos:</strong> $apellidos</p>
                <p><strong>Tipo de Documento:</strong> $TipoIdentificacion</p>
                <p><strong>Número de Documento:</strong> $idUsuario</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Teléfono:</strong> $Telefono</p>
                <p><strong>Dirección:</strong> $Direccion</p>
                <p><strong>Descripción:</strong> $descripcion</p>
                <p><strong>Foto URL:</strong> $foto_url</p>
            ";

            // Enviar correos
            send_email("basura@muninuevochimbote.gob.pe", "Nuevo reporte de basura", $message, [$foto_url]);
            // Redirigir a la página de confirmación
            header("Location: ../../confirmacion/confirmacion.php");
            exit();
        } else {
            echo "Error al guardar el reporte: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error: No se pudo encontrar el usuario.";
        $stmt->close();
    }
    $conn->close();
} else {
    echo "Método no permitido.";
}
?>