<?php
$errorMessage = '';
if (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'invalid_credentials':
            $errorMessage = 'Email ou mot de passe incorrect.';
            break;
        case 'server':
            $errorMessage = 'Erreur serveur, veuillez réessayer plus tard.';
            break;
        default:
            $errorMessage = 'Une erreur inconnue est survenue.';
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../Assets/Styles/Auth.css">
  <title>Connectez-Vous</title>

  <style>
    .error-container {
      background-color: #ffe6e6;
      color: red;
      border: 1px solid red;
      padding: 10px;
      text-align: center;
      margin-bottom: 15px;
      border-radius: 5px;
      font-size: 0.95rem;
    }
  </style>
</head>
<body>
  <div class="Auth">
    <div class="auth-content">
      <div class="part1 Img1">
        <div class="LogText">
          <h1>Connectez - <br>Vous</h1>
          <h3>Saisissez De nouvelles opportunités</h3>
        </div>
      </div>
      <div class="part2">
        <div class="part2-content">
          <div class="logo">
            <img src="../Assets/Images/mascot.png" alt="" class="mascot">
            <img src="../Assets/Images/logoLg.png" alt="" class="logolg">
          </div>

          <form method="POST" action="../Controllers/connexion_user.php" id="loginForm">
            <div class="formContent">
              <h2>Connexion</h2>

              <!-- ✅ Affichage de l'erreur ici -->
              <?php if (!empty($errorMessage)): ?>
              <div class="error-container">
                <?= htmlspecialchars($errorMessage) ?>
              </div>
              <?php endif; ?>

              <div class="inputLb">
                <label for="email">Entrez votre mail</label>    
                <input type="email" name="email" id="email" required>
                <small class="error-msg"></small>
              </div>

              <div class="inputLb">
                <label for="password">Entrez votre mot de passe</label>    
                <input type="password" name="password" id="password" required>
                <small class="error-msg"></small>
              </div>

              <div class="submit">
                <button type="submit" class="btn peachbg">Se Connecter</button>
              </div>
            </div>

            <a href="../Pages/Signup_choice.php" class="LinkAuth">Pas de compte ?<b><u>S'inscrire</u></b></a>
          </form>

          <!-- ✅ Pop-up de succès -->
          <div class="popup" id="successPopup">
            <div class="popup-content">
              <p>Connexion réussie ! 🎊</p>
              <button onclick="closePopup()">OK</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    AOS.init();
  </script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="../Assets/Js/Features.js"></script>
  <script src="./JsControllers/User_Login_Controller.js"></script>
</body>
</html>
