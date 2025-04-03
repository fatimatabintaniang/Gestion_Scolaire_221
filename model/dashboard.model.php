<?php
function getDashboardStats() {
    $db = connectToDatabase();

    $stats = [];

    // Nombre total d’étudiants
    $query = $db->query("SELECT COUNT(*) as total FROM etudiant");
    $stats["total_etudiant"] = $query->fetch()["total"];

    // Nombre total de classes
    $query = $db->query("SELECT COUNT(*) as total FROM classe");
    $stats["total_classe"] = $query->fetch()["total"];

    // Nombre total de professeurs
    $query = $db->query("SELECT COUNT(*) as total FROM professeur");
    $stats["total_professeur"] = $query->fetch()["total"];

    return $stats;
}
?>
