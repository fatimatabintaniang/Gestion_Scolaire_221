<?php
require_once "../model/professeur.model.php";
if (isset($_REQUEST["page"]) && $_REQUEST["page"] == "listeProfesseur") {
    $professeurs= FindAllProfesseur();
    RenderView("professeur/listeProfesseur", ['professeurs' => $professeurs], "professeur.layout");
}

