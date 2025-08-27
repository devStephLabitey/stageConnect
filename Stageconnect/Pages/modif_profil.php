<?php
session_start();
require_once '../Models/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../Auth/Login.php');
    exit();
}

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

// Formations
$sql_form = "SELECT diplome, ecole, date_obtention FROM formations WHERE etudiant_id = :id";
$stmt_form = $pdo->prepare($sql_form);
$stmt_form->execute([':id' => $user_id]);
$formations = $stmt_form->fetchAll(PDO::FETCH_ASSOC);

$formations_text = '';
foreach ($formations as $formation) {
    $formations_text .= $formation['diplome'] . ', ' . $formation['ecole'] . ', ' . $formation['date_obtention'] . "\n";
}

$sql_exp = "SELECT poste, entreprise, adresse, date_debut, date_fin, type_experience FROM experiences WHERE etudiant_id = :id";
$stmt_exp = $pdo->prepare($sql_exp);
$stmt_exp->execute([':id' => $user_id]);
$experiences = $stmt_exp->fetchAll(PDO::FETCH_ASSOC);

$experiences_text = '';
foreach ($experiences as $exp) {
    $experiences_text .= $exp['poste'] . ', ' . $exp['entreprise'] . ', ' . $exp['adresse'] . ', ' . $exp['date_debut'] . ' - ' . $exp['date_fin'] . ', ' . $exp['type_experience'] . "\n";
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="../Assets/Styles/Style.css">
  <title>Modifier mon profil</title>
</head>
<body>
    <div class="background">
         <div class="container-modif">

    <h2>Modifier mon profil</h2>
    <form action="../Controllers/modif_profil_controller.php" method="POST">
        <div class="info_bloc">
            <h3 class="peachColor">Information Contact</h3>
            <br>
                <div class="inputLb">
                    <label for="nom_complet">Nom complet</label>
                    <input type="text" id="nom_complet" name="nom_complet" value="<?php echo htmlspecialchars($user['nom_complet']); ?>" required>
                </div>
             
                <div class="inputLb">
                    <label for="email">Email</label>
                   <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                </div>
            
                <div class="inputLb">
                    <label for="filiere">Filière</label>
                    <input type="text" id="filiere" name="filiere" value="<?php echo htmlspecialchars($user['filiere']); ?>" required>
                </div>
            
                <div class="inputLb">
                    <label for="annee">Année</label>
                        <select name="annee" id="annee" required>
    <option value="LP2" <?php if($user['annee']=='LP2') echo 'selected'; ?>>LP2</option>
    <option value="LP3" <?php if($user['annee']=='LP3') echo 'selected'; ?>>LP3</option>
    <option value="Master1" <?php if($user['annee']=='Master1') echo 'selected'; ?>>Master 1</option>
    <option value="Master2" <?php if($user['annee']=='Master2') echo 'selected'; ?>>Master 2</option>
</select>
                </div>

        </div>
       

      
        <div class="info_bloc">
            <h3 class="peachColor">Compétences</h3>
            <br>
        <div class="inputLb">
        <label for="competences">Mentionnez vos Compétences </label>
       <textarea id="competences" name="competences" rows="3"><?php echo htmlspecialchars(implode(', ', $competences)); ?></textarea>
       
    </div>
        </div>


<!-- Formations -->
<div class="info_bloc">
    <h3 class="peachColor">Formations</h3>
    <?php if (!empty($formations)): ?>
        <?php foreach ($formations as $i => $formation): ?>
            <div class="formation-group" style="margin-bottom:1em; border-bottom:1px solid #eee; padding-bottom:1em;">
                <label>Diplôme</label>
                <input type="text" name="formations[<?php echo $i; ?>][diplome]" value="<?php echo htmlspecialchars($formation['diplome']); ?>" required>
                <label>École</label>
                <input type="text" name="formations[<?php echo $i; ?>][ecole]" value="<?php echo htmlspecialchars($formation['ecole']); ?>" required>
                <label>Date d'obtention</label>
                <input type="text" name="formations[<?php echo $i; ?>][date_obtention]" value="<?php echo htmlspecialchars($formation['date_obtention']); ?>" required>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune formation renseignée.</p>
    <?php endif; ?>
    <!-- Optionnel : bouton pour ajouter dynamiquement une formation en JS -->
</div>

<!-- Expériences -->
<div class="info_bloc">
    <h3 class="peachColor">Expériences</h3>
    <?php if (!empty($experiences)): ?>
        <?php foreach ($experiences as $i => $exp): ?>
            <div class="experience-group" style="margin-bottom:1em; border-bottom:1px solid #eee; padding-bottom:1em;">
                <label>Poste</label>
                <input type="text" name="experiences[<?php echo $i; ?>][poste]" value="<?php echo htmlspecialchars($exp['poste']); ?>" required>
                <label>Entreprise</label>
                <input type="text" name="experiences[<?php echo $i; ?>][entreprise]" value="<?php echo htmlspecialchars($exp['entreprise']); ?>" required>
                <label>Adresse</label>
                <input type="text" name="experiences[<?php echo $i; ?>][adresse]" value="<?php echo htmlspecialchars($exp['adresse']); ?>" required>
                <label>Date début</label>
                <input type="text" name="experiences[<?php echo $i; ?>][date_debut]" value="<?php echo htmlspecialchars($exp['date_debut']); ?>" required>
                <label>Date fin</label>
                <input type="text" name="experiences[<?php echo $i; ?>][date_fin]" value="<?php echo htmlspecialchars($exp['date_fin']); ?>">
                <label>Type d'expérience</label>
                <input type="text" name="experiences[<?php echo $i; ?>][type_experience]" value="<?php echo htmlspecialchars($exp['type_experience']); ?>" required>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Aucune expérience renseignée.</p>
    <?php endif; ?>
    <!-- Optionnel : bouton pour ajouter dynamiquement une expérience en JS -->
</div>
     

      <div class="submit">
        <button type="submit" class="btn peachbg">Enregistrer les modifications</button>
      </div>

    </form>
  </div>
    </div>
 
</body>
</html>
