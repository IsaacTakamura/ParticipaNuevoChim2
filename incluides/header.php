<style>
    .navbar-text {
        display: flex;
        align-items: center;
    }

    .navbar-nav .nav-link {
        color: #000000;
        transition: background-color 0.3s ease;
        border-radius: 5px;
        /* Añadir bordes redondeados */
    }

    .navbar-nav .nav-link:hover {
        background-color: #FFC107;
        color: #000000;
        border-radius: 7px;
        /* Añadir bordes redondeados */
        font-family: "Raleway", serif;
    }

    .nav-item {
        margin-right: 10px;
        border-radius: 5px;
        /* Añadir bordes redondeados */
    }

    .header {

        display: grid;
        grid-template-columns: 80% 20%;
        position: relative;

        background-image: url('../images/HeaderPlazaMayor.png');
        background-size: cover;
        background-position: center;
    }

    .button-container {
        display: flex;
        background-color: rgba(0, 73, 144);
        width: 250px;
        height: 40px;
        align-items: center;
        justify-content: space-around;
        border-radius: 10px;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px,
            rgba(0, 73, 144, 0.5) 5px 10px 15px;
        transition: all 0.5s;
    }

    .button-container:hover {
        width: 300px;
        transition: all 0.5s;
        transform: translateY(-3px);
    }

    .button {
        outline: 1 !important;
        border: 1 !important;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: transparent;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        transition: all ease-in-out 0.3s;
        cursor: pointer;
    }

    .button:hover {
        transform: translateY(-3px);
    }

    .icon {
        font-size: 20px;
    }

    .header-right {}

    .header-left {
        background-color: #D1D1D1;
        clip-path: polygon(0 0, 80% 0, 70% 100%, 0% 100%);
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
                    <img src="../images/logo.png" alt="Logo" width="180" height="50">
                </a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><b>Quienes somos?</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><b>Como tu opinion aporta?</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><b>Dejar tu comentario</b></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><b>Campañas</b></a>
                        </li>
                    </ul>
                </div>
            </nav>
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