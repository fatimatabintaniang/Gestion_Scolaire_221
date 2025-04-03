<?php
require_once "../model/coursEtudiant.model.php";
if (isset($_REQUEST["page"]) && $_REQUEST["page"] == "coursEtudiant") {
    $coursEtudiants= FindAllCoursEtudiant();

    RenderView("coursEtudiant/coursEtudiant", ['coursEtudiants' => $coursEtudiants], "coursEtudiant.layout");
}

