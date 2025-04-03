<?php
require_once "../model/coursProfesseur.model.php";
if (isset($_REQUEST["page"]) && $_REQUEST["page"] == "coursProfesseur") {
    $coursProfesseurs= FindAllcoursProfesseur();

    RenderView("coursProfesseur/coursProfesseur", ['coursProfesseurs' => $coursProfesseurs], "coursProfesseur.layout");
}

