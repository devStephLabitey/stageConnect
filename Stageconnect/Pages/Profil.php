<?php
// filepath: c:\Users\HP\Desktop\DOCUMENTS\Soutenance\AppliStageConnect\Stageconnect\Pages\Profil.php

session_start();
require_once '../Models/config.php';

// Vérifie que l'utilisateur est connecté ET que son entité est bien "etudiant"
if (
    !isset($_SESSION['user_id']) 
) {
    header('Location: ../Auth/Login.php');
    exit();
}

// Récupérer les infos de l'utilisateur connecté
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM etudiants WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);


// Récupérer les compétences liées à l'étudiant
$sql_comp = "SELECT nom_competence FROM competences WHERE etudiant_id = :id";
$stmt_comp = $pdo->prepare($sql_comp);
$stmt_comp->execute([':id' => $user_id]);
$competences = $stmt_comp->fetchAll(PDO::FETCH_COLUMN);

// Récupérer les formations liées à l'étudiant
$sql_form = "SELECT diplome, ecole, date_obtention FROM formations WHERE etudiant_id = :id";
$stmt_form = $pdo->prepare($sql_form);
$stmt_form->execute([':id' => $user_id]);
$formations = $stmt_form->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les expériences liées à l'étudiant
$sql_exp = "SELECT poste, entreprise, adresse, date_debut, date_fin, type_experience FROM experiences WHERE etudiant_id = :id";
$stmt_exp = $pdo->prepare($sql_exp);
$stmt_exp->execute([':id' => $user_id]);
$experiences = $stmt_exp->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
 <link rel="stylesheet" href="../Assets/Styles/Style2.css">
  <title>StageConnect - Mon profil</title>
 
</head>
<body>
  <div class="body">
    <div class="container">
    <div class="header">
      <div class="logo"><a href="./index.php"><img src="../Assets/Images/logoLg.png" alt=""></a></div>
      <div class="nav">
       <a href="./modif_profil.php" class="bluebg btn">Modifier votre Profil</a>
      </div>
    </div>

    <div class="profile">
      <img src="../Assets/Images/utilisateurs.png" alt="Jeremy Rose"/>
      <div class="profile-info">
        
       <div class="user-info-profil">
          <h2><?php echo htmlspecialchars($user['nom_complet']); ?></h2>
            
        
        <p class="role">
          <?php echo htmlspecialchars($user['filiere']); ?></p>
        
       </div>
        <div class="rating" style="color: gold;">
        <?php echo htmlspecialchars($user['annee']); ?>
        </div>
        
        <div class="buttons">
          <button>Modifier photo</button> <button>Voir CV</button>
        </div>
      </div>
    </div>

    <div class="tabs">
      <a href="#" class="active">À propos</a>
    </div>

    <div class="section">
      <div class="block">
        <h3 class="peachColor">Contact Information</h3>
         <p><strong>Email:</strong> <a href="mailto:<?php echo htmlspecialchars($user['email']); ?>"><?php echo htmlspecialchars($user['email']); ?></a></p>
        <p><strong>Filière:</strong> <?php echo htmlspecialchars($user['filiere']); ?></p>
        <p><strong>Année:</strong> <?php echo htmlspecialchars($user['annee']); ?></p>
        <p><strong>Matricule:</strong> <?php echo htmlspecialchars($user['matricule']); ?></p>
        <br><br>
     
          <h3 class="peachColor">Compétences</h3>
          <?php if (!empty($competences)): ?>
              <?php foreach ($competences as $comp): ?>
                  <p><?php echo htmlspecialchars($comp); ?></p>
              <?php endforeach; ?>
          <?php else: ?>
              <p>Aucune compétence renseignée.</p>
          <?php endif; ?>

      </div>
     
<!-- Formations -->
<div class="block">
  <h3 class="peachColor">Formations</h3>
  <?php if (!empty($formations)): ?>
      <ul class="formation-list">
      <?php foreach ($formations as $formation): ?>
          <li class="formation-item">
            <div>
              <strong><?php echo htmlspecialchars($formation['diplome']); ?></strong>
              <span class="blueColor"><?php echo htmlspecialchars($formation['date_obtention']); ?></span><br>
              <span class="formation-ecole"><?php echo htmlspecialchars($formation['ecole']); ?></span>
            </div>
            <!-- Boutons pour modification/suppression (à relier plus tard) -->
          </li>
      <?php endforeach; ?>
      </ul>
  <?php else: ?>
      <p>Aucune formation renseignée.</p>
  <?php endif; ?>
 

</div>

<!-- Expériences -->
<div class="block">
  <h3 class="peachColor">Expériences</h3>
  <?php if (!empty($experiences)): ?>
      <ul class="experience-list">
      <?php foreach ($experiences as $exp): ?>
          <li class="experience-item">
            <div>
              <strong><?php echo htmlspecialchars($exp['poste']); ?></strong>
              <span class="badge"><?php echo htmlspecialchars($exp['type_experience']); ?></span><br>
              <span><?php echo htmlspecialchars($exp['entreprise']); ?> - <?php echo htmlspecialchars($exp['adresse']); ?></span><br>
              <small>
                <?php echo htmlspecialchars($exp['date_debut']); ?>
                <?php if ($exp['date_fin']) echo ' au ' . htmlspecialchars($exp['date_fin']); ?>
              </small>
            </div>
            <!-- Boutons pour modification/suppression (à relier plus tard) -->
            <div class="experience-actions">
              <button class="btn-edit" title="Modifier">✏️</button>
              <button class="btn-delete" title="Supprimer">🗑️</button>
            </div>
          </li>
      <?php endforeach; ?>
      </ul>
  <?php else: ?>
      <p>Aucune expérience renseignée.</p>
  <?php endif; ?>
  <button class="btn peachbg" style="margin-top:1em;">Ajouter une expérience</button>
</div>
      
      
    </div>
  </div>
  </div>

  <script>
// Ouvre le popup
document.getElementById('ajout_formation').onclick = function() {
    document.getElementById('popupFormation').style.display = 'flex';
};
document.getElementById('ajout_exp').onclick = function() {
    document.getElementById('popupExperience').style.display = 'flex';
};
// Ferme le popup
function closePopup(id) {
    document.getElementById(id).style.display = 'none';
}
// Fermer le popup si on clique en dehors du contenu
document.querySelectorAll('.popup-overlay').forEach(function(popup){
    popup.addEventListener('click', function(e){
        if(e.target === popup) popup.style.display = 'none';
    });
});
</script>

<style>
/* Popups */
.popup-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background: rgba(0,0,0,0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
}
.popup-content {
    background: #fff;
    border-radius: 1.5vh;
    padding: 2em 2.5em;
    min-width: 320px;
    box-shadow: 0 4px 24px rgba(82,113,255,0.13);
    display: flex;
    flex-direction: column;
    gap: 1em;
}
.popup-content h3 {
    margin-top: 0;
    color: var(--blue, #526fff);
    text-align: center;
}
.popup-content input {
    padding: 0.7em 1em;
    border: 1px solid #dbeafe;
    border-radius: 1vh;
    font-size: 1em;
    background: #f8fafc;
}
.popup-actions {
    display: flex;
    gap: 1em;
    justify-content: flex-end;
}
</style>
</body>
</html>
