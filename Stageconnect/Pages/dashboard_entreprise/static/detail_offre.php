<?php
// filepath: c:\Users\HP\Desktop\DOCUMENTS\Soutenance\AppliStageConnect\Stageconnect\Pages\Offer.php

session_start();
require_once '../../../Models/config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['entity'] !== 'entreprise') {
    header('Location: ../../../Auth/Login.php');
    exit();
}
// Vérifie la connexion de l'entreprise
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

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


if ($user_id) {
    // Récupère les infos de l'entreprise
    $stmt = $pdo->prepare("SELECT * FROM entreprises WHERE id = :id");
    $stmt->execute([':id' => $user_id]);
    $entreprise = $stmt->fetch(PDO::FETCH_ASSOC);

    // Récupère les offres publiées par cette entreprise
    $stmtOffres = $pdo->prepare("SELECT * FROM offres WHERE entreprise_id = :eid ORDER BY id DESC");
    $stmtOffres->execute(['eid' => $user_id]);
    $offres = $stmtOffres->fetchAll(PDO::FETCH_ASSOC);

} else {
    header('Location: ../Auth/Login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">
	<title>Votre Dashboard - Entreprise </title>
	<link href="css/app.css" rel="stylesheet">
	<link href="css/app2.css" rel="stylesheet">
    <link rel="stylesheet" href="css/app3.css">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<link rel="stylesheet" href="../../../Assets/Images/Logos/">
<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="dashBoard.php">
          			<span class="align-middle"><img src="./img/icons/StageConnec+removebg.png" alt="" style="height: 6vh;"></span>
        		</a>

			<ul class="sidebar-nav">
					<li class="sidebar-header">
						 
					</li

					<li class="sidebar-item ">
						<a class="sidebar-link" href="dashBoard.php">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-profile.php">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
            </a>
					</li>


					<li class="sidebar-item">
						<a class="sidebar-link" href="add_offer.php">
              <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Ajouter Offres</span>
            </a>
					</li>

					<li class="sidebar-item ">
						<a class="sidebar-link" href="pages-blank.php">
                         <i class="align-middle" data-feather="book"></i> <span class="align-middle">Blank</span>
                        </a>
					</li>

				</ul>

				<link rel="stylesheet" href="">

				<link rel="stylesheet" href="">
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
					
						
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                  <img src="<?php echo !empty($entreprise['logo']) ? '../../../Assets/Images/Logos/' . htmlspecialchars($entreprise['logo']) : 'img/avatars/avatar-4.jpg'; ?>"  class="avatar img-fluid rounded me-1" alt="Charles Hall" />  <span class="text-dark"><?php echo htmlspecialchars($entreprise['nom_entreprise']) ?></span>
              </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="pages-profile.php"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Mes Offres</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="../../../Controllers/logout.php">Log out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<!-- ...existing code... -->
<main class="content">
				<div class="container-fluid p-0">


					<div class="row">
						<div class="col-12">
							<div class="card" style="height: 120vh;">

								 <div class="bigBlock">
        <div class="detailBlock">
    <div class="detailInfo">
        <img src="<?php
            echo !empty($offer['image'])
                ? './img/offers/' . htmlspecialchars($offer['image'])
                : './img/offers/NouvelOffre.png';
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
                        ? '../../../Assets/Images/Logos/' . htmlspecialchars($entreprise['logo'])
                        : '../../../Assets/Images/logo.png';
                ?>') left/cover no-repeat; background-size: contain;">
                </div>
                <div class="bsName">
                    <?php echo htmlspecialchars($entreprise['nom_entreprise'] ?? ''); ?> (vous)
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
            <a class="poster">
              postulant(s) : <span class="countPoster">12</span>
            </a>
        </div>
    </div>
</div>

            <div class="moreOfferBlock">

              <h3>🔔 Vos offres</h3>


                <div class="offer_contain">
                    <?php if (!empty($offres)): ?>
                    <?php foreach ($offres as $offre): ?>
                <div class="offer-card">
                     <img src="<?= !empty($offre['image']) ? './img/offers/' . htmlspecialchars($offre['image']) : './img/offers/NouvelOffre.png'; ?>" alt="Offre" 		class="offer-img">
                    <h3 class="offer-title"><?= htmlspecialchars($offre['titre_poste']) ?></h3>
                    <?php
                 // description tronquée
                $maxLength = 120;
                $desc = htmlspecialchars($offre['description'] ?? '');
                if (mb_strlen($desc) > $maxLength) {
                    $desc = mb_substr($desc, 0, $maxLength) . '...';
                }
                echo '<p class="offer-desc">' . $desc . '</p>';
                ?>
                    <div class="offer-actions">
                   <a href="detail_offre.php?id=<?= $offre['id'] ?>" class="offer-link">Voir plus</a>
                    </div>
                </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucune offre publiée pour le moment.</p>
                <?php endif; ?>

            </div>
        </div>
        </div>

							
						</div>
					</div>

				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" href="https://adminkit.io/" target="_blank"><strong>AdminKit</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="https://adminkit.io/" target="_blank">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	<script src="js/app.js"></script>

</body>
</html>
