<?php

//==========================fonction qui permet de recuperer la liste des cours et de les filtrer=============================
function FindAllCours($id_professeur = null, $date_debut = null, $date_fin = null, $page = 1, $perPage = 5) {
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            // Requête SQL de base
            $query = "
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
                WHERE 1 = 1
            ";

            $params = [];

            // Ajout des filtres dynamiques
            if (!empty($id_professeur)) {
                $query .= " AND c.id_professeur = :id_professeur";
                $params[':id_professeur'] = $id_professeur;
            }

            if (!empty($date_debut)) {
                $query .= " AND c.date >= :date_debut";
                $params[':date_debut'] = $date_debut;
            }

            if (!empty($date_fin)) {
                $query .= " AND c.date <= :date_fin";
                $params[':date_fin'] = $date_fin;
            }

            $query .= " ORDER BY c.date DESC";
            
            // Ajout de la pagination
            $offset = ($page - 1) * $perPage;
            $query .= " LIMIT :offset, :perPage";
            $params[':offset'] = $offset;
            $params[':perPage'] = $perPage;

            $stmt = $pdo->prepare($query);
            
            // Liaison des paramètres avec leur type
            foreach ($params as $key => $value) {
                $paramType = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
                $stmt->bindValue($key, $value, $paramType);
            }

            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des cours : " . $e->getMessage());
            return [];
        }
    }
    return [];
}

//==========================fonction qui permet d'ajouter les cours =============================
function AddCours($data) {
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("
                INSERT INTO cours 
                (date, heure_debut, heure_fin, nombre_heures, semestre, id_professeur, id_module) 
                VALUES (?, ?, ?, ?, ?, ?, ?)
            ");
            
            return $stmt->execute([
                $data['date'],
                $data['heure_debut'],
                $data['heure_fin'],
                $data['nombre_heures'],
                $data['semestre'],
                $data['professeur'],
                $data['module']
            ]);
            
        } catch (PDOException $e) {
            error_log("Erreur lors de l'ajout du cours : " . $e->getMessage());
            return false;
        }
    }
    return false;
}

//==========================fonction qui permet de recuperer les classes d'un cours===========================
function getClassesByCoursId($cours_id) {
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("
                SELECT c.libelle 
                FROM cours_classe cc
                JOIN classe c ON cc.id_classe = c.id_classe
                WHERE cc.id_cours = ?
            ");
            $stmt->execute([$cours_id]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des classes: " . $e->getMessage());
            return [];
        }
    }
    return [];
}

//=========================fonction qui permet d'annuler un cours==================================
function annulerCours($cours_id) {
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            // Ici vous pouvez soit supprimer soit marquer comme annulé
            // Exemple 1: Suppression pure
            $stmt = $pdo->prepare("DELETE FROM cours WHERE id_cours = ?");
            // Exemple 2: Marquer comme annulé (si vous avez un champ 'annule')
            // $stmt = $pdo->prepare("UPDATE cours SET annule = 1 WHERE id_cours = ?");
            
            return $stmt->execute([$cours_id]);
        } catch (PDOException $e) {
            error_log("Erreur lors de l'annulation du cours: " . $e->getMessage());
            return false;
        }
    }
    return false;
}

//=======================================fonction qui permet de Compter le nombre total de cours pour la pagination==============================
function CountCours($id_professeur = null, $date_debut = null, $date_fin = null) {
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $query = "
                SELECT COUNT(*) as total 
                FROM cours c 
                WHERE 1 = 1
            ";

            $params = [];

            if (!empty($id_professeur)) {
                $query .= " AND c.id_professeur = :id_professeur";
                $params[':id_professeur'] = $id_professeur;
            }

            if (!empty($date_debut)) {
                $query .= " AND c.date >= :date_debut";
                $params[':date_debut'] = $date_debut;
            }

            if (!empty($date_fin)) {
                $query .= " AND c.date <= :date_fin";
                $params[':date_fin'] = $date_fin;
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

//========================================fonction de modification=====================
function UpdateCours($cours_id, $data) {
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("
                UPDATE cours SET
                    date = ?,
                    heure_debut = ?,
                    heure_fin = ?,
                    nombre_heures = ?,
                    semestre = ?,
                    id_professeur = ?,
                    id_module = ?
                WHERE 
                    id_cours = ?
            ");
            
            return $stmt->execute([
                $data['date'],
                $data['heure_debut'],
                $data['heure_fin'],
                $data['nombre_heures'],
                $data['semestre'],
                $data['professeur'],
                $data['module'],
                $cours_id
            ]);
            
        } catch (PDOException $e) {
            error_log("Erreur lors de la mise à jour du cours : " . $e->getMessage());
            return false;
        }
    }
    return false;
}


// fonction pour récupérer les données d'un cours spécifique depuis la base de données=============================
function FindOneCours($cours_id) {
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $stmt = $pdo->prepare("
                SELECT 
                    c.id_cours,
                    c.date,
                    c.heure_debut,
                    c.heure_fin,
                    c.nombre_heures,
                    c.semestre,
                    c.id_professeur,
                    c.id_module,
                    u.prenom AS professeur_prenom,
                    u.nom AS professeur_nom,
                    m.libelle AS module_libelle
                FROM 
                    cours c
                LEFT JOIN 
                    professeur p ON c.id_professeur = p.id_professeur
                LEFT JOIN 
                    utilisateur u ON p.id_utilisateur = u.id_utilisateur
                LEFT JOIN
                    module m ON c.id_module = m.id_module
                WHERE 
                    c.id_cours = ?
            ");
            $stmt->execute([$cours_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération du cours : " . $e->getMessage());
            return null;
        }
    }
    return null;
}


