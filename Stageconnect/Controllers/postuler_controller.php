<?php
session_start();
require_once '../Models/config.php';

if (!isset($_SESSION['user_id']) || $_SESSION['entity'] !== 'etudiant') {
    header('Location: ../Auth/Login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['offre_id'])) {
    $etudiant_id = $_SESSION['user_id'];
    $offre_id = intval($_POST['offre_id']);
    $date_postulation = date('Y-m-d');
    $statut = 'en_attente';
    $commentaire = ''; // À compléter si tu veux un champ commentaire

    // Vérifier si déjà postulé
    $check = $pdo->prepare("SELECT id FROM postulations WHERE etudiant_id = :etudiant_id AND offre_id = :offre_id");
    $check->execute([':etudiant_id' => $etudiant_id, ':offre_id' => $offre_id]);
    if ($check->fetch()) {
        header('Location: ../Pages/Offer.php?postule=exists');
        exit();
    }

    // Insérer la postulation
    $stmt = $pdo->prepare("INSERT INTO postulations (etudiant_id, offre_id, date_postulation, statut, commentaire)
                           VALUES (:etudiant_id, :offre_id, :date_postulation, :statut, :commentaire)");
    $stmt->execute([
        ':etudiant_id' => $etudiant_id,
        ':offre_id' => $offre_id,
        ':date_postulation' => $date_postulation,
        ':statut' => $statut,
        ':commentaire' => $commentaire
    ]);

    header('Location: ../Pages/Offer.php?postule=success&offre_id=' . $offre_id);
    exit();
} else {
    header('Location: ../Pages/Offer.php?postule=error');
    exit();
}
