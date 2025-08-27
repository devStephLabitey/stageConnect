<?php
// filepath: c:\Users\HP\Desktop\DOCUMENTS\Soutenance\AppliStageConnect\Stageconnect\Controllers\modif_profil_controller.php

session_start();
require_once '../Models/config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../Auth/Login.php');
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sécuriser les entrées
    $nom_complet = htmlspecialchars(trim($_POST['nom_complet']));
    $email = htmlspecialchars(trim($_POST['email']));
    $filiere = htmlspecialchars(trim($_POST['filiere']));
    $annee = htmlspecialchars(trim($_POST['annee']));
    $competences = isset($_POST['competences']) ? explode(',', $_POST['competences']) : [];
    $formations = isset($_POST['formation']) ? explode("\n", trim($_POST['formation'])) : [];
    $experiences = isset($_POST['experience']) ? explode("\n", trim($_POST['experience'])) : [];

    // 1. Mettre à jour la table etudiants
    $sql = "UPDATE etudiants SET nom_complet = :nom_complet, email = :email, filiere = :filiere, annee = :annee WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':nom_complet' => $nom_complet,
        ':email' => $email,
        ':filiere' => $filiere,
        ':annee' => $annee,
        ':id' => $user_id
    ]);

    // 2. Mettre à jour les compétences (on supprime puis on réinsère)
    $pdo->prepare("DELETE FROM competences WHERE etudiant_id = :id")->execute([':id' => $user_id]);
    $sql_comp = "INSERT INTO competences (etudiant_id, nom_competence) VALUES (:id, :nom_competence)";
    $stmt_comp = $pdo->prepare($sql_comp);
    foreach ($competences as $comp) {
        $comp = trim($comp);
        if ($comp !== '') {
            $stmt_comp->execute([':id' => $user_id, ':nom_competence' => $comp]);
        }
    }

    // 3. Mettre à jour les formations (on supprime puis on réinsère)
    $pdo->prepare("DELETE FROM formations WHERE etudiant_id = :id")->execute([':id' => $user_id]);
    $sql_form = "INSERT INTO formations (etudiant_id, diplome, ecole, date_obtention) VALUES (:id, :diplome, :ecole, :date_obtention)";
    $stmt_form = $pdo->prepare($sql_form);
    foreach ($formations as $form) {
        $parts = array_map('trim', explode(',', $form));
        if (count($parts) === 3) {
            $stmt_form->execute([
                ':id' => $user_id,
                ':diplome' => $parts[0],
                ':ecole' => $parts[1],
                ':date_obtention' => $parts[2]
            ]);
        }
    }

    // 4. Mettre à jour les expériences (on supprime puis on réinsère)
    $pdo->prepare("DELETE FROM experiences WHERE etudiant_id = :id")->execute([':id' => $user_id]);
    $sql_exp = "INSERT INTO experiences (etudiant_id, poste, entreprise, adresse, date_debut, date_fin, type_experience) 
                VALUES (:id, :poste, :entreprise, :adresse, :date_debut, :date_fin, :type_experience)";
    $stmt_exp = $pdo->prepare($sql_exp);
    foreach ($experiences as $exp) {
        $parts = array_map('trim', explode(',', $exp));
        // poste, entreprise, adresse, date_debut - date_fin, type_experience
        if (count($parts) === 5) {
            // Séparer date_debut et date_fin
            $dates = explode('-', $parts[3]);
            $date_debut = isset($dates[0]) ? trim($dates[0]) : '';
            $date_fin = isset($dates[1]) ? trim($dates[1]) : '';
            $stmt_exp->execute([
                ':id' => $user_id,
                ':poste' => $parts[0],
                ':entreprise' => $parts[1],
                ':adresse' => $parts[2],
                ':date_debut' => $date_debut,
                ':date_fin' => $date_fin,
                ':type_experience' => $parts[4]
            ]);
        }
    }

    // Redirection après modification
    header('Location: ../Pages/Profil.php?success=1');
    exit();
}
?>