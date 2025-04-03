<?php
function findUserConnect($email, $mot_de_passe) {
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("
                SELECT u.*, r.libelle as role 
                FROM utilisateur u
                JOIN role r ON u.id_role = r.id_role
                WHERE u.email = :email AND u.mot_de_passe = :mot_de_passe
            ");
            $stmt->execute(['email' => $email, 'mot_de_passe' => $mot_de_passe]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la connexion : " . $e->getMessage();
            return null;
        }
    }
    return null;
}

