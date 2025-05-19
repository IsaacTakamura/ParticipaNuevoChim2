<?php
function generate_email_content($Nombres, $descripcion, $Direccion)
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
        <p><strong>Dirección:</strong> $Direccion</p>
        <p>Saludos,<br>Equipo de ParticipaNuevoChimbotano</p>
    </body>
    </html>";

    return $message;
}
?>
