<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Reporte de Deficiencia en Alumbrado Público</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
  <!-- Roboto Condensed -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="esti.css" />
</head>

<body>
  <div class="container mt-5">
    <!-- Barra de progreso -->
    <div class="progress-container mb-4">
      <div class="progress">
        <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" id="progressBar"
          style="width: 33%"></div>
      </div>
      <div class="d-flex justify-content-between mt-2">
        <span class="text-warning fw-bold">Paso 1</span>
        <span class="fw-bold">Paso 2</span>
        <span class="fw-bold">Paso 3</span>
      </div>
    </div>

    <!-- Formulario -->
    <form id="multiStepForm" class="card shadow-sm p-4" action="process_report_alumbrado.php" method="POST"
      enctype="multipart/form-data">
      <!-- Paso 1: Registro de Usuario -->
      <div class="form-step active">
        <h2 class="text-center mb-4">Registro de Usuario</h2>
        <div class="row gy-3">
          <div class="col-md-6">
            <label for="Nombres" class="form-label"><i class="fa-solid fa-asterisk"></i> Nombres</label>
            <input type="text" id="Nombres" name="Nombres" class="form-control" placeholder="Tus Nombres" required>
          </div>
          <div class="col-md-6">
            <label for="apellidos" class="form-label"><i class="fa-solid fa-asterisk"></i> Apellidos</label>
            <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Tus apellidos"
              required>
          </div>
          <div class="col-md-6">
            <label for="TipoIdentificacion" class="form-label"><i class="fa-solid fa-id-card"></i> Tipo de
              Documento</label>
            <select id="TipoIdentificacion" name="TipoIdentificacion" class="form-select" required>
              <option value="" disabled selected>Seleccionar</option>
              <option value="1">DNI</option>
              <option value="2">RUC</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="docNumber" class="form-label"><i class="fa-solid fa-asterisk"></i> Número de Documento</label>
            <input type="text" id="docNumber" name="docNumber" class="form-control" placeholder="Número de documento"
              required>
          </div>
          <div class="col-md-6">
            <label for="Telefono" class="form-label"><i class="fa-solid fa-phone"></i> Teléfono</label>
            <input type="tel" id="Telefono" name="Telefono" class="form-control" placeholder="Número de teléfono"
              required>
          </div>
          <div class="col-md-6">
            <label for="email" class="form-label"><i class="fa-solid fa-envelope"></i> Email</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Tu email" required>
          </div>
        </div>
        <div class="text-center mt-4">
          <button type="button" class="btn btn-warning next-btn">Siguiente</button>
        </div>
      </div>

      <!-- Paso 2: Reporte de Alumbrado Público -->
      <div class="form-step">
        <h2 class="text-center mb-4">Reporte de Deficiencia en Alumbrado Público</h2>
        <div class="lighting-section">
          <div class="lighting-image">
            <div class="report-info">
              <span class="roboto-condensed-bold"><i class="fa-solid fa-triangle-exclamation"></i>
                DATOS DEL REPORTE
              </span>
            </div>
          </div>
          <div class="flex-grow-1">
            <div class="mb-3">
              <label for="lightingType" class="form-label"><i class="fa-solid fa-asterisk"></i> Tipo de
                Problema</label>
              <select id="lightingType" class="form-select" required>
                <option value="" disabled selected>Seleccionar</option>
                <option value="apagado">Farola apagada</option>
                <option value="parpadeo">Farola parpadeando</option>
                <option value="dañado">Farola dañada</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="Direccion" class="form-label"><i class="fa-solid fa-map-marker-alt"></i> Ubicación</label>
              <input type="text" id="Direccion" name="Direccion" class="form-control"
                placeholder="Dirección o referencia" required>
              <ul id="suggestions" class="list-group"></ul>
            </div>
            <div class="mb-3">
              <label for="monthsPresent" class="form-label"><i class="fa-solid fa-asterisk"></i> ¿Desde cuándo está
                presente?</label>
              <select id="monthsPresent" class="form-select" required>
                <option value="" disabled selected>Seleccionar</option>
                <option value="1">1 mes</option>
                <option value="2">2 meses</option>
                <option value="3">3 meses</option>
                <option value="4">4 meses</option>
                <option value="5+">Más de 4 meses</option>
              </select>
            </div>
            <div class="mb-3">
              <label for="descripcion" class="form-label"><i class="fa-solid fa-asterisk"></i> Descripción</label>
              <textarea id="descripcion" name="descripcion" class="form-control"
                placeholder="Describe la Ubicación y el problema en detalle" rows="4" required></textarea>
            </div>
            <div class="mb-3">
              <label for="photo1" class="form-label"><i class="fa-solid fa-camera"></i> Subir Foto del Problema
                1</label>
              <input type="file" id="photo1" name="photos[]" class="form-control" accept="image/*">
            </div>
            <div class="mb-3">
              <label for="photo2" class="form-label"><i class="fa-solid fa-camera"></i> Subir Foto del Problema
                2</label>
              <input type="file" id="photo2" name="photos[]" class="form-control" accept="image/*">
            </div>
            <div class="mb-3">
              <label for="photo3" class="form-label"><i class="fa-solid fa-camera"></i> Subir Foto del Problema
                3</label>
              <input type="file" id="photo3" name="photos[]" class="form-control" accept="image/*">
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-between mt-4">
          <button type="button" class="btn btn-secondary prev-btn">Anterior</button>
          <button type="button" class="btn btn-warning next-btn">Siguiente</button>
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
          <button type="submit" class="btn btn-warning">Enviar</button>
        </div>
      </div>
    </form>
  </div>

  <script>
    document.getElementById('multiStepForm').addEventListener('submit', function () {
      // Perform form submission logic here
      window.location.href = '../../templates/CVVDF.php';
    });
  </script>

  <!-- Bootstrap JS -->
  <script src="ga.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
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
        });
      });

      prevBtns.forEach(btn => {
        btn.addEventListener('click', () => {
          formStepIndex--;
          updateFormSteps();
          updateProgressBar();
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
    });
  </script>
</body>

</html>
<script src="ubicacion.js"></script>