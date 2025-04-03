<?php

require_once "../model/dashboardatt.model.php"; // Vérifie le nom du fichier
if (isset($_REQUEST["page"])) {
    $page = $_REQUEST["page"];

    if ($page == "dashboardatt") {
        $stats = getDashboardStats(); // Récupère les statistiques
        RenderView("dashboardatt/dashboardatt", ["stats" => $stats], "dashboardatt.layout"); // Passe les stats à la vue
        exit;
    }
}
