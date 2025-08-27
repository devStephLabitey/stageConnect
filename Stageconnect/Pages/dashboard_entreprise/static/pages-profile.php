
<?php
session_start();
require_once '../../../Models/config.php';

// Supposons que tu as stocké l'ID de l'entreprise dans $_SESSION['user_id']
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($user_id) {
    $stmt = $pdo->prepare("SELECT * FROM entreprises WHERE id = :id");
    $stmt->execute([':id' => $user_id]);
    $entreprise = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // Redirige vers la page de connexion si non connecté
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
				<a class="sidebar-brand" href="dashBoard.php">
          			<span class="align-middle"><img src="./img/icons/StageConnec+removebg.png" alt="" style="height: 6vh;"></span>
        		</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						 
					</li

					<li class="sidebar-item">
						<a class="sidebar-link" href="dashBoard.php">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
					</li>

					<li class="sidebar-item active">
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
                <img  src="<?php echo !empty($entreprise['logo']) ? '../../../Assets/Images/Logos/' . htmlspecialchars($entreprise['logo']) : 'img/avatars/avatar-4.jpg'; ?>"  class="avatar img-fluid rounded me-1" alt="Charles Hall" />  <span class="text-dark"><?php echo htmlspecialchars($entreprise['nom_entreprise']) ?></span>
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

					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Profil</h1>
					</div>
					<div class="row">

<div class="col-md-4 col-xl-3">
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="card-title mb-0">Profile Details</h5>
        </div>
        <div class="card-body text-center">
            <img 
                src="<?php echo !empty($entreprise['logo']) ? '../../../Assets/Images/Logos/' . htmlspecialchars($entreprise['logo']) : 'img/avatars/avatar-4.jpg'; ?>" 
                alt="<?php echo htmlspecialchars($entreprise['nom_entreprise']); ?>" 
                class="img-fluid rounded-circle mb-2" width="128" height="128" 
            />
            <h5 class="card-title mb-0"><?php echo htmlspecialchars($entreprise['nom_entreprise']); ?></h5>
            <div class="text-muted mb-2"><?php echo htmlspecialchars($entreprise['secteur']); ?></div>
        </div>
        <hr class="my-0" />
        <div class="card-body">
            <h5 class="h6 card-title">À propos</h5>
            <ul class="list-unstyled mb-0">
                <li class="mb-1">
                    <span data-feather="user" class="feather-sm me-1"></span>
                    Recruteur : <?php echo htmlspecialchars($entreprise['nom_recruteur']); ?>
                </li>
                <li class="mb-1">
                    <span data-feather="mail" class="feather-sm me-1"></span>
                    Email : <?php echo htmlspecialchars($entreprise['email']); ?>
                </li>
                <li class="mb-1">
                    <span data-feather="briefcase" class="feather-sm me-1"></span>
                    Secteur : <?php echo htmlspecialchars($entreprise['secteur']); ?>
                </li>
            </ul>
        </div>
    </div>
</div>

						<div class="col-md-8 col-xl-9">
							<div class="card">
							     <div class="card-header">
							        <h5 class="card-title mb-0">Modifier les informations de l'entreprise</h5>
							    </div>
							    <div class="card-body h-100">
							        <form id="edit-company-form" method="POST" action="../../../Controllers/modif_bs_controller.php" enctype="multipart/form-data">
							
							            <div class="mb-3">
							                <label for="companyName" class="form-label">Nom de l'entreprise</label>
							                <input type="text" class="form-control" id="companyName" name="BsName" 
							                    placeholder="Entrez le nom de l'entreprise" 
							                    value="<?php echo htmlspecialchars($entreprise['nom_entreprise']); ?>" >
							            </div>
							
							            <div class="mb-3">
							                <label for="recruiterName" class="form-label">Nom du recruteur</label>
							                <input type="text" class="form-control" id="recruiterName" name="RecruterName" 
							                    placeholder="Nom du recruteur" 
							                    value="<?php echo htmlspecialchars($entreprise['nom_recruteur']); ?>" >
							            </div>
							
							            <div class="mb-3">
							                <label for="email" class="form-label">Email professionnel</label>
							                <input type="email" class="form-control" id="email" name="Bsmail" 
							                    placeholder="Entrez votre email professionnel" 
							                    value="<?php echo htmlspecialchars($entreprise['email']); ?>">
							            </div>
							
							
							            <div class="mb-3">
							                <label for="sector" class="form-label">Secteur d'activité</label>
							                <select class="form-control" id="sector" name="sector">
							                    <option value="">Choisissez votre secteur</option>
							                    <?php
							                        $secteurs = ['Informatique', 'Marketing', 'Finance', 'Santé', 'Éducation', 'Autre'];
							                        foreach ($secteurs as $secteur) {
							                            $selected = ($entreprise['secteur'] === $secteur) ? 'selected' : '';
							                            echo "<option value=\"$secteur\" $selected>$secteur</option>";
							                        }
							                    ?>
							                </select>
							            </div>
												
							            <div class="text-center mt-4">
							                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
							            </div>
							        </form>
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
								<a class="text-muted" href="" target="_blank"><strong>StageConnect</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="" target="_blank">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="" target="_blank">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="" target="_blank">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="" target="_blank">Terms</a>
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