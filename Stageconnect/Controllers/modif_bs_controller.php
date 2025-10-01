<?php
// filepath: Stageconnect/Controllers/Entreprise_Update_controller.php

session_start();
require_once '../Models/config.php';

// Vérifie que l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: ../Auth/Login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    $entreprise_id = $_SESSION['user_id'];

    // Sécurisation des données
    $nom_entreprise = htmlspecialchars(trim($_POST['BsName']));
    $nom_recruteur  = htmlspecialchars(trim($_POST['RecruterName']));
    $email          = htmlspecialchars(trim($_POST['Bsmail']));
    $secteur        = htmlspecialchars(trim($_POST['sector']));

    // Vérifier si l'email est utilisé par une autre entreprise
    $check = $pdo->prepare("SELECT id FROM entreprises WHERE email = :email AND id != :id");
    $check->execute([':email' => $email, ':id' => $entreprise_id]);
    if ($check->fetch()) {
        $errors[] = 'Cet email est déjà utilisé par une autre entreprise.';
    }

    if (!empty($errors)) {
        $errorMsg = urlencode(implode('<br>', $errors));
        header('Location: ../Entreprise/Profil_Edit.php?error=' . $errorMsg);
        exit();
    }

    // Mise à jour
    try {
        $update = $pdo->prepare("UPDATE entreprises SET 
            nom_entreprise = :nom_entreprise,
            nom_recruteur = :nom_recruteur,
            email = :email,
            secteur = :secteur
            WHERE id = :id");

        $update->execute([
            ':nom_entreprise' => $nom_entreprise,
            ':nom_recruteur'  => $nom_recruteur,
            ':email'          => $email,
            ':secteur'        => $secteur,
            ':id'             => $entreprise_id
        ]);

        header('Location: ../Entreprise/Profil.php');
        exit();
    } catch (PDOException $e) {
        $errorMsg = urlencode("Erreur lors de la mise à jour.");
        header('Location: ../Entreprise/Profil_Edit.php?error=' . $errorMsg);
        exit();
    }
}
?>
