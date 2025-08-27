
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- fontfamily -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Boldonse&family=Codystar:wght@300;400&family=Edu+NSW+ACT+Cursive:wght@400..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
   <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/3.0.0/uicons-brands/css/uicons-brands.css'>
    <!-- fontfamily -->

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="../Assets/Styles/Auth.css">
    <title>Inscrivez-vous</title>
</head>

<body>


    <div class="Auth">
        <div class="auth-content">
           <div class="part1 Img2">
                <div class="LogText">
                    <h1>Inscrivez - <br>Vous</h1>
                    <h3>Saisissez De nouvelles opportunités</h3>
                </div>
           </div>
           <div class="part2">
               <div class="part2-content">
                 <div class="logo">
                    <img src="../Assets/Images/mascot.png" alt="" class="mascot">
                    <img src="../Assets/Images/logoLg.png" alt="" class="logolg">
                </div>

               <form id="form-register" method="POST" action="../Controllers/enregistrer_etudiant.php">

              <div class="formContent" >
                <h2>Inscription </h2>
            <div class="scroollPart">
             <div class="inputLb">
                  <label for="fullname">Entrez vos Noms & Prénom(s)</label>
                  <input type="text" name="fullname" id="fullname" required>
                  <small class="error-msg"></small>
                </div>

                <div class="inputLb">
                  <label for="email">Entrez votre email</label>
                  <input type="email" name="email" id="email" required>
                  <small class="error-msg"></small>
                </div>

                <div class="inputLb">
                  <label for="password">Entrez votre mot de passe</label>
                  <input type="password" name="password" id="password" required>
                  <small class="error-msg"></small>
                </div>

                <div class="inputLb">
                  <label for="entity">Entité</label>
                  <select name="entity" id="entity" required>
                    <option value="">-- Choisissez une entité --</option>
                    <option value="etudiant">Étudiant</option>
                    <option value="entreprise">Externe</option>
                  </select>
                  <small class="error"></small>
                </div>

                <div class="inputLb">
                  <label for="filiere">Filière</label>
                  <select name="filiere" id="filiere" required>
                    <option value="">-- Choisissez une filière --</option>
                    <option value="Génie Logiciel">Génie Logiciel</option>
                    <option value="Comptabilité">Comptabilité</option>
                    <option value="Génie Mécanique">Génie Mécanique</option>
                    <option value="Gestion RH">Gestion des Ressources Humaines</option>
                  </select>
                  <small class="error"></small>
                </div>

                <div class="inputLb">
                  <label for="annee">Année</label>
                  <select name="annee" id="annee" required>
                    <option value="">-- Sélectionnez votre année --</option>
                    <option value="Lp2">LP2</option>
                    <option value="Lp3">LP3</option>
                    <option value="Master1">Master 1</option>
                    <option value="Master2">Master 2</option>
                  </select>
                  <small class="error"></small>
                </div>

                <div class="inputLb">
                  <label for="matricule">Matricule</label>
                  <input type="text" name="matricule" id="matricule" required>
                  <small class="error"></small>
                </div>
            </div>


                <div class="submit">
                <button type="submit" class="btn peachbg">Valider</button>
              </div>
       </div>

   <a href="./Login.php" class="LinkAuth">Déjà inscrit(e)? <b><u>Se Connecter</u></b></a>
</form>


               </div>
           </div>
        </div>
    </div>

        <script>
            AOS.init();
        </script>

        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="../Assets/Js/Features.js"></script>
        <script src="./JsControllers/Step1-Sgn-up.js"></script>
</body>
</html>