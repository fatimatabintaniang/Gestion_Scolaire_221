<?php

require_once "../model/dashboard.model.php"; // Vérifie le nom du fichier
if (isset($_REQUEST["page"])) {
    $page = $_REQUEST["page"];

    if ($page == "dashboard") {
        $stats = getDashboardStats(); // Récupère les statistiques
        RenderView("dashboard/dashboard", ["stats" => $stats], "dashboard.layout"); // Passe les stats à la vue
        exit;
    }
}
