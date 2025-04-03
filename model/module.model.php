<?php
function FindAllModules() {
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $stmt = $pdo->query("SELECT id_module, libelle FROM module");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur : " . $e->getMessage());
            return [];
        }
    }
    return [];
}