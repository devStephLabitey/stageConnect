<?php
// filepath: c:\Users\HP\Desktop\DOCUMENTS\Soutenance\AppliStageConnect\Stageconnect\Controllers\delete_offer_controller.php

require_once '../Models/config.php';
session_start();

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: ../Auth/Login.php');
    exit();
}

// Vérifie que l'id de l'offre est passé en POST
if (isset($_POST['offer_id'])) {
    $offer_id = intval($_POST['offer_id']);

    // Suppression de l'offre
    $sql = "DELETE FROM offres WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $offer_id]);

    // Redirection après suppression
    header('Location: ../Pages/Offer.php?delete=success');
    exit();
} else {
    // Si aucun id n'est passé
    header('Location: ../Pages/Offer.php?delete=error');
    exit();
}
?>