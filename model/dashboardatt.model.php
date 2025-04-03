<?php
function getDashboardStats() {
    $db = connectToDatabase();

    $stats = [];

    $query = $db->query("SELECT COUNT(*) as total FROM inscription");
    $stats["total_inscription"] = $query->fetch()["total"];

    $query = $db->query("SELECT COUNT(*) as total FROM classe");
    $stats["total_classe"] = $query->fetch()["total"];

    $query = $db->query("SELECT COUNT(*) as total FROM etudiant");
    $stats["total_etudiant"] = $query->fetch()["total"];

    return $stats;
}
?>
