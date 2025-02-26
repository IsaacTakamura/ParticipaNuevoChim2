<?php
function generate_email_content($Nombres, $descripcion, $Direccion, $foto_url)
{
    $message = "
    <html>
    <head>
        <title>Confirmación de reporte</title>
    </head>
    <body>
        <h1>Hola $Nombres,</h1>
        <p>Gracias por enviar tu reporte. Hemos recibido la siguiente información:</p>
        <p><strong>Descripción:</strong> $descripcion</p>
        <p><strong>Dirección:</strong> $Direccion</p>";

    if ($foto_url) {
        $message .= "<p><strong>Imagen:</strong></p><img src='$foto_url' alt='Imagen del reporte' style='max-width: 600px;'>";
    }

    $message .= "
        <p>Saludos,<br>Equipo de ParticipaNuevoChimbotano</p>
    </body>
    </html>";

    return $message;
}
?>