
  // Fonctionnalité de recherche automatique avec les mots-clés
    document.querySelectorAll('.keyword-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const searchInput = document.querySelector('.search-input');
            if (searchInput) {
                searchInput.value = btn.textContent;
                // Déclenche la recherche comme si on avait cliqué sur le bouton
                document.querySelector('.search-btn')?.click();
            }
        });
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

// Fonctionnalité de recherche automatique avec les mots-clés pour toutes les barres de recherche
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll('.keyword-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.search-input').forEach(function (input) {
        input.value = btn.textContent;
      });
      document.querySelectorAll('.search-btn').forEach(function (searchBtn) {
        searchBtn.click();
      });
    });
  });

  function toggleProfilPopup(event) {
    event.stopPropagation();
    var popup = document.getElementById('profilPopup');
    popup.style.display = (popup.style.display === 'block') ? 'none' : 'block';
  }

  document.addEventListener('click', function (e) {
    var popup = document.getElementById('profilPopup');
    if (popup) popup.style.display = 'none';
  });
});

