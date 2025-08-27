<?php
require_once '../Models/config.php'; // Connexion PDO

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    try {
        echo "Tentative de connexion avec l'email : $email<br>";

        // 1. Vérifier dans la table etudiants
        echo "Vérification dans la table 'etudiants'...<br>";
        $sql = "SELECT * FROM etudiants WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo "Utilisateur étudiant trouvé : " . $user['nom_complet'] . "<br>";
            echo "Mot de passe haché : " . $user['password'] . "<br>";

            if (password_verify($password, $user['password'])) {
                echo "Mot de passe vérifié avec succès pour l'étudiant.<br>";
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['fullname'] = $user['nom_complet'];
                $_SESSION['entity'] = "etudiant";

                echo "Redirection vers Offer.php...<br>";
                header('Location: ../Pages/Offer.php');
                exit();
            } else {
                echo "Mot de passe incorrect pour l'étudiant.<br>";
            }
        } else {
            echo "Aucun étudiant trouvé avec cet email.<br>";
        }

        // 2. Sinon, vérifier dans la table entreprises
        echo "Vérification dans la table 'entreprises'...<br>";
        $sql = "SELECT * FROM entreprises WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $entreprise = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($entreprise) {
            echo "Entreprise trouvée : " . $entreprise['nom_entreprise'] . "<br>";
            echo "Mot de passe haché : " . $entreprise['password'] . "<br>";

            if (password_verify($password, $entreprise['password'])) {
                echo "Mot de passe vérifié avec succès pour l'entreprise.<br>";
                session_start();
                $_SESSION['user_id'] = $entreprise['id'];
                $_SESSION['BsName'] = $entreprise['nom_entreprise'];
                $_SESSION['entity'] = $entreprise['entite'];

                echo "Redirection vers le dashboard entreprise...<br>";
                header('Location: ../Pages/dashboard_entreprise/static/dashBoard.php');
                exit();
            } else {
                echo "Mot de passe incorrect pour l'entreprise.<br>";
            }
        } else {
            echo "Aucune entreprise trouvée avec cet email.<br>";
        }

        // Si aucun match : identifiants invalides
        echo "Identifiants invalides. Redirection vers la page de login avec erreur.<br>";
        header('Location: ../Auth/Login.php?error=invalid_credentials');
        exit();

    } catch (PDOException $e) {
        echo "Erreur serveur : " . $e->getMessage();
        header('Location: ../Auth/Login.php?error=server');
        exit();
    }
}
?>
