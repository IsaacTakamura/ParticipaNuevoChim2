<style>
    .navbar-text {
        display: flex;
        align-items: center;
    }

    .navbar-nav .nav-link {
        color: #000000;
        transition: background-color 0.3s ease;
        border-radius: 3px;
    }

    .nav-item {
        margin-right: 10px;
        border-radius: 3px;
    }

    .header {
        display: grid;
        grid-template-columns: 80% 20%;
        position: relative;
        background-image: url('/ParticipaNuevoChim2/images/HeaderPlazaMayor.png');
        background-size: cover;
        background-position: center;
    }

    .header-right {}

    .header-left {
        background-color: #D1D1D1;
        clip-path: polygon(0 0, 80% 0, 70% 100%, 0% 100%);
    }

    .navbar-separator {
        height: 0.01rem;
        background-color: #4B4B4B;
        /* Dark gray color */
        margin-top: 0;
        margin-bottom: 0;
    }
</style>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <header class="header">
        <div class="header-left">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-img" href="#">
                    <img src="/ParticipaNuevoChim2/images/logo.png" alt="Logo" width="180" height="50">
                </a>
            </nav>
            <div class="navbar-separator"></div>
        </div>
        <div class="header-right"></div>
    </header>
    <!-- Resto del contenido de la página -->
</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>