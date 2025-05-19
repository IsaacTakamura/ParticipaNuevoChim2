<?php
function generate_email_content($Nombres, $descripcion, $Direccion)
{
    $num_photos = isset($_FILES['photos']['name']) ? count($_FILES['photos']['name']) : 0;

    $message = "
    <html>
    <head>
        <title>Confirmación de reporte</title>
    </head>
    <body>
        <h1>Hola $Nombres,</h1>
        <p>Gracias por enviar tu reporte. Hemos recibido la siguiente información:</p>
        <p><strong>Descripción:</strong> $descripcion</p>
        <p><strong>Dirección:</strong> $Direccion</p>
        <p><strong>Fotos adjuntas:</strong> $num_photos imágenes</p>
        <p>Saludos,<br>Equipo de ParticipaNuevoChimbotano</p>
    </body>
    </html>";

    return $message;
}
?>
