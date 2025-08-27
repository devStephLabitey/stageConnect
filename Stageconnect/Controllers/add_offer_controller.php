<?php
session_start();
require_once '../Models/config.php'; // Vérifie que le chemin est correct

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../Auth/Login.php");
        exit();
    }

    $entreprise_id = $_SESSION['user_id'];
    $titre = $_POST['titre'] ?? '';
    $description = $_POST['description'] ?? '';
    $duree = $_POST['duree'] ?? '';
    $lieu = $_POST['lieu'] ?? '';
    $type_contrat = $_POST['type'] ?? '';
    $categorie_id = $_POST['category'] ?? null;
    $date_publication = date('Y-m-d');
    $statut = "actif";

    // Gestion de l’image
    $image_path = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = "../Pages/dashboard_entreprise/static/img/offers/";
        $tmp_name = $_FILES['image']['tmp_name'];
        $original_name = basename($_FILES['image']['name']);
        $extension = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($extension, $allowed_extensions)) {
            $new_filename = uniqid('offer_', true) . '.' . $extension;
            $destination = $upload_dir . $new_filename;

            if (move_uploaded_file($tmp_name, $destination)) {
                $image_path = $new_filename;
            }
        }
    }

    // Insertion dans la base
    try {
        $stmt = $pdo->prepare("INSERT INTO offres (
            entreprise_id, titre_poste, description, duree, lieu, type_contrat, image, statut, date_publication, categorie_id
        ) VALUES (
            :entreprise_id, :titre, :description, :duree, :lieu, :type_contrat, :image, :statut, :date_publication, :categorie_id
        )");

        $stmt->execute([
            ':entreprise_id' => $entreprise_id,
            ':titre' => $titre,
            ':description' => $description,
            ':duree' => $duree,
            ':lieu' => $lieu,
            ':type_contrat' => $type_contrat,
            ':image' => $image_path,
            ':statut' => $statut,
            ':date_publication' => $date_publication,
            ':categorie_id' => $categorie_id
        ]);

        header("Location: ../Pages/dashboard_entreprise/static/dashBoard.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    header("Location: ../Pages/dashboard_entreprise/static/dashBoard.php");
    exit();
}
