<?php
// filepath: c:\Users\HP\Desktop\DOCUMENTS\Soutenance\AppliStageConnect\Stageconnect\Controllers\enregistrer_etudiant.php

// Inclure votre fichier de connexion PDO ici
require_once '../Models/config.php'; // Modifiez le chemin si besoin

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer et sécuriser les données du formulaire
    $fullname  = htmlspecialchars(trim($_POST['fullname']));
    $email     = htmlspecialchars(trim($_POST['email']));
    $password  = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash du mot de passe
    $entity    = htmlspecialchars(trim($_POST['entity']));
    $filiere   = htmlspecialchars(trim($_POST['filiere']));
    $annee     = htmlspecialchars(trim($_POST['annee']));
    $matricule = htmlspecialchars(trim($_POST['matricule']));

    try {
        // Préparer la requête d'insertion
        $sql = "INSERT INTO etudiants (nom_complet, email, password, filiere, annee, matricule, entity)
                VALUES (:fullname, :email, :password, :filiere, :annee, :matricule, :entity)";
        $stmt = $pdo->prepare($sql);

        // Exécuter la requête
        $stmt->execute([
            ':fullname'  => $fullname,
            ':email'     => $email,
            ':password'  => $password,
            ':filiere'   => $filiere,
            ':annee'     => $annee,
            ':matricule' => $matricule,
            ':entity'    => $entity
        ]);

        // Redirection ou message de succès
        header('Location: ../Auth/Login.php');
        exit();
    } catch (PDOException $e) {
        // Gestion d'erreur
        echo "Erreur lors de l'inscription : " . $e->getMessage();
    }
}
?>