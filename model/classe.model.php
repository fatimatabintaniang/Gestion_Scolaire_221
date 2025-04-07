<?php
function FindAllClasse() {
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $stmt = $pdo->query("SELECT * FROM classe");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des classes : " . $e->getMessage();
            return [];
        }
    } else {
        return [];
    }
 }

 function AddClasse($data) {
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO classe 
                (libelle, filiere, niveau) 
                VALUES (?, ?, ?)
            ");
            
            return $stmt->execute([
                $data['libelle'],
                $data['filiere'],
                $data['niveau'],
            ]);
            
        } catch (PDOException $e) {
            error_log("Erreur lors de l'ajout de classe : " . $e->getMessage());
            return false;
        }
    }
    return false;
}

 
 