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
     <link rel="stylesheet" href="../Assets/Styles/Style.css">
  <link rel="stylesheet" href="../Assets/Styles/Style2.css">
  
 <title>StageConnect - Mon profil</title>
 
</head>
<body>


  <div class="body">

    <div class="Navbar">
           
            <div class="navbarContent">
                
                <div class="logo">
                    
                    <a href="index.php">
                        <img src="../Assets/Images/mascot.png" alt="logo" class='mascot'/>    
                    </a>
                    
                    <a href="index.php">
                        <img src="../Assets/Images/logoLg.png" alt="logo" class='logolg'/>    
                    </a>
                    
                    
                </div>

                <div class="SectionLinks">
                    <nav>
                        <a href="#Home">Acceuil</a>
                        <a href="#About">A propos</a>
                        <a href="#Features">Fonctionnalités</a>
                        <a href="Entreprise.php">Espace entreprise</a>
                        <a href="Offer.php" class='offer'>Offres de stages<span>🔴</span></a>
                    </nav>
                </div>

                 <div class="profil" id="profilMenu">
                    <div class="profil-content" onclick="toggleProfilPopup(event)">
                        <div class="userProfil">
                            <img src="" alt="">
                        </div>
                        <p class="UserName"><b>
                            <?php
                            if (isset($_SESSION['fullname'])) {
                                echo htmlspecialchars($_SESSION['fullname']);
                            } elseif (isset($_SESSION['BsName'])) {
                                echo htmlspecialchars($_SESSION['BsName']);
                            } else {
                                echo 'Utilisateur';
                            }
                            ?>
                        </b></p>

                        
                    </div>
                    <div class="profil-popup" id="profilPopup" style="display:none; display: flex;
                    flex-direction: column;">
                        
                        <?php
                            $profilLink = '#'; // valeur par défaut

                            if (isset($_SESSION['entity'])) {
                                if ($_SESSION['entity'] === 'etudiant') {
                                    $profilLink = './Profil.php';
                                } elseif ($_SESSION['entity'] === 'entreprise') {
                                    $profilLink = './dashboard_entreprise/static/pages-profile.php';
                                }
                            }
                            ?>
                        
                       
                        <a href="../Controllers/logout.php" class="logout-link">Se déconnecter</a>
                    </div>
                </div>
            
            </div>

        </div>


        <div class="body_container">
            <div class="sideBar">
                <div class="backgroundImage"></div>
                <div class="photoProfil" style="background: url(../Assets/Images/etudiant.jpg) left/cover no-repeat; background-size: cover;"></div>
                <div class="infoProfil">
                    <h3><?php echo htmlspecialchars($user['nom_complet']); ?></h3>
                    <p><?php echo htmlspecialchars($user['filiere']); ?></p>
                </div>

                <hr>
                <div class="buttons">
                          <button><a href="Profil.php">Mon Profil</a></button>
                          <button class="active"><a href="  .php">Offre(s) Postulé(s)</a></button>
                          <button><a href="myCv.html">Mon CV</a></button>
                    </div>

                    <div class="logOut">
                        <a href="../Controllers/logout.php" class="logout-link redColor">Se déconnecter</a>
                    </div>
                     

            </div>

            
                       <div class="container">
    <h2 class="peachColor" style="margin-bottom:2vh;">Mes offres postulé(es)</h2>

    <div class="offers-container">
        <?php
        // Récupérer les offres auxquelles l'étudiant a postulé
        $sql = "SELECT o.*, p.date_postulation, e.nom_entreprise
                FROM postulations p
                JOIN offres o ON o.id = p.offre_id
                JOIN entreprises e ON e.id = o.entreprise_id
                WHERE p.etudiant_id = :etudiant_id
                ORDER BY p.date_postulation DESC";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':etudiant_id' => $user_id]);
        $offres_postulees = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        if ($offres_postulees) {
            foreach ($offres_postulees as $offer) {
                $image = !empty($offer['image'])
                    ? "../Pages/dashboard_entreprise/static/img/offers/" . htmlspecialchars($offer['image'])
                    : "../Assets/Images/NouvelOffre.png";
                ?>
                
                <style>
                    :root{
                        --attente: #17b617;
                        --attenteBg: #08d20834;

                        --validee: #5c9ad1; 
                        --valideeBg: #007bff47;

                        --rejeteeBg: #ff5757;
                        --rejetee: white;
                    }
                </style>

                <div class="offer-card">

                
                    <div class="statutPlace">
                        <div class="statut" style="color: var(--attente); background: var(--attenteBg);">Attente</div>
                    </div>

                    <img src="<?= $image ?>" alt="Offre" class="offer-img">
                    <h3 class="offer-title"><?= htmlspecialchars($offer['titre_poste']) ?></h3>
                    <?php
                    // description tronquée
                $maxLength = 120;
                $desc = htmlspecialchars($offer['description'] ?? '');
                if (mb_strlen($desc) > $maxLength) {
                    $desc = mb_substr($desc, 0, $maxLength) . '...';
                }
                echo '<p class="offer-desc">' . $desc . '</p>';
                
                ?>

                    <p class="offer-entreprise"><b>Entreprise :</b> <?= htmlspecialchars($offer['nom_entreprise']) ?></p>
                    <p class="offer-datepub"><b>Postulé le :</b> <?= htmlspecialchars($offer['date_postulation']) ?></p>
                    <div class="offer-actions">
                        <a href="offerDetail.php?id=<?= urlencode($offer['id']) ?>">Voir plus</a>
                    </div>
                </div>
                
                <?php
            }
        } else {
            echo '<p style="color:#888;">Vous n\'avez postulé à aucune offre pour le moment.</p>';
        }
        ?>
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

 <script src="../Assets/Js/Features.js"></script>
        <script src="../Assets/Js/Offer_Features.js"></script>
</body>
</html>
