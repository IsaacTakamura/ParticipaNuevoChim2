<!DOCTYPE html>
<html lang="es">

<head>

  <link rel="stylesheet" href="../css/cartas_index.css">
  <link rel="stylesheet" href="../css/contenedorNoticia.css">
  <link rel="stylesheet" href="../css/CVVDF.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reportes Ciudadanos</title>

</head>

<body>
  <?php include '../incluides/header.php'; ?>

  <!-- Contenedor de fondo -->
  <div class="background-image"></div>

  <!-- Contenido Principal -->
  <div class="content container">
    <h1 style="text-align: center;">Yo participo</h1>
    <div class="noticia">
      <img src="../images/gentita.jpg" alt="Imagen de la Noticia">
      <h2>#YoApoyo: Alcalde invita a ciudadanía a trabajar por Nuevo Chimbote</h2>
      <p>El alcalde Walter Soto invita a la ciudadanía a trabajar con el Distrito, con acciones cotidianas.
      </p>
    </div>
    <section class="yo-participo-section">
      <div class="highlight"></div>
      <div class="contentm">
        <h1>Conoce "Yo Participo", espacio de participación ciudadana en Nuevo Chimbote</h1>
        <p>Yo participo es un espacio dedicado a la ciudadanía. Compártenos tus opiniones sobre esta hermosa ciudad.
          ¡Construye tu ciudad!</p>
      </div>
    </section>

    <div class="cuadrado">
      <div class="report-container">
        <a href="" class="menu-item">
          <div class="menu-item-titulo">
            <h2>Reporta</h2>
          </div>
          <div class="menu-item-text">
            <p>Recogeremos y atenderemos tus necesidades. Reporta huecos, fallas en alumbrado público, recolección de
              basuras
              o inconvenientes.</p>
          </div>
        </a>

        <a href="../forms/BASURA/basura.php" class="menu-item">
          <div class="menu-item-image">
            <img src="../images/basura.png" alt="Basura">
          </div>
          <div class="menu-item-text">
            <h3>Basura</h3>
            <sub>Reporta residuos en la calle.</sub>
          </div>
        </a>

        <a href="../forms/alumbrado/alumbrado.php" class="menu-item">
          <div class="menu-item-image">
            <img src="../images/alumbrado.png" alt="Alumbrado Público">
          </div>
          <div class="menu-item-text">
            <h3>Alumbrado Público</h3>
            <sub>Reporta farolas dañadas o apagadas.</sub>
          </div>
        </a>

        <a href="../forms/baches/baches.php" class="menu-item">
          <div class="menu-item-image">
            <img src="../images/baches.png" alt="Baches">
          </div>
          <div class="menu-item-text">
            <h3>Baches</h3>
            <sub>Informa sobre daños en las calles.</sub>
          </div>
        </a>

        <a href="../forms/espaciosPublicos/espacio.php" class="menu-item">
          <div class="menu-item-image">
            <img src="../images/espaciospublico.png" alt="Espacios Públicos">
          </div>
          <div class="menu-item-text">
            <h3>Espacios Públicos</h3>
            <sub>Notifica problemas en parques o plazas.</sub>
          </div>
        </a>
      </div>
    </div>

  </div>

</body>

</html>