<?php
function FindAllcoursProfesseur($id_professeur) {
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("
              SELECT c.date,c.heure_debut,c.heure_fin,c.semestre,cl.libelle AS classe
FROM professeur p
JOIN cours c ON p.id_professeur=c.id_professeur
JOIN cours_classe cc ON c.id_cours=cc.id_cours
JOIN classe cl ON cc.id_classe=cl.id_classe
WHERE p.id_professeur = :id_professeur 
ORDER BY c.date;
            ");
            $stmt->execute(['id_professeur' => $id_professeur]);
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
