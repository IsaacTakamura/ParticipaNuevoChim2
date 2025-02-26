<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reporte de Basura</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
  <!-- Roboto Condensed -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="estilo.css">
</head>

<body>
  <div class="container mt-5">
    <!-- Barra de progreso -->
    <div class="progress-container mb-4">
      <div class="progress">
        <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" id="progressBar"
          style="width: 33%;"></div>
      </div>
      <div class="d-flex justify-content-between mt-1">
        <span class="text-warning fw-bold">Paso 1</span>
        <span class="fw-bold">Paso 2</span>
        <span class="fw-bold">Paso 3</span>
      </div>
    </div>

    <!-- Formulario -->
    <form id="multiStepForm" class="card shadow-sm p-4" action="process_report_basura.php" method="POST"
      enctype="multipart/form-data">
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
            <label for="docNumber" class="form-label"><i class="fa-solid fa-id-badge"></i> Número de Documento</label>
            <input type="text" id="docNumber" name="docNumber" class="form-control" placeholder="Número de documento"
              required>
          </div>
          <div class="col-md-6">
            <label for="Telefono" class="form-label"><i class="fa-solid fa-phone"></i> Teléfono</label>
            <input type="tel" id="Telefono" name="Telefono" class="form-control" placeholder="Número de teléfono"
              required>
          </div>
          <div class="col-md-6">
            <label for="email" class="form-label"><i class="fa-solid fa-envelope"></i> Correo Electrónico</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="Correo electrónico" required>
          </div>
        </div>
        <div class="text-center mt-4">
          <button type="button" class="btn btn-warning next-btn">Siguiente</button>
        </div>
      </div>

      <!-- Paso 2: Reporte de Basura -->
      <div class="form-step">
        <h2 class="text-center mb-4">Reporte de Basura</h2>
        <div class="row">
          <div class="col-md-6">
            <div class="report-info">
              <span class="roboto-condensed-bold"><i class="fa-solid fa-triangle-exclamation"></i>
                DATOS DEL REPORTE
              </span>
            </div>
          </div>
          <div class="col-md-6">
            <div class="flex-grow-1">
              <div class="mb-3">
                <label for="causa" class="form-label"><i class="fa-solid fa-exclamation-triangle"></i> Causa</label>
                <select id="causa" name="causa" class="form-select" required>
                  <option value="" disabled selected>Seleccionar</option>
                  <option value="Falta de conciencia ambiental">Falta de conciencia ambiental</option>
                  <option value="Abandono de residuos en espacios públicos/negligencia">Abandono de residuos en espacios
                    públicos/negligencia</option>
                  <option value="Deficiencia en la recolección de basura">Deficiencia en la recolección de basura
                  </option>
                  <option value="Vertederos ilegales">Vertederos ilegales</option>
                  <option value="Desbordamiento de contenedores de basura">Desbordamiento de contenedores de basura
                  </option>
                  <option value="Incremento de residuos debido a eventos especiales">Incremento de residuos debido a
                    eventos especiales</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="lugarAfectado" class="form-label"><i class="fa-solid fa-map"></i> Lugar Afectado</label>
                <select id="lugarAfectado" name="lugarAfectado" class="form-select" required>
                  <option value="" disabled selected>Seleccionar</option>
                  <option value="Calles y avenidas">Calles y avenidas</option>
                  <option value="Playas">Playas</option>
                  <option value="Estacionamiento">Estacionamiento</option>
                  <option value="Parques y áreas verdes">Parques y áreas verdes</option>
                  <option value="Hospitales y centros de salud">Hospitales y centros de salud</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="Direccion" class="form-label"><i class="fa-solid fa-map-marker-alt"></i> Ubicación</label>
                <input type="text" id="Direccion" name="Direccion" class="form-control"
                  placeholder="Dirección o referencia" required>
                <ul id="suggestions" class="list-group"></ul>
              </div>

              <div class="mb-3">
                <label for="tiempo" class="form-label"><i class="fa-solid fa-clock"></i> Tiempo</label>
                <select id="tiempo" name="tiempo" class="form-select" required>
                  <option value="" disabled selected>Seleccionar</option>
                  <option value="1 mes">1 mes</option>
                  <option value="2 meses">2 meses</option>
                  <option value="3 meses">3 meses</option>
                  <option value="más de 3 meses">más de 3 meses</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="descripcion" class="form-label"><i class="fa-solid fa-file-alt"></i> Descripción</label>
                <textarea id="descripcion" name="descripcion" class="form-control"
                  placeholder="Describe el problema en detalle y su ubicación" rows="4" required></textarea>
              </div>
              <div class="mb-3">
                <label for="photo" class="form-label"><i class="fa-solid fa-camera"></i> Subir Foto del Problema</label>
                <input type="file" id="photo" name="photo" class="form-control" accept="image/*">
              </div>
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
          <li class="list-group-item"><strong>Causa:</strong> <span id="summary-causa"></span></li>
          <li class="list-group-item"><strong>Tiempo:</strong> <span id="summary-tiempo"></span></li>
          <li class="list-group-item"><strong>Lugar Afectado:</strong> <span id="summary-lugarAfectado"></span></li>
        </ul>
        <div class="d-flex justify-content-between">
          <button type="button" class="btn btn-secondary prev-btn">Anterior</button>
          <button type="submit" class="btn btn-warning">Enviar</button>
        </div>
      </div>
    </form>
  </div>

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
        document.getElementById('summary-causa').textContent = document.getElementById('causa').value;
        document.getElementById('summary-tiempo').textContent = document.getElementById('tiempo').value;
        document.getElementById('summary-lugarAfectado').textContent = document.getElementById('lugarAfectado').value;
      }
    });
  </script>
</body>

</html>
<script src="../../js/ubicacion.js"></script>