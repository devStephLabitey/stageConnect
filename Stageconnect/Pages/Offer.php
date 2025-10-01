<?php
// filepath: c:\Users\HP\Desktop\DOCUMENTS\Soutenance\AppliStageConnect\Stageconnect\Pages\Offer.php
// Vérifie que l'utilisateur est connecté, peu importe son entité
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ../Auth/Login.php');
    exit();
}

require_once '../Models/config.php';

// 1. Récupérer toutes les catégories ayant au moins une offre
$categories_stmt = $pdo->query("
    SELECT c.id, c.nom 
    FROM categories c
    JOIN offres o ON o.categorie_id = c.id
    WHERE o.statut = 'active'
    GROUP BY c.id, c.nom
    ORDER BY c.nom ASC
");
$categories = $categories_stmt->fetchAll(PDO::FETCH_ASSOC);




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
    <link rel="stylesheet" href="../Assets/Styles/Style.css">
    <title>Acceuil StageConnect</title>
</head>

<body>
     <div class="Home">

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
                    <div class="SearchSpace">
                        <input type="text" class="search-input" placeholder="Rechercher une offre..." />
                        <button class="search-btn">Rechercher</button>
                    </div>
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

        

        <div class="imgEntrepsise">
            <div class="couche2">
                <div class="EntrepriseContent">
                    <h2 style="color: white;">Recherche ici des opportunités enrichissantes </h2>
                    <h3><i>"Pleines d'expériences"</i></h3>
                    
                </div>
            </div>
        </div>


        <div class="keyWords">
            <div class="keyWords_content">
                <p class="">Appuyez sur un mot pour rechercher 🔍</p>

                <div class="keySome">
                <button class="keyword-btn">Informatique</button>
                <button class="keyword-btn">Marketing</button>
                <button class="keyword-btn">Finance</button>
                <button class="keyword-btn">RH</button>
                <button class="keyword-btn">Design</button>
                <button class="keyword-btn">Développement Web</button>
                <button class="keyword-btn">Autres</button>
                </div>
            </div>
        </div>
<?php
      $search = isset($_GET['q']) ? trim($_GET['q']) : '';
$cat_filter = isset($_GET['cat']) && $_GET['cat'] !== '' ? (int) $_GET['cat'] : null;

?>

         <div class="SectionLinks">
                   <form method="get" class="SearchSpace" style="display:flex;gap:1em;">
    <input type="text" class="search-input" name="q" placeholder="Rechercher une offre..." value="<?php echo isset($_GET['q']) ? htmlspecialchars($_GET['q']) : ''; ?>" />
    <select name="cat" class="search-select">
        <option value="">Toutes catégories</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?php echo $cat['id']; ?>" <?php if(isset($_GET['cat']) && $_GET['cat'] == $cat['id']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($cat['nom']); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <button class="search-btn" type="submit">Rechercher</button>
</form>
                </div>

                <!-- Ajoute ou remplace ce script dans Offer.html -->



        <!-- Ajoute cette section juste après la section des mots-clés dans Offer.html -->



<div class="offers-section">
<?php
if ($categories) {
    foreach ($categories as $categorie) {
        // Si un filtre catégorie est actif et que ce n'est pas la catégorie courante => on saute
        if ($cat_filter !== null && $cat_filter !== (int)$categorie['id']) {
            continue;
        }

        echo '<div class="categories">';
        echo '<h2 class="category">' . htmlspecialchars($categorie['nom']) . '</h2>';
        echo '<div class="offers-container">';

        // Préparer la requête des offres pour cette catégorie en appliquant le filtre recherche si nécessaire
        $sql = "SELECT * FROM offres WHERE categorie_id = :cat_id AND statut = 'active' ";
        $params = ['cat_id' => $categorie['id']];

        if ($search !== '') {
            $sql .= " AND titre_poste LIKE :search ";
            $params['search'] = '%' . $search . '%';
        }

        $sql .= " ORDER BY date_publication DESC";
        $offers_stmt = $pdo->prepare($sql);
        $offers_stmt->execute($params);
        $offers = $offers_stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($offers)) {
            foreach ($offers as $offer) {
                $image = !empty($offer['image'])
                    ? "../Pages/dashboard_entreprise/static/img/offers/" . htmlspecialchars($offer['image'])
                    : "../Assets/Images/NouvelOffre.png";

                echo '<div class="offer-card">';
                echo '<img src="' . htmlspecialchars($image) . '" alt="Offre" class="offer-img">';
                echo '<h3 class="offer-title">' . htmlspecialchars($offer['titre_poste']) . '</h3>';

                // description tronquée
                $maxLength = 120;
                $desc = htmlspecialchars($offer['description'] ?? '');
                if (mb_strlen($desc) > $maxLength) {
                    $desc = mb_substr($desc, 0, $maxLength) . '...';
                }
                echo '<p class="offer-desc">' . $desc . '</p>';

                echo '<p class="offer-datepub">' . htmlspecialchars($offer['date_publication'] ?? '') . '</p>';

                echo '<div class="offer-actions">';
                echo '<a href="./offerDetail.php?id=' . urlencode($offer['id']) . '">Voir plus</a>';
            if (isset($_SESSION['entity']) && $_SESSION['entity'] === 'etudiant') {
    echo '
    <form method="post" action="../Controllers/postuler_controller.php" style="display:inline;" onsubmit="return confirm(\'Voulez-vous vraiment postuler à cette offre ?\');">
        <input type="hidden" name="offre_id" value="' . htmlspecialchars($offer['id']) . '">
        <button type="submit" class="offer-btn apply">Postuler</button>
    </form>
    ';
}
                echo '</div>'; // offer-actions

                echo '</div>'; // offer-card
            }
        } else {
            echo '<p class="no-offer">Aucune offre disponible dans cette catégorie.</p>';
        }

        echo '</div>'; // .offers-container
        echo '</div>'; // .categories
    }
} else {
    echo '<p>Aucune catégorie trouvée avec des offres actives.</p>';
}
?>
</div>

    


    </div>
    </div>

