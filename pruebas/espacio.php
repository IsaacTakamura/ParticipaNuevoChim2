<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reporte de Espacios Públicos</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="esti.css">
  <style>
    #chatbot {
      position: fixed;
      bottom: 20px;
      right: 20px;
      width: 300px;
      max-height: 400px;
      overflow-y: auto;
      background: white;
      border: 1px solid #ccc;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      display: none;
    }

    #chatbot-header {
      background: #007bff;
      color: white;
      padding: 10px;
      border-top-left-radius: 10px;
      border-top-right-radius: 10px;
      display: flex;
      align-items: center;
    }

    #chatbot-header img {
      width: 30px;
      height: 30px;
      margin-right: 10px;
    }

    #chatbot-messages {
      padding: 10px;
    }

    #chatbot-input {
      display: flex;
      border-top: 1px solid #ccc;
    }

    #chatbot-input input {
      flex: 1;
      border: none;
      padding: 10px;
      border-bottom-left-radius: 10px;
    }

    #chatbot-input button {
      background: #007bff;
      color: white;
      border: none;
      padding: 10px;
      border-bottom-right-radius: 10px;
    }

    .chatbot-message {
      display: flex;
      align-items: flex-start;
      margin-bottom: 10px;
    }

    .chatbot-message img {
      width: 30px;
      height: 30px;
      margin-right: 10px;
    }

    .chatbot-message div {
      background: #f1f1f1;
      padding: 10px;
      border-radius: 10px;
    }

    .highlight {
      animation: highlight 1s infinite;
    }

    @keyframes highlight {
      0% { background-color: yellow; }
      50% { background-color: transparent; }
      100% { background-color: yellow; }
    }
  </style>
</head>

