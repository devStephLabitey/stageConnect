<?php
// filepath: c:\Users\HP\Desktop\DOCUMENTS\Soutenance\AppliStageConnect\Stageconnect\Controllers\Entreprise_Signup_controller.php

session_start();
require_once '../Models/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    // Vérification des champs obligatoires
  

    // Vérification de l'email déjà utilisé
    if (!empty($_POST['Bsmail'])) {
        $check = $pdo->prepare("SELECT id FROM entreprises WHERE email = :email");
        $check->execute([':email' => trim($_POST['Bsmail'])]);
        if ($check->fetch()) {
            $errors[] = 'Cet email est déjà utilisé.';
        }
    }

    // Vérification du logo
    if (!isset($_FILES['BsLogo']) || $_FILES['BsLogo']['error'] !== UPLOAD_ERR_OK) {
        $errors[] = 'Le logo de l\'entreprise est requis.';
    }

    // Si erreurs, redirection avec message
    if (!empty($errors)) {
        $errorMsg = urlencode(implode('<br>', $errors));
        header('Location: ../Auth/Entreprise_Signup.php?error=' . $errorMsg);
        exit();
    }

    // Sécurisation des entrées
    $nom_entreprise = htmlspecialchars(trim($_POST['BsName']));
    $nom_recruteur  = htmlspecialchars(trim($_POST['RecruterName']));
    $email          = htmlspecialchars(trim($_POST['Bsmail']));
    $password       = password_hash($_POST['Bspwd'], PASSWORD_DEFAULT);
    $secteur        = htmlspecialchars(trim($_POST['sector']));
    $entite         = 'entreprise';
    $etat           = 'en_attente';
    $created_at     = date('Y-m-d H:i:s');

    // Gestion du logo
    $logo = null;
    if (isset($_FILES['BsLogo']) && $_FILES['BsLogo']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['BsLogo']['tmp_name'];
        $file_name = uniqid('logo_') . '_' . basename($_FILES['BsLogo']['name']);
        $destination = '../Assets/Images/Logos/' . $file_name;
        if (move_uploaded_file($tmp_name, $destination)) {
            $logo = $file_name;
        } else {
            $errorMsg = urlencode('Erreur lors de l\'upload du logo.');
            header('Location: ../Auth/Entreprise_Signup.php?error=' . $errorMsg);
            exit();
        }
    }

    $photo_profil = $logo;

    // Insertion dans la base
    try {
        $sql = "INSERT INTO entreprises (nom_entreprise, nom_recruteur, email, password, secteur, logo, photo_profil, etat, created_at, entite)
                VALUES (:nom_entreprise, :nom_recruteur, :email, :password, :secteur, :logo, :photo_profil, :etat, :created_at, :entite)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom_entreprise' => $nom_entreprise,
            ':nom_recruteur'  => $nom_recruteur,
            ':email'          => $email,
            ':password'       => $password,
            ':secteur'        => $secteur,
            ':logo'           => $logo,
            ':photo_profil'   => $photo_profil,
            ':etat'           => $etat,
            ':created_at'     => $created_at,
            ':entite'         => $entite
        ]);

        // ...avant la redirection...
        if (!empty($errors)) {
            // On passe les erreurs sous forme de tableau associatif
            $errorParams = [];
            foreach ($errors as $key => $msg) {
                $errorParams[] = $key . '=' . urlencode($msg);
            }
            $errorQuery = implode('&', $errorParams);
            header('Location: ../Auth/Entreprise_Signup.php?' . $errorQuery);
            exit();
        }
        
        if ($stmt->rowCount() > 0) {
            header('Location: ../Auth/Login.php?register=success');
            exit();
        } else {
            header('Location: ../Auth/Entreprise_Signup.php?error=' . $errorMsg);
            exit();
        }
    } catch (PDOException $e) {
        header('Location: ../Auth/Entreprise_Signup.php?error=' . $errorMsg);
        exit();
    }
}
?>