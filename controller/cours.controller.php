<?php
// require_once "../model/cours.model.php";
// if (isset($_REQUEST["page"]) && $_REQUEST["page"] == "listeCours") {
//     $cours= FindAllCours();
//     RenderView("cours/listeCours", ['cours' => $cours], "cours.layout");
// }

require_once "../model/cours.model.php";
require_once "../model/professeur.model.php";
require_once "../model/module.model.php";

if (isset($_REQUEST["page"]) && $_REQUEST["page"] == "listeCours") {
    $cours = FindAllCours();
    $professeurs = FindAllProfesseur(); // Assurez-vous d'avoir cette fonction
    $modules = FindAllModules(); // Assurez-vous d'avoir cette fonction
    RenderView("cours/listeCours", [
        'cours' => $cours,
        'professeurs' => $professeurs,
        'modules' => $modules
    ], "cours.layout");
}

if (isset($_REQUEST["page"]) && $_REQUEST["page"] == "ajouter") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $data = [
            'date' => $_POST['date'],
            'heure_debut' => $_POST['heure_debut'],
            'heure_fin' => $_POST['heure_fin'],
            'nombre_heures' => $_POST['nombre_heures'],
            'semestre' => $_POST['semestre'],
            'professeur' => $_POST['professeur'],
            'module' => $_POST['module']
        ];
        
        if (AddCours($data)) {
            header("Location: ?controler=cours&page=listeCours&success=1");
            exit();
        } else {
            $error = "Erreur lors de l'ajout du cours";
            $cours = FindAllCours();
            $professeurs = FindAllProfesseur();
            $modules = FindAllModules();
            RenderView("cours/listeCours", [
                'cours' => $cours,
                'professeurs' => $professeurs,
                'modules' => $modules,
                'error' => $error
            ], "cours.layout");
        }
    }
}

