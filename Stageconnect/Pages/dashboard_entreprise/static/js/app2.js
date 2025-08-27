// document.addEventListener('DOMContentLoaded', function () {
//     const form = document.querySelector('form');
//     if (!form) return;

//     form.addEventListener('submit', function (e) {
//         e.preventDefault();
//         let valid = true;

//         // Efface les anciens messages d'erreur
//         form.querySelectorAll('.error-message').forEach(el => el.remove());

//         // Contrôles
//         const fields = [
//             { name: 'titre', message: "Le titre est requis." },
//             { name: 'entreprise', message: "Le nom de l'entreprise est requis." },
//             { name: 'description', message: "La description est requise." },
//             { name: 'duree', message: "La durée est requise." },
//             { name: 'lieu', message: "Le lieu est requis." },
//             { name: 'type', message: "Le type de contrat est requis." }
//         ];

//         fields.forEach(field => {
//             const input = form.elements[field.name];
//             if (input && !input.value.trim()) {
//                 valid = false;
//                 showError(input, field.message);
//             }
//         });

//         // Si tout est valide
//         if (valid) {
//             showSuccessPopup();
//             form.reset();
//         }
//     });

//     function showError(input, message) {
//         const error = document.createElement('div');
//         error.className = 'error-message';
//         error.style.color = '#dc3545';
//         error.style.fontSize = '0.95em';
//         error.style.marginTop = '0.25rem';
//         error.textContent = message;
//         input.parentNode.appendChild(error);
//     }

//     // Affiche le popup de succès
//     function showSuccessPopup() {
//         const popup = document.getElementById('success-popup');
//         popup.style.display = 'flex';
//         document.getElementById('close-popup').onclick = function() {
//             popup.style.display = 'none';
//         };
//     }
// });