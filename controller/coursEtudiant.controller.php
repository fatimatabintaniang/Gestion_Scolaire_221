<?php
require_once "../model/coursEtudiant.model.php";
if (isset($_REQUEST["page"]) && $_REQUEST["page"] == "coursEtudiant") {
    $search = isset($_GET['search']) ? trim($_GET['search']) : null;
    $coursEtudiants = FindAllCoursEtudiant($_SESSION['utilisateur']['id_etudiant'], $search);
    
    RenderView("coursEtudiant/coursEtudiant", [
        'coursEtudiants' => $coursEtudiants,
        'currentSearch' => $search // On envoie bien la valeur de recherche à la vue
    ], "coursEtudiant.layout");
}