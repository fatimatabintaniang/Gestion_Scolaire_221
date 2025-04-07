<?php
function FindAllProfesseur($searchTerm = '', $page = null, $perPage = null)
{
    $pdo = connectToDatabase();
    if (!$pdo) {
        error_log("[ERREUR] Connexion DB échouée");
        return $page !== null ? ['professeurs' => [], 'total' => 0] : [];
    }

    try {
        // Construction de la requête de base
        $sql = "SELECT DISTINCT p.id_professeur, u.nom, u.prenom, p.specialite, p.grade
                FROM professeur p 
                JOIN utilisateur u ON p.id_utilisateur = u.id_utilisateur
                WHERE 1=1";
        
        $params = [];
        
        // Ajout des conditions de recherche si searchTerm n'est pas vide
        if (!empty($searchTerm)) {
            $sql .= " AND (u.nom LIKE :search OR u.prenom LIKE :search OR p.specialite LIKE :search)";
            $params[':search'] = '%' . $searchTerm . '%';
        }
        
        // Mode pagination
        if ($page !== null && $perPage !== null) {
            // D'abord calculer le total
            $countSql = "SELECT COUNT(DISTINCT p.id_professeur) as total 
                        FROM professeur p 
                        JOIN utilisateur u ON p.id_utilisateur = u.id_utilisateur
                        WHERE 1=1";
            
            if (!empty($searchTerm)) {
                $countSql .= " AND (u.nom LIKE :search OR u.prenom LIKE :search OR p.specialite LIKE :search)";
            }
            
            $stmt = $pdo->prepare($countSql);
            $stmt->execute($params);
            $total = $stmt->fetchColumn();
            
            // Puis récupérer les résultats paginés
            $sql .= " LIMIT :offset, :limit";
            $offset = ($page - 1) * $perPage;
            
            $stmt = $pdo->prepare($sql);
            
            // Bind des paramètres
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
            $stmt->execute();
            
            return [
                'professeurs' => $stmt->fetchAll(PDO::FETCH_ASSOC),
                'total' => $total,
                'currentPage' => $page,
                'perPage' => $perPage
            ];
        }
        // Mode simple (sans pagination)
        else {
            error_log("[DEBUG] Requête SQL: $sql");
            error_log("[DEBUG] Paramètres: " . print_r($params, true));
            
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
    } catch (PDOException $e) {
        error_log("[ERREUR SQL] " . $e->getMessage());
        return $page !== null ? ['professeurs' => [], 'total' => 0] : [];
    }
}

function AddProfesseur($data) {
    $pdo = connectToDatabase();
    $stmt = $pdo->prepare("
        INSERT INTO professeur 
        (id_utilisateur, specialite, grade) 
        VALUES (?, ?, ?)
    ");
    $stmt->execute([
        $data['id_utilisateur'],
        $data['specialite'],
        $data['grade']
    ]);
    return $pdo->lastInsertId();
}

function affecterProfesseurClasse($professeurId, $classeId)
{
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO professeur_classe 
                (id_professeur, id_classe) 
                VALUES (?, ?)
            ");
            return $stmt->execute([$professeurId, $classeId]);
        } catch (PDOException $e) {
            error_log("Erreur lors de l'affectation classe-professeur : " . $e->getMessage());
            return false;
        }
    }
    return false;
}

function FindProfesseurById($id) {
    $pdo = connectToDatabase();
    $stmt = $pdo->prepare("
        SELECT p.id_professeur, u.id_utilisateur, u.nom, u.prenom, u.email, 
               p.specialite, p.grade 
        FROM professeur p 
        JOIN utilisateur u ON p.id_utilisateur = u.id_utilisateur
        WHERE p.id_professeur = ?
    ");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function FindClassesByProfesseur($professeurId) {
    $pdo = connectToDatabase();
    $stmt = $pdo->prepare("
        SELECT id_classe FROM professeur_classe 
        WHERE id_professeur = ?
    ");
    $stmt->execute([$professeurId]);
    return $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
}

function UpdateProfesseur($id, $data) {
    $pdo = connectToDatabase();
    
    // Mise à jour de l'utilisateur
    $stmt = $pdo->prepare("
        UPDATE utilisateur SET 
        nom = ?, prenom = ?, email = ?
        WHERE id_utilisateur = ?
    ");
    $stmt->execute([
        $data['nom'],
        $data['prenom'],
        $data['email'],
        $data['id_utilisateur']
    ]);
    
    // Mise à jour du professeur
    $stmt = $pdo->prepare("
        UPDATE professeur SET 
        specialite = ?, grade = ?
        WHERE id_professeur = ?
    ");
    $stmt->execute([
        $data['specialite'],
        $data['grade'],
        $id
    ]);
    
    return $stmt->rowCount() > 0;
}

function UpdateProfesseurClasses($professeurId, $classes) {
    $pdo = connectToDatabase();
    
    // Supprimer les anciennes affectations
    $stmt = $pdo->prepare("DELETE FROM professeur_classe WHERE id_professeur = ?");
    $stmt->execute([$professeurId]);
    
    // Ajouter les nouvelles
    foreach ($classes as $classeId) {
        affecterProfesseurClasse($professeurId, $classeId);
    }
    
    return true;
}

//==========================fonction qui permet de recuperer les classes d'un professeur===========================
function getClassesByProfesseurId($professeur_id) {
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("
                SELECT c.libelle 
                FROM professeur_classe pc
                JOIN classe c ON pc.id_classe = c.id_classe
                WHERE pc.id_professeur = ?
            ");
            $stmt->execute([$professeur_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des classes: " . $e->getMessage());
            return [];
        }
    }
    return [];
}

//=======================================fonction qui permet de Compter le nombre total de cours pour la pagination==============================
function CountProfesseurs($id_professeur = null, $nom = null, $prenom = null, $specialite=null) {
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $query = "
                SELECT COUNT(*) as total 
                FROM professeur p 
                WHERE 1 = 1
            ";

            $params = [];

            if (!empty($id_professeur)) {
                $query .= " AND c.id_professeur = :id_professeur";
                $params[':id_professeur'] = $id_professeur;
            }

            if (!empty($nom)) {
                $params[':nom'] = $nom;
            }

            if (!empty($prenom)) {
                $params[':prenom'] = $prenom;
            }
            if (!empty($specialite)) {
                $params[':specialite'] = $specialite;
            }

            $stmt = $pdo->prepare($query);

            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }

            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'] ?? 0;
        } catch (PDOException $e) {
            error_log("Erreur lors du comptage des cours : " . $e->getMessage());
            return 0;
        }
    }
    return 0;
}