<body>
  <div class="container mt-5">
    <!-- Formulario -->
    <form id="multiStepForm" class="card shadow-sm p-4" action="process_report_espacio.php" method="POST" enctype="multipart/form-data">
      <!-- Paso 1: Registro de Usuario -->
      <div class="form-step active">
        <h2 class="text-center mb-4">Registro de Usuario</h2>
        <div class="row gy-3">
          <div class="col-md-6">
            <label for="Nombres" class="form-label"><i class="fa-solid fa-user"></i> Nombres</label>
            <input type="text" id="Nombres" name="Nombres" class="form-control" placeholder="Tu nombre" required>
          </div>
          <div class="col-md-6">
            <label for="apellidos" class="form-label"><i class="fa-solid fa-user"></i> Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Tus apellidos" required>
          </div>
          <div class="col-md-6">
            <label for="TipoIdentificacion" class="form-label"><i class="fa-solid fa-id-card"></i> Tipo de Documento</label>
            <select id="TipoIdentificacion" name="TipoIdentificacion" class="form-select" required>
              <option value="" disabled selected>Seleccionar</option>
              <option value="1">DNI</option>
              <option value="2">RUC</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="docNumber" class="form-label"><i class="fa-solid fa-id-badge"></i> Número de Documento</label>
            <input type="text" id="docNumber" name="docNumber" class="form-control" placeholder="Número de documento" required>
          </div>
          <div class="col-md-6">
            <label for="Telefono" class="form-label"><i class="fa-solid fa-phone"></i> Teléfono</label>
            <input type="tel" id="Telefono" name="Telefono" class="form-control" placeholder="Número de teléfono" required>
          </div>
          <div class="col-md-6">
            <label for="email" class="form-label"><i class="fa-solid fa-envelope"></i> Correo Electrónico</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Correo electrónico" required>
          </div>
        </div>
        <div class="text-center mt-4">
          <button type="button" class="btn btn-success next-btn">Siguiente</button>
        </div>
      </div>

      <!-- Paso 2: Reporte de Espacios Públicos -->
      <div class="form-step">
        <h2 class="text-center mb-4">Reporte de incidencias en el Espacio Público</h2>
        <div class="bache-section">
          <div class="public-space-image">
            <img src="gaaa.gif" alt="Espacios públicos representativos" class="img-fluid rounded">
          </div>
          <div class="flex-grow-1">
            <div class="mb-3">
              <label for="spaceType" class="form-label"><i class="fa-solid fa-tree"></i> Tipo de Espacio</label>
              <select id="spaceType" name="spaceType" class="form-select" required>
                <option value="" disabled selected>Seleccionar</option>
                <option value="parque">Parque</option>
                <option value="plaza">Plaza</option>
                <option value="zona_recreativa">Zona Recreativa</option>
                <option value="otro">Otro</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="issueType" class="form-label"><i class="fa-solid fa-exclamation-circle"></i> Tipo de Problema</label>
              <select id="issueType" name="issueType" class="form-select" required>
                <option value="" disabled selected>Seleccionar</option>
                <option value="basura">Presencia de Basura</option>
                <option value="daño">Daños en Infraestructura</option>
                <option value="trafico">Tráfico de drogas/armas</option>
                <option value="robos">Robos (en general)</option>
                <option value="otro">Otro</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="Direccion" class="form-label"><i class="fa-solid fa-map-marker-alt"></i> Ubicación</label>
              <input type="text" id="Direccion" name="Direccion" class="form-control" placeholder="Dirección o referencia" required>
              <ul id="suggestions" class="list-group"></ul>
            </div>
            <div class="mb-3">
              <label for="descripcion" class="form-label"><i class="fa-solid fa-file-alt"></i> Descripción</label>
              <textarea id="descripcion" name="descripcion" class="form-control" placeholder="Describe el problema en detalle y su ubicación" rows="4" required></textarea>
            </div>
            <div class="mb-3">
              <label for="photo" class="form-label"><i class="fa-solid fa-camera"></i> Subir Foto del Problema</label>
              <input type="file" id="photo" name="photo" class="form-control" accept="image/*">
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-between mt-4">
          <button type="button" class="btn btn-secondary prev-btn">Anterior</button>
          <button type="button" class="btn btn-success next-btn">Siguiente</button>
        </div>
      </div>

      <!-- Paso 3: Confirmar Envío -->
      <div class="form-step">
        <h2 class="text-center mb-4">Confirmar Envío</h2>
        <p class="text-center">Revisa los datos antes de enviar:</p>
        <ul class="list-group mb-4">
          <li class="list-group-item"><strong>Nombres:</strong> <span id="summary-name"></span></li>
          <li class="list-group-item"><strong>Apellidos:</strong> <span id="summary-lastname"></span></li>
          <li class="list-group-item"><strong>Documento:</strong> <span id="summary-docNumber"></span></li>
          <li class="list-group-item"><strong>Teléfono:</strong> <span id="summary-Telefono"></span></li>
          <li class="list-group-item"><strong>Correo:</strong> <span id="summary-email"></span></li>
          <li class="list-group-item"><strong>Reporte:</strong> <span id="summary-report"></span></li>
        </ul>
        <div class="d-flex justify-content-between">
          <button type="button" class="btn btn-secondary prev-btn">Anterior</button>
          <button type="submit" class="btn btn-success">Enviar</button>
        </div>
      </div>
    </form>
  </div>

  <!-- Chatbot -->
  <div id="chatbot">
    <div id="chatbot-header">
      <img src="avatar.png" alt="Avatar">
      <h5>Chatbot</h5>
    </div>
    <div id="chatbot-messages"></div>
    <div id="chatbot-input">
      <input type="text" id="chatbot-input-field" placeholder="Escribe un mensaje...">
      <button id="chatbot-send-btn">Enviar</button>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const nextBtns = document.querySelectorAll('.next-btn');
      const prevBtns = document.querySelectorAll('.prev-btn');
      const formSteps = document.querySelectorAll('.form-step');
      let formStepIndex = 0;

      nextBtns.forEach(btn => {
        btn.addEventListener('click', () => {
          formStepIndex++;
          updateFormSteps();
          updateProgressBar();
          if (formStepIndex === 2) {
            updateSummary();
          }
          handleChatbotResponse();
        });
      });

      prevBtns.forEach(btn => {
        btn.addEventListener('click', () => {
          formStepIndex--;
          updateFormSteps();
          updateProgressBar();
          handleChatbotResponse();
        });
      });

      function updateFormSteps() {
        formSteps.forEach((formStep, index) => {
          formStep.classList.toggle('active', index === formStepIndex);
        });
      }

      function updateProgressBar() {
        const progressBar = document.getElementById('progressBar');
        progressBar.style.width = `${(formStepIndex + 1) * 33}%`;
      }

      function updateSummary() {
        document.getElementById('summary-name').textContent = document.getElementById('Nombres').value;
        document.getElementById('summary-lastname').textContent = document.getElementById('apellidos').value;
        document.getElementById('summary-docNumber').textContent = `${document.getElementById('docNumber').value} ${document.getElementById('TipoIdentificacion').value}`;
        document.getElementById('summary-Telefono').textContent = document.getElementById('Telefono').value;
        document.getElementById('summary-email').textContent = document.getElementById('email').value;
        document.getElementById('summary-report').textContent = document.getElementById('descripcion').value;
      }

      // Chatbot functionality
      const chatbot = document.getElementById('chatbot');
      const chatbotMessages = document.getElementById('chatbot-messages');
      const chatbotInputField = document.getElementById('chatbot-input-field');
      const chatbotSendBtn = document.getElementById('chatbot-send-btn');

      function addChatbotMessage(message) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('chatbot-message');
        messageElement.innerHTML = `<img src="avatar.png" alt="Avatar"><div>${message}</div>`;
        chatbotMessages.appendChild(messageElement);
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
      }

      function handleChatbotResponse() {
        if (formStepIndex === 0) {
          addChatbotMessage('Bienvenido a este espacio de reportes. Aquí podrás informarnos sobre acontecimientos relacionados a los espacios públicos de tu comunidad. Empieza por llenar los siguientes datos personales.');
          highlightField('Nombres');
        } else if (formStepIndex === 1) {
          addChatbotMessage('Por favor, completa los detalles del reporte.');
          highlightField('spaceType');
        } else if (formStepIndex === 2) {
          addChatbotMessage('Por favor, revisa y confirma tus datos.');
        }
      }

      function highlightField(fieldId) {
        const field = document.getElementById(fieldId);
        field.classList.add('highlight');
        setTimeout(() => {
          field.classList.remove('highlight');
        }, 3000);
      }

      chatbotSendBtn.addEventListener('click', () => {
        const userMessage = chatbotInputField.value;
        if (userMessage.trim()) {
          addChatbotMessage(`Tú: ${userMessage}`);
          handleChatbotResponse();
          chatbotInputField.value = '';
        }
      });

      chatbotInputField.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
          chatbotSendBtn.click();
        }
      });

      // Show chatbot
      chatbot.style.display = 'block';
      handleChatbotResponse();
    });
  </script>

  <!-- Bootstrap JS -->
  <script src="ga.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>