<?php
require_once "../model/cours.model.php";
require_once "../model/professeur.model.php";
require_once "../model/module.model.php";
require_once "../model/classe.model.php";

if (!isset($_REQUEST["page"])) {
    header("Location: ?controler=cours&page=listeCours");
    exit();
}

$page = $_REQUEST["page"];

switch ($page) {
    case 'listeCours':
        handleListeCours();
        break;
    
    case 'ajouter':
        handleAjouter();
        break;
    
    case 'voirClasses':
        handleVoirClasses();
        break;
    
    case 'confirmAnnuler':
        handleConfirmAnnuler();
        break;
    
    case 'annuler':
        handleAnnuler();
        break;
    
    case 'prepareModifierCours':
        handlePrepareModifier();
        break;
    
    case 'modifierCours':
        handleModifierCours();
        break;
    
    default:
        header("Location: ?controler=cours&page=listeCours");
        exit();
}

// ===================================Fonctions pour chaque cas=============================================

//Gère l'affichage principal

function handleListeCours() {
    $id_professeur = $_GET['professeur_filtre'] ?? null;
    $date_debut = $_GET['date_debut'] ?? null;
    $date_fin = $_GET['date_fin'] ?? null;
    
    // Pagination
    $currentPage = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
    $perPage = 5;
    
    $cours = FindAllCours($id_professeur, $date_debut, $date_fin, $currentPage, $perPage);
    $totalCours = CountCours($id_professeur, $date_debut, $date_fin);
    $totalPages = ceil($totalCours / $perPage);

    $professeurs = FindAllProfesseur();
    $modules = FindAllModules();

    $formData = $_SESSION['formData'] ?? [];
    $errors = $_SESSION['errors'] ?? [];
    unset($_SESSION['formData'], $_SESSION['errors']);

    RenderView("cours/listeCours", [
        'cours' => $cours,
        'professeurs' => $professeurs,
        'allClasses' => FindAllClasse(),
        'modules' => $modules,
        'formData' => $formData,
        'errors' => $errors,
        'currentPage' => $currentPage,
        'totalPages' => $totalPages,
        'totalCours' => $totalCours,
        

    ], "cours.layout");
}

// Gère l'ajout de cours
function handleAjouter() {
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: ?controler=cours&page=listeCours");
        exit();
    }

    $errors = [];
    $requiredFields = ['date', 'heure_debut', 'heure_fin', 'nombre_heures', 'semestre', 'professeur', 'module'];

    foreach ($requiredFields as $field) {
        isEmpty($field, $errors);
    }
    

    // Validation des heures (comme dans votre code original)
    if (empty($errors['heure_debut'])) {
        if (!preg_match('/^([0-1][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$/', $_POST['heure_debut'])) {
            $errors['heure_debut'] = "Format d'heure invalide (HH:MM ou HH:MM:SS)";
        }
    }
    
    if (empty($errors['heure_fin'])) {
        if (!preg_match('/^([0-1][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?$/', $_POST['heure_fin'])) {
            $errors['heure_fin'] = "Format d'heure invalide (HH:MM ou HH:MM:SS)";
        }
    }
    if (empty($errors['nombre_heures'])) {
        if (!is_numeric($_POST['nombre_heures']) || $_POST['nombre_heures'] <= 0) {
            $errors['nombre_heures'] = "Le nombre d'heures doit être un nombre positif";
        }
    }
     
    if (empty($errors['heure_debut']) && empty($errors['heure_fin'])) {
        if (strtotime($_POST['heure_debut']) >= strtotime($_POST['heure_fin'])) {
            $errors['heure_fin'] = "L'heure de fin doit être supérieure à l'heure de début";
        }
    }

if (empty($_POST['classes']) || !is_array($_POST['classes'])) {
    $errors['classes'] = "Veuillez sélectionner au moins une classe";
}


    if (empty($errors)) {
        $data = [
            'date' => $_POST['date'],
            'heure_debut' => $_POST['heure_debut'],
            'heure_fin' => $_POST['heure_fin'],
            'classes'=> $_POST['classes'],
            'nombre_heures' => $_POST['nombre_heures'],
            'semestre' => $_POST['semestre'],
            'professeur' => $_POST['professeur'],
            'module' => $_POST['module']
        ];

        if (AddCours($data)) {
            header("Location: ?controler=cours&page=listeCours");
            exit();
        } else {
            $errors['general'] = "Erreur lors de l'ajout du cours";
        }
    }

    $_SESSION['formData'] = $_POST;
    $_SESSION['errors'] = $errors;
    header("Location: ?controler=cours&page=listeCours");
    exit();
}
// Affiche les classes associées
function handleVoirClasses() {
    $cours_id = $_GET['cours_id'] ?? null;
    
    if (!$cours_id) {
        header("Location: ?controler=cours&page=listeCours");
        exit();
    }

    // Récupérer les données nécessaires
    $classes = getClassesByCoursId($cours_id);
    $coursData = FindAllCours();
    
    // Debug: vérifiez ce qui est récupéré
    error_log("Classes pour cours $cours_id: ".print_r($classes, true));
    
    RenderView("cours/listeCours", [
        'cours' => $coursData,
        'professeurs' => FindAllProfesseur(),
        'modules' => FindAllModules(),
        'showClassesModal' => true,
        'classesForModal' => $classes,
        'currentCoursId' => $cours_id,
        'allClasses' => FindAllClasse() // Ajouté pour référence
    ], "cours.layout");
    exit();
}

