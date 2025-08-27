//  const form = document.getElementById('registerForm');

//     form.addEventListener('submit', function (e) {
//         e.preventDefault(); // Empêche l'envoi du formulaire

//         let isValid = true;

//         // Récupère les champs
//         const bsName = document.getElementById('BsName');
//         const recruiterName = document.getElementById('RecruterName');
//         const bsMail = document.getElementById('Bsmail');

//         // Réinitialise les messages d’erreur
//         document.querySelectorAll('.error-message').forEach(el => el.textContent = '');

//         // Validation du nom de l’entreprise
//         if (bsName.value.trim() === '') {
//             bsName.nextElementSibling.textContent = "Le nom de l'entreprise est requis.";
//             isValid = false;
//         }

//         // Validation du nom complet
//         if (recruiterName.value.trim() === '') {
//             recruiterName.nextElementSibling.textContent = "Le nom complet est requis.";
//             isValid = false;
//         }

//         // Validation de l'email
//         if (bsMail.value.trim() === '') {
//             bsMail.nextElementSibling.textContent = "L'email est requis.";
//             isValid = false;
//         } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(bsMail.value)) {
//             bsMail.nextElementSibling.textContent = "L'email n'est pas valide.";
//             isValid = false;
//         }

//     });

   