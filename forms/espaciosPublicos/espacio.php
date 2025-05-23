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
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
  <!-- Roboto Condensed -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="../../css/form-espacio.css">
</head>

<body>
  <div class="container mt-5">
    <!-- Barra de progreso -->
    <div class="progress-container mb-4">
      <div class="progress">
        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" id="progressBar"
          style="width: 33%;"></div>
      </div>
      <div class="d-flex justify-content-between mt-2">
        <span class="text-success fw-bold">Paso 1</span>
        <span class="fw-bold">Paso 2</span>
        <span class="fw-bold">Paso 3</span>
      </div>
    </div>

    <!-- Formulario -->
    <form id="multiStepForm" class="card shadow-sm p-4" action="process_report_espacio.php" method="POST"
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
          <button type="button" class="btn btn-success next-btn">Siguiente</button>
        </div>
      </div>

      <!-- Paso 2: Reporte de Espacios Públicos -->
      <div class="form-step">
        <h2 class="text-center mb-4">Reporte de incidencias en el Espacio Público</h2>
        <div class="bache-section">
          <div class="report-info">
            <span class="roboto-condensed-bold"><i class="fa-solid fa-triangle-exclamation"></i>
              DATOS DEL REPORTE
            </span>
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
              <label for="issueType" class="form-label"><i class="fa-solid fa-exclamation-circle"></i> Tipo de
                Problema</label>
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
              <input type="text" id="Direccion" name="Direccion" class="form-control"
                placeholder="Dirección o referencia" required>
              <ul id="suggestions" class="list-group"></ul>
            </div>
            <div class="mb-3">
              <label for="descripcion" class="form-label"><i class="fa-solid fa-file-alt"></i> Descripción</label>
              <textarea id="descripcion" name="descripcion" class="form-control"
                placeholder="Describe el problema en detalle y su ubicación" rows="4" required></textarea>
            </div>
            <!-- Reemplazar los inputs individuales de fotos por este bloque -->
            <div class="mb-3">
              <label for="photos" class="form-label">
                <i class="fa-solid fa-camera"></i> Subir fotos del problema
                <small>(Mínimo 1, máximo 3)</small>
              </label>
              <input type="file" id="photos" name="photos[]" class="form-control" accept="image/*" multiple
                data-max-files="3" required>
              <div class="invalid-feedback">Debes subir al menos 1 foto</div>
              <small class="form-text text-muted">
                Puedes seleccionar hasta 3 fotos a la vez (JPEG, PNG, GIF)
              </small>
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

  <script>
    document.getElementById('multiStepForm').addEventListener('submit', function () {
      // Perform form submission logic here
      window.location.href = '../../templates/CVVDF.php';
    });
  </script>

  <!-- Bootstrap JS -->
  <script src="../../js/form-espacio.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script>

  </script>
</body>

</html>
<script src="../../js/ubicacion.js"></script>