// Affiche la confirmation d'annulation
function handleConfirmAnnuler() {
    $cours_id = $_GET['cours_id'] ?? null;
    
    if (!$cours_id) {
        header("Location: ?controler=cours&page=listeCours");
        exit();
    }

    $coursData = FindAllCours();
    $professeurs = FindAllProfesseur();
    $modules = FindAllModules();
    
    RenderView("cours/listeCours", [
        'cours' => $coursData,
        'professeurs' => $professeurs,
        'modules' => $modules,
        'showConfirmAnnuler' => true,
        'coursToAnnuler' => $cours_id
    ], "cours.layout");
    exit();
}

// Exécute l'annulation
function handleAnnuler() {
    $cours_id = $_GET['cours_id'] ?? null;
    
    if (!$cours_id) {
        header("Location: ?controler=cours&page=listeCours");
        exit();
    }

    if (annulerCours($cours_id)) {
        $_SESSION['message'] = "Le cours a été annulé avec succès";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Erreur lors de l'annulation du cours";
        $_SESSION['message_type'] = "error";
    }
    
    header("Location: ?controler=cours&page=listeCours");
    exit();
}

// Prépare la modification
function handlePrepareModifier() {
    $cours_id = $_GET['cours_id'] ?? null;
    
    if (!$cours_id) {
        header("Location: ?controler=cours&page=listeCours");
        exit();
    }

    $coursToEdit = FindOneCours($cours_id);
    
    if (!$coursToEdit) {
        $_SESSION['message'] = "Cours introuvable";
        $_SESSION['message_type'] = "error";
        header("Location: ?controler=cours&page=listeCours");
        exit();
    }

    // Récupérer toutes les classes pour l'affichage
    $allClasses = FindAllClasse();
    
    // Préparer les données pour la vue
    $formData = [
        'date' => $coursToEdit['date'],
        'heure_debut' => $coursToEdit['heure_debut'],
        'heure_fin' => $coursToEdit['heure_fin'],
        'nombre_heures' => $coursToEdit['nombre_heures'],
        'semestre' => $coursToEdit['semestre'],
        'professeur' => $coursToEdit['id_professeur'],
        'module' => $coursToEdit['id_module'],
        'classes' => $coursToEdit['classes'] ?? [] // Classes associées
    ];

    // Autres données nécessaires...
    $id_professeur = $_GET['professeur_filtre'] ?? null;
    $date_debut = $_GET['date_debut'] ?? null;
    $date_fin = $_GET['date_fin'] ?? null;
    $currentPage = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
    $perPage = 5;
    
    $cours = FindAllCours($id_professeur, $date_debut, $date_fin, $currentPage, $perPage);
    $totalCours = CountCours($id_professeur, $date_debut, $date_fin);
    $totalPages = ceil($totalCours / $perPage);

    RenderView("cours/listeCours", [
        'cours' => $cours,
        'professeurs' => FindAllProfesseur(),
        'modules' => FindAllModules(),
        'allClasses' => $allClasses,
        'currentPage' => $currentPage,
        'totalPages' => $totalPages,
        'totalCours' => $totalCours,
        'showEditModal' => true,
        'coursToEdit' => $coursToEdit,
        'formData' => array_merge($formData, $_SESSION['formData'] ?? []),
        'errors' => $_SESSION['errors'] ?? []
    ], "cours.layout");
    
    unset($_SESSION['formData'], $_SESSION['errors']);
    exit();
}
// Exécute la modification
function handleModifierCours() {
    $cours_id = $_GET['cours_id'] ?? null;
    
    if ($_SERVER["REQUEST_METHOD"] != "POST" || !$cours_id) {
        header("Location: ?controller=cours&page=listeCours");
        exit();
    }

    $errors = [];
    $requiredFields = ['date', 'heure_debut', 'heure_fin', 'nombre_heures', 'semestre', 'professeur', 'module'];

    // Validation des champs obligatoires
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = "Ce champ est obligatoire";
        }
    }

    // Validation des classes
    if (empty($_POST['classes']) || !is_array($_POST['classes'])) {
        $errors['classes'] = "Veuillez sélectionner au moins une classe";
    }

    if (empty($errors)) {
        $data = [
            'date' => $_POST['date'],
            'heure_debut' => $_POST['heure_debut'],
            'heure_fin' => $_POST['heure_fin'],
            'nombre_heures' => $_POST['nombre_heures'],
            'semestre' => $_POST['semestre'],
            'professeur' => $_POST['professeur'],
            'module' => $_POST['module'],
            'classes' => $_POST['classes'] // N'oubliez pas les classes
        ];

        if (UpdateCours($cours_id, $data)) {
            $_SESSION['message'] = "Le cours a été modifié avec succès";
            $_SESSION['message_type'] = "success";
            header("Location: ?controler=cours&page=listeCours");
            exit();
        } else {
            $errors['general'] = "Erreur lors de la modification du cours";
        }
    }

    $_SESSION['formData'] = $_POST;
    $_SESSION['errors'] = $errors;
    header("Location: ?controler=cours&page=prepareModifierCours&cours_id=" . $cours_id);
    exit();
}