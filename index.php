<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes Ciudadanos</title>

    <!-- Mantener los CSS originales -->
    <link rel="stylesheet" href="css/override.css">

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

    <!-- Estilos adicionales -->
    <style>
        .background-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background-size: cover;
            background-position: center;
            opacity: 0.1;
        }

        .highlight {
            width: 4px;
            background-color: #059669;
            height: 100%;
            position: absolute;
            left: 0;
            top: 0;
        }

        .menu-item {
            transition: all 0.3s ease;
        }

        .menu-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
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
                <a href="forms/BASURA/basura.php"
                    class="menu-item block bg-white rounded-lg border border-gray-200 p-4 text-center hover:border-emerald-500 hover:bg-emerald-50">
                    <div class="w-16 h-16 mx-auto bg-emerald-100 rounded-full flex items-center justify-center mb-4">
                        <img src="images/basura.png" alt="Basura" class="w-8 h-8">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Basura</h3>
                    <p class="text-sm text-gray-500">Reporta residuos en la calle.</p>
                </a>

                <!-- Alumbrado Público -->
                <a href="forms/alumbrado/alumbrado.php"
                    class="menu-item block bg-white rounded-lg border border-gray-200 p-4 text-center hover:border-emerald-500 hover:bg-emerald-50">
                    <div class="w-16 h-16 mx-auto bg-emerald-100 rounded-full flex items-center justify-center mb-4">
                        <img src="images/alumbrado.png" alt="Alumbrado Público" class="w-8 h-8">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Alumbrado Público</h3>
                    <p class="text-sm text-gray-500">Reporta farolas dañadas o apagadas.</p>
                </a>

                <!-- Baches -->
                <a href="forms/baches/baches.php"
                    class="menu-item block bg-white rounded-lg border border-gray-200 p-4 text-center hover:border-emerald-500 hover:bg-emerald-50">
                    <div class="w-16 h-16 mx-auto bg-emerald-100 rounded-full flex items-center justify-center mb-4">
                        <img src="images/baches.png" alt="Baches" class="w-8 h-8">
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800">Baches</h3>
                    <p class="text-sm text-gray-500">Informa sobre daños en las calles.</p>
                </a>

                <!-- Espacios Públicos -->
                <a href="forms/espaciosPublicos/espacio.php"
                    class="menu-item block bg-white rounded-lg border border-gray-200 p-4 text-center hover:border-emerald-500 hover:bg-emerald-50">
                    <div class="w-16 h-16 mx-auto bg-emerald-100 rounded-full flex items-center justify-center mb-4">
                        <img src="images/espaciospublico.png" alt="Espacios Públicos" class="w-8 h-8">
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

        <br>
        <!-- Sección de Noticia Principal -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-10">
            <div class="relative">
                <img src="images/gentita.jpg" alt="Imagen de la Noticia" class="w-full h-auto object-cover">
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                    <h2 class="text-white text-xl md:text-2xl font-bold">
                        #YoApoyo: Alcalde invita a ciudadanía a trabajar por Nuevo Chimbote
                    </h2>
                    <p class="text-white text-sm mt-2">
                        El alcalde Walter Soto invita a la ciudadanía a trabajar con el Distrito, con acciones
                        cotidianas.
                    </p>
                </div>
            </div>
        </div>
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
</body>

</html>