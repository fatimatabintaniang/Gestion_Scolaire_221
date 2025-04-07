<?php
function FindAllCoursEtudiant() {
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $stmt = $pdo->query("
               SELECT c.date,c.heure_debut,c.heure_fin,c.nombre_heures,c.semestre,u.nom AS professeur 
               FROM etudiant e JOIN absence a ON e.id_etudiant=a.id_etudiant
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