<?php
function FindAllProfesseur()
{
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $stmt = $pdo->query("SELECT p.id_professeur, u.nom,u.prenom,p.specialite,p.grade
            FROM professeur p 
            JOIN utilisateur u 
            ON p.id_utilisateur=u.id_utilisateur;
          ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des professeurs : " . $e->getMessage();
            return [];
        }
    } else {
        return [];
    }
}
