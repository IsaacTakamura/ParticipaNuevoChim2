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

  <!-- Botón para mostrar el chatbot con notificación -->
  <button class="chatbot-toggle" onclick="toggleChatbot()">
    <img src="../images/message-icon.png" alt="Mensaje pendiente" style="width: 24px; height: 24px;">
    <span class="notification-bubble" id="notification-bubble">1</span>
  </button>

  <!-- Chatbot -->
  <div class="chatbot-container" id="chatbot-container">
    <div class="chatbot-header">
      <h3>Chatbot</h3>
    </div>
    <div class="chatbot-messages" id="chatbot-messages">
      <div class="message bot-message">Bienvenido Nuevo Chimbotano, estoy aquí para resolver tus dudas</div>
    </div>
    <div class="chatbot-input">
      <input type="text" id="user-input" placeholder="Escribe tu mensaje...">
      <button onclick="sendMessage()">Enviar</button>
    </div>
  </div>

  <style>
    /* Botón flotante para abrir el chat */
    .chatbot-toggle {
      position: fixed;
      bottom: 20px;
      right: 180px;
      /* Se mantiene a la izquierda */
      padding: 10px;
      background-color: #007bff;
      color: #fff;
      border: none;
      border-radius: 50%;
      cursor: pointer;
      z-index: 9999;
      /* Aumentado para que siempre esté por encima */
      display: flex;
      align-items: center;
      justify-content: center;
      width: 50px;
      height: 50px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Burbuja de notificación */
    .notification-bubble {
      position: absolute;
      top: 2px;
      /* Ajustado para que no se vea desplazado */
      right: 2px;
      /* Ajustado para mejor alineación */
      background-color: red;
      color: white;
      font-size: 12px;
      font-weight: bold;
      padding: 4px 8px;
      border-radius: 50%;
      display: none;
      animation: pulse 1.5s infinite;
    }

    /* Animación de la burbuja */
    @keyframes pulse {
      0% {
        transform: scale(1);
        opacity: 1;
      }

      50% {
        transform: scale(1.2);
        opacity: 0.8;
      }

      100% {
        transform: scale(1);
        opacity: 1;
      }
    }

    /* Contenedor del chatbot */
    .chatbot-container {
      display: none;
      position: fixed;
      bottom: 80px;
      /* Ajustado para evitar solapamiento con el botón */
      right: 180px;
      width: 260px;
      border: 1px solid #ccc;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      z-index: 9998;
      /* Debe estar por debajo del botón */
    }

    /* Estilo para todos los h1 */
    h1 {
      color: #0056b3;
      /* Cambia el color de todos los h1 a #0056b3 */
    }
  </style>

  <script>
    function toggleChatbot() {
      const chatbotContainer = document.getElementById('chatbot-container');
      const notificationBubble = document.getElementById('notification-bubble');

      if (chatbotContainer.style.display === 'none' || chatbotContainer.style.display === '') {
        chatbotContainer.style.display = 'block';
        notificationBubble.style.display = 'none'; // Oculta la notificación cuando se abre el chat
      } else {
        chatbotContainer.style.display = 'none';
      }
    }

    function sendMessage() {
      const userInput = document.getElementById('user-input');
      const message = userInput.value.trim();
      if (message) {
        const messagesContainer = document.getElementById('chatbot-messages');
        const userMessage = document.createElement('div');
        userMessage.className = 'message user-message';
        userMessage.textContent = message;
        messagesContainer.appendChild(userMessage);
        userInput.value = '';

        setTimeout(() => {
          const botMessage = document.createElement('div');
          botMessage.className = 'message bot-message';
          botMessage.textContent = 'Gracias por tu mensaje. Estamos aquí para ayudarte.';
          messagesContainer.appendChild(botMessage);
          messagesContainer.scrollTop = messagesContainer.scrollHeight;

          // Muestra la notificación cuando llega un nuevo mensaje
          document.getElementById('notification-bubble').style.display = 'block';

        }, 1000);
      }
    }
  </script>

</body>

</html>