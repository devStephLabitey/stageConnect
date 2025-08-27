<?php
// Récupère les erreurs depuis l'URL
$fields = ['BsName', 'RecruterName', 'Bsmail', 'Bspwd', 'sector', 'BsLogo'];
$formErrors = [];
foreach ($fields as $field) {
    if (isset($_GET[$field])) {
        $formErrors[$field] = htmlspecialchars($_GET[$field]);
    }
}
?>
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
           <div class="part1 Img4">
                <div class="LogText">
                    <h1>Inscrivez - <br>Vous</h1>
                    <h3>Et Collaborez Maintenant !</h3>
                    <h5 class="redbg"><i>Réservez aux entreprises ⚠️</i></h5>
                </div>
           </div>
           <div class="part2">
               <div class="part2-content">
                 <div class="logo">
                    <img src="../Assets/Images/mascot.png" alt="" class="mascot">
                    <img src="../Assets/Images/logoLg.png" alt="" class="logolg">
                </div>

 <form id="registerForm" method="POST" action="../Controllers/Entreprise_Signup_controller.php" enctype="multipart/form-data">
    <div class="formContent">
        <h2>Inscription - Etape 1</h2>
      <div class="scroollPart">
        <div class="inputLb">
            <label for="BsName">Entrez le nom de l'entreprise</label>
            <input type="text" name="BsName" id="BsName" value="<?php echo isset($_POST['BsName']) ? htmlspecialchars($_POST['BsName']) : ''; ?>">
            <?php if (isset($formErrors['BsName'])): ?>
            <small class="error-msg" style="color:red;"><?php echo $formErrors['BsName']; ?></small>
            <?php endif; ?>
        </div>

        <div class="inputLb">
    <label for="RecruterName">Nom du recruteur</label>
    <input type="text" name="RecruterName" id="RecruterName" value="<?php echo isset($_POST['RecruterName']) ? htmlspecialchars($_POST['RecruterName']) : ''; ?>">
    <?php if (isset($formErrors['RecruterName'])): ?>
        <small class="error-msg" style="color:red;"><?php echo $formErrors['RecruterName']; ?></small>
    <?php endif; ?>
</div>

        <div class="inputLb">
            <label for="Bsmail">Entrez votre email professionnel</label>
            <input type="email" name="Bsmail" id="Bsmail">
            <?php if (isset($formErrors['Bsmail'])): ?>
            <small class="error-message" style="color:red;"></small>
            <?php endif; ?>
        </div>

         <div class="inputLb">
      <label for="Bspwd">Entrez votre mot de passe</label>
      <input type="password" name="Bspwd" id="Bspwd" required>
        <?php if (isset($formErrors['Bspwd'])): ?>
        <small class="error-msg" style="color:red;"><?php echo $formErrors['Bspwd']; ?></small>
            <?php endif; ?>
    </div>

    <div class="inputLb">
      <label for="sector">Choisissez votre secteur</label>
      <select name="sector" id="sector" required>
        <option value="">Secteur d'activité</option>
        <option value="Informatique">Informatique</option>
        <option value="Reseaux">Réseaux & Télécommunication</option>
        <option value="Comptabilité">Comptabilité & Gestion</option>
        <option value="GRH">Gestion des Ressources Humaines</option>
      </select>
        <?php if (isset($formErrors['sector'])): ?>
        <small class="error-msg" style="color:red;"><?php echo $formErrors['sector']; ?></small>
            <?php endif; ?>
    </div>

    <div class="inputLb">
      <label for="BsLogo">Le logo de votre entreprise</label>
      <input type="file" name="BsLogo" id="BsLogo" accept="image/*" required>
      <small class="error-msg"></small>
    </div>
      
</div>
       
    
        <div class="submit">
            <button type="submit" class="btn peachbg">Valider</button>
        </div>
    </div>

    <a href="./Login.php" class="LinkAuth">Déjà inscrit(e)? <b><u>Se connecter</u></b></a>
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
        <script src="./JsControllers/Ent1-sgn-up.js"></script>
</body>
</html>