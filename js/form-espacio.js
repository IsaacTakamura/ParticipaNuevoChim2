document.addEventListener('DOMContentLoaded', function () {
  const formSteps = document.querySelectorAll('.form-step');
  const nextBtns = document.querySelectorAll('.next-btn');
  const prevBtns = document.querySelectorAll('.prev-btn');
  const progressBar = document.getElementById('progressBar');
  let formStepIndex = 0;

  nextBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      if (formStepIndex < formSteps.length - 1) {
        formStepIndex++;
        updateFormSteps();
        updateProgressBar();
        if (formStepIndex === 2) {
          updateSummary();
        }
      }
    });
  });

  prevBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      if (formStepIndex > 0) {
        formStepIndex--;
        updateFormSteps();
        updateProgressBar();
      }
    });
  });

  function updateFormSteps() {
    formSteps.forEach((formStep, index) => {
      formStep.classList.toggle('active', index === formStepIndex);
    });
  }

  function updateProgressBar() {
    const progress = ((formStepIndex + 1) / formSteps.length) * 100;
    progressBar.style.width = `${progress}%`;
  }

  function updateSummary() {
    document.getElementById('summary-name').textContent = document.getElementById('Nombres').value;
    document.getElementById('summary-lastname').textContent = document.getElementById('apellidos').value;
    document.getElementById('summary-docNumber').textContent = `${document.getElementById('docNumber').value} ${document.getElementById('TipoIdentificacion').value}`;
    document.getElementById('summary-Telefono').textContent = document.getElementById('Telefono').value;
    document.getElementById('summary-email').textContent = document.getElementById('email').value;
    document.getElementById('summary-report').textContent = document.getElementById('descripcion').value;
  }

  // Validación de imágenes
  const photoInput = document.querySelector('input[name="photos[]"]');
  if (photoInput) {
    photoInput.addEventListener('change', function(e) {
      const files = e.target.files;
      const maxFiles = parseInt(this.getAttribute('data-max-files'));
      if (files.length > maxFiles) {
        alert(`Solo puedes subir máximo ${maxFiles} fotos`);
        this.value = '';
        return;
      }
      // Validar tipos de archivo
      const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
      for (let file of files) {
        if (!allowedTypes.includes(file.type)) {
          alert('Solo se permiten imágenes (JPEG, PNG, GIF)');
          this.value = '';
          return;
        }
      }
    });
  }

  // Inicializa el primer paso y la barra de progreso
  updateFormSteps();
  updateProgressBar();
});
