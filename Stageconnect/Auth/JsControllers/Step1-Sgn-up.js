const form = document.getElementById("form-register");

form.addEventListener("submit", function (e) {
  e.preventDefault(); // Empêche la soumission automatique du formulaire

  const fullname = document.getElementById("fullname");
  const email = document.getElementById("email");
  const password = document.getElementById("password");
  const entity = document.getElementById('entity');
  const filiere = document.getElementById('filiere');
  const annee = document.getElementById('annee');
  const matricule = document.getElementById('matricule');

  let valid = true;

  // Réinitialisation des messages d'erreur
  document.querySelectorAll(".error-msg, .error").forEach(el => el.textContent = "");

  // Validation de chaque champ
  if (fullname.value.trim() === "") {
    setError(fullname, "Le nom est requis.");
    valid = false;
  }

  if (email.value.trim() === "") {
    setError(email, "L'email est requis.");
    valid = false;
  } else if (!validateEmail(email.value.trim())) {
    setError(email, "Email invalide.");
    valid = false;
  }

  if (password.value.length < 6) {
    setError(password, "Le mot de passe doit contenir au moins 6 caractères.");
    valid = false;
  }

  if (entity.value === "") {
    setError(entity, "Veuillez sélectionner une entité.");
    valid = false;
  }

  if (filiere.value === "") {
    setError(filiere, "Veuillez choisir une filière.");
    valid = false;
  }

  if (annee.value === "") {
    setError(annee, "Veuillez indiquer votre année.");
    valid = false;
  }

  if (matricule.value.trim() === "") {
    setError(matricule, "Le matricule est requis.");
    valid = false;
  }

  if (valid) {
    form.submit(); // Envoi le formulaire si tout est valide
  }
});

function setError(input, message) {
  const container = input.parentElement;
  const small = container.querySelector(".error-msg") || container.querySelector(".error");
  if (small) small.textContent = message;
}

function validateEmail(email) {
  const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email.toLowerCase());
}
