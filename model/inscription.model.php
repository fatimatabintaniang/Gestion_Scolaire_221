<?php
function FindAllInscriptions()
{
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $stmt = $pdo->query("SELECT u.nom,u.prenom,u.email,e.matricule,e.adresse,c.libelle
                     FROM inscription p
                     JOIN etudiant e ON p.id_etudiant=e.id_etudiant
                     JOIN utilisateur u ON e.id_utilisateur=u.id_utilisateur
                     JOIN classe c ON p.id_classe=c.id_classe;
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
