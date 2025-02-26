const steps = document.querySelectorAll(".form-step");
const progressBar = document.getElementById("progressBar");
let currentStep = 0;

// Botones "Siguiente"
document.querySelectorAll(".next-btn").forEach((btn) => {
  btn.addEventListener("click", () => {
    if (currentStep < steps.length - 1) {
      steps[currentStep].classList.remove("active");
      currentStep++;
      steps[currentStep].classList.add("active");
      updateProgressBar();
    }
  });
});

// Botones "Anterior"
document.querySelectorAll(".prev-btn").forEach((btn) => {
  btn.addEventListener("click", () => {
    if (currentStep > 0) {
      steps[currentStep].classList.remove("active");
      currentStep--;
      steps[currentStep].classList.add("active");
      updateProgressBar();
    }
  });
});

// Actualizar barra de progreso
function updateProgressBar() {
  const progress = ((currentStep + 1) / steps.length) * 100;
  progressBar.style.width = `${progress}%`;
}
