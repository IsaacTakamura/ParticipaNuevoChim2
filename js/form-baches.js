document.addEventListener('DOMContentLoaded', function () {
  const nextBtns = document.querySelectorAll('.next-btn');
  const prevBtns = document.querySelectorAll('.prev-btn');
  const formSteps = document.querySelectorAll('.form-step');
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
    document.getElementById('summary-phone').textContent = document.getElementById('Telefono').value;
    document.getElementById('summary-email').textContent = document.getElementById('email').value;
    document.getElementById('summary-report').textContent = document.getElementById('descripcion').value;
  }

  // Inicializa el primer paso y la barra de progreso
  updateFormSteps();
  updateProgressBar();
});
