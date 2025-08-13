setTimeout(function() {
    window.location.href = "/ParticipaNuevoChim2/index.php";
}, 5000);

let index = 0;
const images = document.querySelectorAll(".image-container img");

function changeImage() {
    images.forEach(img => img.classList.remove("active"));
    images[index].classList.add("active");
    index = (index + 1) % images.length;
}

setInterval(changeImage, 3000);