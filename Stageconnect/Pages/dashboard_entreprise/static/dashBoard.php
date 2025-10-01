<?php
session_start();
require_once '../../../Models/config.php';
if (!isset($_SESSION['user_id']) || $_SESSION['entity'] !== 'entreprise') {
    header('Location: ../../../Auth/Login.php');
    exit();
}
// Vérifie la connexion de l'entreprise
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

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
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="../../index.php">
          			<span class="align-middle"><img src="./img/icons/StageConnec+removebg.png" alt="" style="height: 6vh;"></span>
        		</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						 
					</li

					<li class="sidebar-item active">
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

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-blank.php">
                         <i class="align-middle" data-feather="book"></i> <span class="align-middle">Blank</span>
                        </a>
					</li>

				</ul>

				
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

        <h1 class="h3 mb-3"><strong>Vos offres de stages - </strong> Dashboard</h1>

        <!-- Bouton Ajouter une offre -->
        <div class="mb-4">
            <a href="add_offer.php" class="btn btn-primary">Ajouter une offre</a>
            <a href="../../Offer.php" class="btn btn-primary">Voir les offres</a>
        </div>

        <!-- Statistiques des offres -->
        <div class="row">
            <div class="col-md-4">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Offres Disponibles</h5>
                        <p class="card-text display-6" style="color: #28a745;">12</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Offres Indisponibles</h5>
                        <p class="card-text display-6" style="color: #dc3545;">3</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stats-card">
                    <div class="card-body text-center">
                        <h5 class="card-title">Total Offres</h5>
                        <p class="card-text display-6" style="color: #007bff;">15</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

	<!-- ...après la section des statistiques... -->
<h2 class="mb-4 mt-5">Liste des offres</h2>
<div class="row">
    <?php if (!empty($offres)): ?>
    <?php foreach ($offres as $offre): ?>
        <div class="col-md-4">
            <div class="offer-card">
              <img src="<?= !empty($offre['image']) ? './img/offers/' . htmlspecialchars($offre['image']) : './img/offers/NouvelOffre.png'; ?>" alt="Offre" class="offer-img">
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
                    <form action="../../../Controllers/delete_offer_controller.php" method="POST" onsubmit="return confirm('Supprimer cette offre ?');" style="display:inline;">
                        <input type="hidden" name="offre_id" value="<?= $offre['id'] ?>">
                        <button type="submit" class="offer-btn apply">Supprimer</button>
                    </form>
                    <form action="../../../Controllers/update_offer_controller.php" method="POST" style="display:inline;">
                        <input type="hidden" name="offre_id" value="<?= $offre['id'] ?>">
                        <button type="submit" class="offer-btn" style="Background: blue; color: white; padding: 1vh; border: none; border-radius: 1vh;">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucune offre publiée pour le moment.</p>
<?php endif; ?>

    <!-- Ajoute d'autres offres ici -->
</div>
</main>
<!-- ...existing code... -->

			
		</div>
	</div>

	<script src="js/app.js"></script>

	

</body>

</html>