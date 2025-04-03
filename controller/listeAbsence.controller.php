<?php
require_once "../model/listeAbsence.model.php";
if (isset($_REQUEST["page"]) && $_REQUEST["page"] == "listeAbsence") {
    $absences= FindAllAbsences();
    RenderView("absence/listeAbsence", ['absences' => $absences], "listeAbsence.layout");
}

