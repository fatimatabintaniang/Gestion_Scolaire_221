<?php
function FindAllCoursEtudiant($id_etudiant, $search = null) {
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            // Requête de base
            $sql = "SELECT c.date, c.heure_debut, c.heure_fin, c.nombre_heures, c.semestre, u.nom AS professeur 
                FROM etudiant e 
                JOIN inscription i ON e.id_etudiant = i.id_etudiant 
                JOIN classe cl ON i.id_classe = cl.id_classe 
                JOIN cours_classe cc ON cl.id_classe = cc.id_classe 
                JOIN cours c ON cc.id_cours = c.id_cours 
                JOIN professeur p ON c.id_professeur = p.id_professeur 
                JOIN utilisateur u ON p.id_utilisateur = u.id_utilisateur
                WHERE e.id_etudiant = :id_etudiant";
            
            // Ajout de la condition de recherche si elle existe
            if (!empty($search)) {
                $sql .= " AND c.semestre LIKE :search";
            }
            
            // Ajout du ORDER BY à la fin
            $sql .= " ORDER BY c.date";
            
            $stmt = $pdo->prepare($sql);
            $params = ['id_etudiant' => $id_etudiant];
            
            if (!empty($search)) {
                $params['search'] = '%'.$search.'%';
            }
            
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des cours : ".$e->getMessage());
            return [];
        }
    }
    return [];
}


