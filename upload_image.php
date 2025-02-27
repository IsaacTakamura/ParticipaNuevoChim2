<?php
/**
 * Este script maneja el proceso de carga de archivos y guarda la URL del archivo en la base de datos.
 * 
 * 
 * Incluye:
 * - data/db_connection.php: Archivo de conexión a la base de datos.
 * 
 * Funcionalidad:
 * - Comprueba si el método de petición es POST y si se ha subido un fichero.
 * Establece el directorio de destino para los archivos subidos.
 * Valida el fichero subido:
 * Comprueba si el archivo es una imagen real.
 * Comprueba si el archivo ya existe.
 * Comprueba el tamaño del archivo (límite: 5 MB).
 * Sólo admite determinados formatos de archivo (JPG, JPEG, PNG, GIF, BMP, PDF).
 * - Si la validación pasa, mueve el archivo subido al directorio de destino.
 * Guarda la URL del archivo en la base de datos.
 * 
 * Variables:
 * - $dir_destino: Directorio donde se almacenarán los archivos subidos.
 * - $archivo_destino: Ruta completa del fichero destino.
 * - $uploadOk: Bandera para determinar si la carga de archivos debe proceder.
 * - $imageFileType: Extensión del archivo subido.
 * - $check: Resultado de la función getimagesize() para comprobar si el archivo es una imagen.
 * - $foto_url: URL del archivo subido que se guardará en la base de datos.
 * - $sql: Consulta SQL para insertar la URL del archivo en la base de datos.
 * 
 * Tratamiento de errores:
 * Mensajes de error para varios fallos de validación.
 * Mensajes de éxito para la carga de archivos y la inserción en la base de datos.
 */
include_once 'data/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["adjunto"])) {
    $target_dir = "ImgSubidas/";
    $target_file = $target_dir . basename($_FILES["adjunto"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["adjunto"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["adjunto"]["size"] > 5000000) { // 5MB limit
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "bmp" && $imageFileType != "pdf"
    ) {
        echo "Sorry, only JPG, JPEG, PNG, GIF, BMP & PDF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["adjunto"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["adjunto"]["name"])) . " has been uploaded.";
            // Save the file URL to the database
            $foto_url = $target_file;
            $stmt = $conn->prepare("INSERT INTO reportes (foto_url) VALUES (?)");
            $stmt->bind_param("s", $foto_url);
            if ($stmt->execute()) {
                echo "File URL saved to database.";
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>