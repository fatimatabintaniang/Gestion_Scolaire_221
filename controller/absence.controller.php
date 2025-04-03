<?php
require_once "../model/absence.model.php";
if (isset($_REQUEST["page"]) && $_REQUEST["page"] == "absence") {
    $absences= FindAllCours();
    RenderView("absence/absence", ['absences' => $absences], "absence.layout");
}

