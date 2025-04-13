<?php
require_once "../model/coursProfesseur.model.php";
if (isset($_REQUEST["page"]) && $_REQUEST["page"] == "coursProfesseur") {
    $coursProfesseurs= FindAllcoursProfesseur($_SESSION['utilisateur']['id_professeur']);

    RenderView("coursProfesseur/coursProfesseur", ['coursProfesseurs' => $coursProfesseurs], "coursProfesseur.layout");
}