</div>

<?php if (isset($_GET['postule'])): 
    $popupMsg = '';
    $offerId = isset($_GET['offre_id']) ? intval($_GET['offre_id']) : 0;
    if ($_GET['postule'] === 'success') {
        $popupMsg = "Votre postulation a bien été enregistrée !";
    } elseif ($_GET['postule'] === 'exists') {
        $popupMsg = "Vous avez déjà postulé à cette offre.";
    } else {
        $popupMsg = "Erreur lors de la postulation.";
    }
?>
<div id="postule-popup" class="popup-overlay">
    <div class="popup-content">
        <p><?php echo $popupMsg; ?></p>
        <div style="margin-top:1em;">
            <?php if ($offerId > 0): ?>
                <a href="offerDetail.php?id=<?php echo $offerId; ?>" class="popup-btn">Voir l'offre</a>
            <?php endif; ?>
            <button onclick="closePostulePopup()" class="popup-btn close-btn">Fermer</button>
        </div>
    </div>
</div>
<script>
function closePostulePopup() {
    document.getElementById('postule-popup').style.display = 'none';
}
setTimeout(closePostulePopup, 10000); // 10 secondes
</script>
<style>
.popup-overlay {
    position: fixed; left: 0; top: 0; width: 100vw; height: 100vh;
    background: rgba(0,0,0,0.3); display: flex; align-items: center; justify-content: center; z-index: 9999;
}
.popup-content {
    background: #fff; padding: 2em 2.5em; border-radius: 10px; box-shadow: 0 2px 16px #0002; text-align: center;
}
.popup-btn {
    background: #ff7f50; color: #fff; border: none; padding: 0.6em 1.2em; border-radius: 5px; margin: 0 0.5em; cursor: pointer; text-decoration: none;
}
.close-btn { background: #888; }
</style>
<?php endif; ?>
<!-- Ajoute ce style à la fin de ton fichier Style.css -->










                <footer>
                    <div class="footerContent">
                        <div class="ft-logo">
                            <div class="logo">
                                <img src="../Assets/Images/mascot.png"  class="mascot" alt="" />
                                <img src="../Assets/Images/logoLg.png" class="logolg" alt="" />
                            </div>
                        </div>

                        <div class="links">
                        <nav>
                            <a href="">Acceuil</a>
                            <a href="">A Propos</a>
                            <a href="">Fonctionnalités</a>
                            <a href="">Offres de stages <span>🔴</span></a>
                        </nav>
                    </div>
                    <div className="icons">
                       <a href=""> <i class="fi fi-brands-facebook"></i>
                        </a>
                       <a href=""> <i class="fi fi-brands-instagram"></i></a>

                        <a href=""><i class="fi fi-brands-linkedin"></i></a>
                        
                       <a href=""> <i class="fi fi-brands-twitter-alt-circle"></i></a>

                       <a href=""><i class="fi fi-brands-youtube"></i></a>
                    </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem nobis est ratione officia, placeat excepturi explicabo eaque! Necessitatibus facere culpa, optio nobis adipisci molestias qui tempore iure molestiae mollitia unde? </p>

                    </div>
                </footer>
           
        </div>

        <script>
            AOS.init();
        </script>

        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="../Assets/Js/Features.js"></script>
        <script src="../Assets/Js/Offer_Features.js"></script>
      

        
</body>
</html>