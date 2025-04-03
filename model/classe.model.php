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
 