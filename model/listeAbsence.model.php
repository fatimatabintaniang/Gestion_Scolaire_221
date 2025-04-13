<?php
function FindAllAbsences($id_etudiant) {
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("
                SELECT 
                    a.date,
                    c.heure_debut,
                    c.heure_fin,
                    c.semestre,
                    u.nom as professeur,
                    m.libelle as module
                FROM absence a 
                JOIN cours c ON a.id_cours = c.id_cours
                JOIN module m ON c.id_module = m.id_module
                JOIN professeur p ON c.id_professeur = p.id_professeur
                JOIN utilisateur u ON p.id_utilisateur = u.id_utilisateur
                JOIN etudiant e ON a.id_etudiant = e.id_etudiant
                WHERE e.id_etudiant = :id_etudiant
                ORDER BY a.date DESC, c.heure_debut DESC
            ");
            
            $stmt->execute(['id_etudiant' => $id_etudiant]);
            $absences = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Formatage des dates et heures pour un affichage plus lisible
            foreach ($absences as &$absence) {
                $absence['date'] = date('d/m/Y', strtotime($absence['date']));
                $absence['heure_debut'] = date('H:i', strtotime($absence['heure_debut']));
                $absence['heure_fin'] = date('H:i', strtotime($absence['heure_fin']));
            }
            
            return $absences;
            
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des absences : " . $e->getMessage());
            return [];
        }
    } else {
        error_log("Erreur de connexion à la base de données");
        return [];
    }
}