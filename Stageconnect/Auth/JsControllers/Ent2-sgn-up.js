
  const form = document.getElementById("businessForm");

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const password = document.getElementById("Bspwd");
    const sector = document.getElementById("sector");
    const logo = document.getElementById("BsLogo");

    const passwordError = password.nextElementSibling;
    const sectorError = sector.nextElementSibling;
    const logoError = logo.nextElementSibling;

    let isValid = true;

    // 🔐 Mot de passe
    if (password.value.trim() === "") {
      passwordError.textContent = "Veuillez entrer un mot de passe.";
      isValid = false;
    } else if (password.value.length < 6) {
      passwordError.textContent = "Le mot de passe doit contenir au moins 6 caractères.";
      isValid = false;
    } else {
      passwordError.textContent = "";
    }

    // 📂 Secteur
    if (sector.value.trim() === "") {
      sectorError.textContent = "Veuillez sélectionner un secteur.";
      isValid = false;
    } else {
      sectorError.textContent = "";
    }

    // 🖼️ Logo
    if (logo.files.length === 0) {
      logoError.textContent = "Veuillez choisir un logo.";
      isValid = false;
    } else {
      logoError.textContent = "";
    }

    if (isValid) {
      // Enregistrement dans le localStorage
      const formData = {
        Bspwd: password.value,
        sector: sector.value,
        BsLogo: logo.files[0].name,
      };

      localStorage.setItem("businessData2", JSON.stringify(formData));
      alert("Formulaire validé !");
      // Redirection si nécessaire : window.location.href = "autrePage.html";
    }
  });

   document.getElementById("prevBtn").addEventListener("click", () => {
  window.location.href = "Entreprise_Signup.php"; // 🔁 Change ça selon ta structure
});
