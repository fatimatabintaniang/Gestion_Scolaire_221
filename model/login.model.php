<?php
function findUserConnect($email, $mot_de_passe) {
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("
                SELECT 
                u.*,
                r.libelle as role,
                e.id_etudiant,
                p.id_professeur
            FROM utilisateur u
            JOIN role r ON u.id_role = r.id_role
            LEFT JOIN etudiant e ON u.id_utilisateur = e.id_utilisateur
            LEFT JOIN professeur p ON u.id_utilisateur = p.id_utilisateur
            WHERE u.email = :email AND u.mot_de_passe = :mot_de_passe 
            AND (p.id_professeur IS NULL OR p.archive = 0)
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

