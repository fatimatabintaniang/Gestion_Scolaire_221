<?php
require_once "../model/listeAbsence.model.php";
if (isset($_REQUEST["page"]) && $_REQUEST["page"] == "listeAbsence") {
    $absences= FindAllAbsences($_SESSION['utilisateur']['id_etudiant']);
        // dd($_SESSION['utilisateur']);

    RenderView("absence/listeAbsence", ['absences' => $absences], "listeAbsence.layout");
}

