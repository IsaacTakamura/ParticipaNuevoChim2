<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes Ciudadanos</title>

    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap"
        rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Mantener los CSS originales -->
    <link rel="stylesheet" href="/ParticipaNuevoChim2/css/override.css">

    <!-- Agregar Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            200: '#a7f3d0',
                            300: '#6ee7b7',
                            400: '#34d399',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                            950: '#022c22',
                        },
                    },
                }
            }
        }
    </script>

</head>

<body class="bg-gray-50">
    <?php include 'incluides/header.php'; ?>

    <!-- Contenedor de fondo -->
    <div class="background-image"></div>

    <!-- Contenido Principal -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Título Principal -->
        <h1 class="text-3xl md:text-4xl font-bold text-center text-emerald-700 mb-8">Yo Participo</h1>



        <!-- Sección Yo Participo -->
        <section class="relative bg-white rounded-lg shadow-md p-6 mb-10 border-l-4 border-l-emerald-500">
            <div class="contentm">
                <h1 class="text-xl font-bold text-emerald-700 mb-2">
                    Conoce "Yo Participo", espacio de participación ciudadana en Nuevo Chimbote
                </h1>
            </div>
            <br>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Basura -->
                <a href="/ParticipaNuevoChim2/forms/BASURA/basura.php"
                    class="menu-item block bg-white rounded-lg border border-gray-200 p-4 text-center hover:border-emerald-500 hover:bg-emerald-50">
                    <div class="image-container"">
                        <img src="/ParticipaNuevoChim2/images/basura.png" alt="Basura" class="mx-auto">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Basura</h3>
                    <p class="text-sm text-gray-500">Reporta residuos en la calle.</p>
                </a>

                <!-- Alumbrado Público -->
                <a href="/ParticipaNuevoChim2/forms/alumbrado/alumbrado.php"
                    class="menu-item block bg-white rounded-lg border border-gray-200 p-4 text-center hover:border-emerald-500 hover:bg-emerald-50">
                    <div class="image-container"">
                        <img src="/ParticipaNuevoChim2/images/alumbrado.png" alt="Alumbrado Público" class="mx-auto">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Alumbrado Público</h3>
                    <p class="text-sm text-gray-500">Reporta farolas dañadas o apagadas.</p>
                </a>

                <!-- Baches -->
                <a href="/ParticipaNuevoChim2/forms/baches/baches.php"
                    class="menu-item block bg-white rounded-lg border border-gray-200 p-4 text-center hover:border-emerald-500 hover:bg-emerald-50">
                    <div class="image-container"">
                        <img src="/ParticipaNuevoChim2/images/baches.png" alt="Baches" class="mx-auto">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Baches</h3>
                    <p class="text-sm text-gray-500">Informa sobre daños en las calles.</p>
                </a>

                <!-- Espacios Públicos -->
                <a href="/ParticipaNuevoChim2/forms/espaciosPublicos/espacio.php"
                    class="menu-item block bg-white rounded-lg border border-gray-200 p-4 text-center hover:border-emerald-500 hover:bg-emerald-50">
                    <div class="image-container"">
                        <img src="/ParticipaNuevoChim2/images/espaciospublico.png" alt="Espacios Públicos" class="mx-auto">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Espacios Públicos</h3>
                    <p class="text-sm text-gray-500">Notifica problemas en parques o plazas.</p>
                </a>

            </div>
            <br>
            <div class="text-center mb-8">
                <p class="text-gray-600 mt-2">
                    Recogeremos y atenderemos tus necesidades. Reporta huecos, fallas en alumbrado público,
                    recolección
                    de
                    basura o inconvenientes.
                </p>
            </div>

        </section>

        <!-- Sección de Reportes -->
    </div>


    <!-- Script para animaciones (opcional) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuItems = document.querySelectorAll('.menu-item');

            menuItems.forEach(item => {
                item.addEventListener('mouseenter', function () {
                    this.classList.add('shadow-lg');
                });

                item.addEventListener('mouseleave', function () {
                    this.classList.remove('shadow-lg');
                });
            });
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
</body>

</html>