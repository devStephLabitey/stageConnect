<?php
session_start();
require_once '../../../Models/config.php';

// Vérification de connexion utilisateur
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($user_id) {
    $stmt = $pdo->prepare("SELECT * FROM entreprises WHERE id = :id");
    $stmt->execute([':id' => $user_id]);
    $entreprise = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // Redirige vers la page de connexion si non connecté
    header('Location: ../../../Auth/Login.php');
    exit();
}

// Récupération des catégories depuis la base
try {
    $stmtCat = $pdo->query("SELECT id, nom FROM categories");
    $categories = $stmtCat->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $categories = [];
    echo "Erreur de chargement des catégories : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Créer une offre de stage">
    <title>Créer une offre de stage</title>
    <link href="css/app.css" rel="stylesheet">
    <link href="css/app2.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">Créer une offre de stage</h1>
                            <p class="lead">
                                Remplissez le formulaire pour publier une nouvelle offre.
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <form method="POST" action="../../../Controllers/add_offer_controller.php" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label class="form-label">Titre de l'offre</label>
                                            <input class="form-control form-control-lg" type="text" name="titre" placeholder="Ex: Stage Développeur Web" required />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control form-control-lg" name="description" rows="4" placeholder="Décrivez l'offre" required></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Catégories</label>
                                            <select class="form-control form-control-lg" name="category" required>
                                                <option value="">Sélectionnez</option>
                                                <?php foreach ($categories as $cat): ?>
                                                    <option value="<?= htmlspecialchars($cat['id']) ?>">
                                                        <?= htmlspecialchars($cat['nom']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>


                                        <div class="mb-3">
                                            <label class="form-label">Durée</label>
                                            <input class="form-control form-control-lg" type="text" name="duree" placeholder="Ex: 3 mois" required />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Lieu</label>
                                            <input class="form-control form-control-lg" type="text" name="lieu" placeholder="Ex: Paris, Télétravail..." required />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Type</label>
                                            <select class="form-control form-control-lg" name="type" required>
                                                <option value="">Sélectionnez</option>
                                                <option value="Stage">Stage</option>
                                                <option value="Alternance">Alternance</option>
                                                <option value="CDD">CDD</option>
                                                <option value="CDI">CDI</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Image (optionnel)</label>
                                            <input class="form-control form-control-lg" type="file" name="image" accept="image/*" />
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Publier l'offre</button>
                                            <a href="dashBoard.php" class="btn btn-lg btn-secondary ms-2">Annuler</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>



    <script src="js/app.js"></script>
    <!-- <script src="js/app2.js"></script> -->
</body>
</html>