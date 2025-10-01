<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../Auth/Login.php');
    exit();
}
require_once '../Models/config.php';

// Récupérer l'ID de l'offre depuis l'URL
$offer_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Récupérer les infos de l'offre
$offer = null;
$entreprise = null;
if ($offer_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM offres WHERE id = :id");
    $stmt->execute([':id' => $offer_id]);
    $offer = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($offer) {
        // Récupérer l'entreprise associée à l'offre
        $stmt2 = $pdo->prepare("SELECT * FROM entreprises WHERE id = :id");
        $stmt2->execute([':id' => $offer['entreprise_id']]);
        $entreprise = $stmt2->fetch(PDO::FETCH_ASSOC);
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

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
    <link rel="stylesheet" href="../Assets/Styles/Style.css">
    <title>Détails offres</title>
</head>

<body>

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
                        
                       
                        <a href="<?php echo $profilLink; ?>" class="profil-link">Voir profil</a>
                        <a href="../Controllers/logout.php" class="logout-link">Se déconnecter</a>
                    </div>
                </div>
            
            </div>

        </div>


    <div class="bigBlock">
        <div class="detailBlock">
    <div class="detailInfo">
        <img src="<?php
            echo !empty($offer['image'])
                ? '../Pages/dashboard_entreprise/static/img/offers/' . htmlspecialchars($offer['image'])
                : '../Assets/Images/AuthImg2.jpg';
        ?>" class="offer-img" alt="Image offre">

        <h1 class="Offer_title">
            Poste : <span><?php echo htmlspecialchars($offer['titre_poste'] ?? ''); ?></span>
        </h1>
       
        <p>
            <span style="color: #0000007b;">Description <br></span>
            <?php echo nl2br(htmlspecialchars($offer['description'] ?? '')); ?>
        </p>
        
        <div class="postInfosBs">
            <div class="bsInfo">
                <div class="bsLogo" style="background: url('<?php
                    echo !empty($entreprise['logo'])
                        ? '../Assets/Images/Logos/' . htmlspecialchars($entreprise['logo'])
                        : '../Assets/Images/logo.png';
                ?>') left/cover no-repeat; background-size: contain;">
                </div>
                <div class="bsName">
                    <?php echo htmlspecialchars($entreprise['nom_entreprise'] ?? ''); ?>
                </div>
            </div>

            <div class="postDate">
                Posté le : <span><?php echo htmlspecialchars($offer['date_publication'] ?? ''); ?></span>
            </div>
        </div>
    </div>

    <div class="infoBulles">
        <div class="part1">
            <div class="bull">
                Durée : <span><?php echo htmlspecialchars($offer['duree'] ?? 'Non précisée'); ?></span>
            </div>
            <div class="bull">
                Lieu : <span><?php echo htmlspecialchars($offer['lieu'] ?? 'Non précisé'); ?></span>
            </div>
        </div>
        <div class="part2">
           <?php
if (isset($_SESSION['entity']) && $_SESSION['entity'] === 'etudiant') {
    // Vérifier si déjà postulé
    $stmtPostule = $pdo->prepare("SELECT id FROM postulations WHERE etudiant_id = :etudiant_id AND offre_id = :offre_id");
    $stmtPostule->execute([
        ':etudiant_id' => $_SESSION['user_id'],
        ':offre_id' => $offer['id']
    ]);
    if ($stmtPostule->fetch()) {
        echo '<p style="color:#0dac0d;font-weight:bold;">Déjà Postulé(e)</p>';
    } else {
        echo '
        <form method="post" action="../Controllers/postuler_controller.php" style="display:inline;" onsubmit="return confirm(\'Voulez-vous vraiment postuler à cette offre ?\');">
            <input type="hidden" name="offre_id" value="' . htmlspecialchars($offer['id']) . '">
            <button type="submit" class="offer-btn apply">Postuler</button>
        </form>
        ';
    }
}
?>
        
    </div>
    </div>

        </div>

            <div class="moreOfferBlock" style="position: sticky; top: 2vh;">

                         <h3>🔔 Plus d'offres pour vous❗</h3>
                <div class="keyWords">
            <div class="keyWords_content">
                <div class="keySome">
                <a href="Offer.php" class="keyword-btn">Finance</a>
                <a href="Offer.php" class="keyword-btn">RH</a>
                <a href="Offer.php" class="keyword-btn">Autres</a>
                </div>
            </div>
        </div>


                <div class="offer_contain">
                    <div class="offer-card">
                        <img src="../Assets/Images/back.jpeg" alt="Offre" class="offer-img">
                        <h3 class="offer-title">Barber Professionnel</h3>
                         <p class="offer-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid ab, molestiae aliquam eligendi eum, quaerat provident non consequatur magnam quos cum dolore sed, necessitatibus nemo? Ullam quaerat odit id mollitia.</p>
                            <div class="offer-actions">
                            <a href="./offerDetail.html">Voir plus</a>
                            <button class="offer-btn apply">Postuler</button>
                            </div>
                    </div>

                    <div class="offer-card">
                        <img src="../Assets/Images/back.jpeg" alt="Offre" class="offer-img">
                        <h3 class="offer-title">Barber Professionnel</h3>
                         <p class="offer-desc">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid ab, molestiae aliquam eligendi eum, quaerat provident non consequatur magnam quos cum dolore sed, necessitatibus nemo? Ullam quaerat odit id mollitia.</p>
                            <div class="offer-actions">
                            <a href="./offerDetail.html">Voir plus</a>
                            <button class="offer-btn apply">Postuler</button>
                            </div>
                    </div>
                </div>

            </div>
        </div>

        <script src="../Assets/Js/Features.js"></script>
        <script src="../Assets/Js/Offer_Features.js"></script>
</body>
</html>