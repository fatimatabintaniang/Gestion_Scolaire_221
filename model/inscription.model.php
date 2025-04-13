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

//==========================fonction qui permet d'ajouter les cours =============================
function AddInscription($data) {
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $pdo->beginTransaction();
            
            // 1. Insérer l'utilisateur
            $stmt = $pdo->prepare("
                INSERT INTO utilisateur
                (nom, prenom, email, role) 
                VALUES (?, ?, ?, 'etudiant')
            ");
            $stmt->execute([
                $data['nom'],
                $data['prenom'],
                $data['email']
            ]);
            $userId = $pdo->lastInsertId();
            
            // 2. Insérer l'étudiant
            $stmt = $pdo->prepare("
                INSERT INTO etudiant
                (id_utilisateur, matricule, adresse) 
                VALUES (?, ?, ?)
            ");
            $stmt->execute([
                $userId,
                $data['matricule'],
                $data['adresse']
            ]);
            $etudiantId = $pdo->lastInsertId();
            
            // 3. Insérer l'inscription
            $stmt = $pdo->prepare("
                INSERT INTO inscription
                (id_etudiant, id_classe, annee_scolaire) 
                VALUES (?, ?, ?)
            ");
            $stmt->execute([
                $etudiantId,
                $data['classe'],
                date('Y') // Année scolaire actuelle
            ]);
            
            $pdo->commit();
            return true;
            
        } catch (PDOException $e) {
            $pdo->rollBack();
            error_log("Erreur lors de l'ajout de l'inscription : " . $e->getMessage());
            return false;
        }
    }
    return false;
}