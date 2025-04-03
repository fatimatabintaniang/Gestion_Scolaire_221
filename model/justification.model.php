<?php
function FindAllJustifications()
{
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $stmt = $pdo->query("SELECT *
                     FROM justification
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
