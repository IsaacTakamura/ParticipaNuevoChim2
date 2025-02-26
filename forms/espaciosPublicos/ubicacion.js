document.getElementById("Direccion").addEventListener("input", function () {
    const query = this.value;
    if (query.length > 2) {
      fetch(
        `https://nominatim.openstreetmap.org/search?format=json&countrycodes=PE&viewbox=-78.55,-9.05,-78.45,-9.15&q=${query}`
      )
        .then((response) => response.json())
        .then((data) => {
          const suggestions = document.getElementById("suggestions");
          suggestions.innerHTML = "";
          data.forEach((item) => {
            const li = document.createElement("li");
            li.classList.add("list-group-item");
            li.textContent = item.display_name;
            li.addEventListener("click", function () {
              document.getElementById("Direccion").value = item.display_name;
              suggestions.innerHTML = "";
            });
            suggestions.appendChild(li);
          });
        });
    }
  });