<?php
function FindAllCours() {
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $stmt = $pdo->query("
                SELECT 
                    c.id_cours,
                    c.date,
                    c.heure_debut,
                    c.heure_fin,
                    c.nombre_heures,
                    c.semestre,
                    u.prenom AS professeur,
                    m.libelle AS module
                FROM 
                    cours c
                LEFT JOIN 
                    professeur p ON c.id_professeur = p.id_professeur
                LEFT JOIN 
                    utilisateur u ON p.id_utilisateur = u.id_utilisateur
                LEFT JOIN
                    module m ON c.id_module = m.id_module
                ORDER BY c.date DESC
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