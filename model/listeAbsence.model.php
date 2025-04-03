<?php
function FindAllAbsences() {
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $stmt = $pdo->query("
               SELECT a.date,c.heure_debut,c.heure_fin,c.semestre,u.nom FROM absence a 
JOIN cours c ON a.id_cours=c.id_cours
JOIN professeur p ON c.id_professeur=p.id_professeur
JOIN utilisateur u ON p.id_utilisateur=u.id_utilisateur;
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des cours : " . $e->getMessage());
            return [];
        }
    } else {
        error_log("Erreur de connexion à la base de données");
        return [];
    }
}