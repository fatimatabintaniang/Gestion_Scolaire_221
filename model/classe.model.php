<?php
function FindAllClasse($search = '', $showArchived = false) {
    $pdo = connectToDatabase();
    if (!$pdo) return [];
    
    $sql = "SELECT * FROM classe";
    $where = [];
    $params = [];
    
    if (!empty($search)) {
        $where[] = "(filiere LIKE ? OR niveau LIKE ?)";
        $params = array_merge($params, ["%$search", "%$search%"]);
    }
    
    if (!$showArchived) {
        $where[] = "(archive IS NULL OR archive = 0)";
    }
    if (!empty($where)) {
        $sql .= " WHERE " . implode(" AND ", $where);
    }
    
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur lors de la récupération des classes: " . $e->getMessage());
        return [];
    }
}

function AddClasse($data)
{
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

function FindClasseById($id)
{
    $pdo = connectToDatabase();
    if (!$pdo) return null;

    try {
        $stmt = $pdo->prepare("SELECT * FROM classe WHERE id_classe = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur lors de la récupération de la classe: " . $e->getMessage());
        return null;
    }
}

function UpdateClasse($id, $data)
{
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("
                UPDATE classe 
                SET libelle = ?, filiere = ?, niveau = ?
                WHERE id_classe = ?
            ");

            return $stmt->execute([
                $data['libelle'],
                $data['filiere'],
                $data['niveau'],
                $id
            ]);
        } catch (PDOException $e) {
            error_log("Erreur lors de la modification de classe : " . $e->getMessage());
            return false;
        }
    }
    return false;
}

function getEtudiantsByClasse($id_classe)
{
    $pdo = connectToDatabase();
    if (!$pdo) return [];

    try {
        $sql = "SELECT u.nom,u.prenom,u.email,e.matricule,e.adresse FROM etudiant e 
              JOIN utilisateur u ON e.id_utilisateur=u.id_utilisateur
              JOIN inscription  i ON e.id_etudiant = i.id_etudiant 
              WHERE i.id_classe = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_classe]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erreur lors de la récupération des étudiants: " . $e->getMessage());
        return [];
    }
}

function archiverClasse($id_classe) {
    $pdo = connectToDatabase();
    if (!$pdo) return false;
    
    try {
        $stmt = $pdo->prepare("UPDATE classe SET archive = 1 WHERE id_classe = ?");
        return $stmt->execute([$id_classe]);
    } catch (PDOException $e) {
        error_log("Erreur lors de l'archivage: " . $e->getMessage());
        return false;
    }
}

function restaurerClasse($id_classe) {
    $pdo = connectToDatabase();
    if (!$pdo) return false;
    
    try {
        $stmt = $pdo->prepare("UPDATE classe SET archive = 0 WHERE id_classe = ?");
        return $stmt->execute([$id_classe]);
    } catch (PDOException $e) {
        error_log("Erreur lors de la restauration: " . $e->getMessage());
        return false;
    }
}
