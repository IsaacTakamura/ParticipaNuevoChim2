<?php
require_once '../../data/db_connection.php'; // Asegúrate de que este archivo existe y tiene la conexión correcta
require_once 'send_email.php';
require_once '../../vendor/autoload.php'; // Asegúrate de que la ruta sea correcta

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Nombres = $_POST['Nombres'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $TipoIdentificacion = $_POST['TipoIdentificacion'] ?? '';
    $idUsuario = $_POST['docNumber'] ?? ''; // Usar el número de documento como idUsuario
    $Telefono = $_POST['Telefono'] ?? '';
    $email = $_POST['email'] ?? '';
    $Direccion = $_POST['Direccion'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $categoria_id = 1; // Alumbrado público por defecto

    if (empty($Nombres) || empty($email) || empty($descripcion)) {
        die("Error: Todos los campos obligatorios deben estar llenos");
    }

    // Subir las fotos
    $foto_urls = [];
    $attachments = [];
    if (isset($_FILES['photos'])) {
        foreach ($_FILES['photos']['tmp_name'] as $key => $tmp_name) {
            if ($_FILES['photos']['error'][$key] == UPLOAD_ERR_OK) {
                $foto_tmp = $tmp_name;
                $foto_name = basename($_FILES['photos']['name'][$key]);
                $foto_dir = '../../ImgSubidas/' . $foto_name;
                if (move_uploaded_file($foto_tmp, $foto_dir)) {
                    $foto_urls[] = $foto_dir;
                    $attachments[] = $foto_dir;
                }
            }
        }
    }

    // Convertir las rutas de las fotos a una cadena separada por comas
    $foto_urls_str = implode(',', $foto_urls);

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
        $stmt->bind_param("iisss", $idUsuario, $categoria_id, $descripcion, $Direccion, $foto_urls_str);

        if ($stmt->execute()) {
            // Crear el cuerpo del correo con todos los datos del reporte
            $message = "
                <h2>Nuevo Reporte de Alumbrado Público</h2>
                <p><strong>Nombres:</strong> $Nombres</p>
                <p><strong>Apellidos:</strong> $apellidos</p>
                <p><strong>Tipo de Documento:</strong> $TipoIdentificacion</p>
                <p><strong>Número de Documento:</strong> $idUsuario</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Teléfono:</strong> $Telefono</p>
                <p><strong>Dirección:</strong> $Direccion</p>
                <p><strong>Descripción:</strong> $descripcion</p>
                <p><strong>Foto URLs:</strong> $foto_urls_str</p>
            ";

            // Enviar correos
            send_email("alumbradopublico@muninuevochimbote.gob.pe", "Nuevo reporte de deficiencia en alumbrado público", $message, $attachments);
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