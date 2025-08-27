
// Text Toggle button
  function toggleMore() {
    const content = document.querySelector(".more-content");
    const button = document.querySelector(".more-btn");

    content.classList.toggle("open");

    if (content.classList.contains("open")) {
      button.textContent = "−";
    } else {
      button.textContent = "+";
    }
  }

// Card animation

  function handleMouseMove(e, card) {
    const rect = card.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    const centerX = rect.width / 2;
    const centerY = rect.height / 2;

    const rotateX = ((y - centerY) / centerY) * 22; // ajuster l’intensité
    const rotateY = ((x - centerX) / centerX) * 22;

    card.style.transform = `rotateX(${-rotateX}deg) rotateY(${rotateY}deg)`;
  }

  function resetCard(card) {
    card.style.transform = 'rotateX(0) rotateY(0)';
  }


//   Newsletter control
document.getElementById("newsletter-form").addEventListener("submit", function (e) {
  e.preventDefault();

  const name = document.getElementById("name").value.trim();
  const email = document.getElementById("email").value.trim();
  const message = document.getElementById("message");

  if (name === "" || email === "") {
    message.textContent = "Veuillez remplir tous les champs.";
    message.style.color = "red";
    message.classList.remove("hidden");
    return;
  }

  // Simule une inscription (tu peux remplacer ça par une requête PHP ou AJAX)
  message.textContent = `Merci ${name}, vous êtes inscrit à notre newsletter ! 📧`;
  message.style.color = "green";
  message.classList.remove("hidden");

  // Réinitialiser les champs
  document.getElementById("newsletter-form").reset();
});




 function toggleProfilPopup(event) {
                event.stopPropagation();
                var popup = document.getElementById('profilPopup');
                popup.style.display = (popup.style.display === 'block') ? 'none' : 'block';
            }
            document.addEventListener('click', function(e) {
                var popup = document.getElementById('profilPopup');
                if (popup) popup.style.display = 'none';
            });



    