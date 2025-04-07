<?php
require_once "../model/classe.model.php";


// Point d'entrée principal
if (!isset($_REQUEST["page"])) {
    redirectToDefaultPage();
}

handlePageRequest($_REQUEST["page"]);

/**
 * Gère la requête en fonction de la page demandée
 */
function handlePageRequest($page) {
    switch ($page) {
        case 'listeClasse':
            handleListeClasse();
            break;
        
        case 'ajouter':
            handleAjouter();
            break;
            
        default:
            redirectToListeClasse();
    }
}

/**
 * Affiche la liste des classes
 */
function handleListeClasse() {
    $classes = FindAllClasse();
    
    // Récupération des données de session
    $sessionData = getSessionFormData();
    
    RenderView("classe/listeClasse", [
        'classes' => $classes,
        'errors' => $sessionData['errors'],
        'formData' => $sessionData['formData'],
        'showModal' => shouldShowAddModal()
    ], "classe.layout");
}

/**
 * Gère l'ajout d'une nouvelle classe
 */
function handleAjouter() {
    if (!isPostRequest()) {
        redirectToListeClasse();
    }

    $errors = validateClasseForm($_POST);

    if (empty($errors)) {
        if (tryAddClasse($_POST)) {
            redirectToListeClasse();
        }
        $errors['general'] = "Erreur lors de l'ajout de la classe";
    }

    storeFormDataInSession($_POST, $errors);
    redirectToListeClasse(true);
}

/*********************
 * FONCTIONS UTILITAIRES
 *********************/

/**
 * Tente d'ajouter une classe et retourne le résultat
 */
function tryAddClasse($data) {
    return AddClasse([
        'libelle' => $data['libelle'],
        'filiere' => $data['filiere'],
        'niveau' => $data['niveau']
    ]);
}

/**
 * Valide les données du formulaire
 */
function validateClasseForm($data) {
    $errors = [];
    $requiredFields = ['libelle', 'filiere', 'niveau'];

    foreach ($requiredFields as $field) {
        if (empty($data[$field])) {
            $errors[$field] = "Ce champ est obligatoire";
        }
    }

    return $errors;
}

/**
 * Stocke les données du formulaire et les erreurs en session
 */
function storeFormDataInSession($formData, $errors) {
    $_SESSION['formData'] = $formData;
    $_SESSION['errors'] = $errors;
}

/**
 * Récupère les données du formulaire depuis la session
 */
function getSessionFormData() {
    $data = [
        'errors' => $_SESSION['errors'] ?? [],
        'formData' => $_SESSION['formData'] ?? []
    ];
    
    // Nettoyage de la session
    unset($_SESSION['errors']);
    unset($_SESSION['formData']);
    
    return $data;
}

/**
 * Détermine si la modale d'ajout doit être affichée
 */
function shouldShowAddModal() {
    return isset($_GET['show_add_modal']) || 
           (isset($_SESSION['errors']) && !empty($_SESSION['errors']));
}

/**
 * Vérifie si la requête est de type POST
 */
function isPostRequest() {
    return $_SERVER["REQUEST_METHOD"] === "POST";
}

/**
 * Redirige vers la page par défaut
 */
function redirectToDefaultPage() {
    header("Location: ?controler=cours&page=listeCours");
    exit();
}

/**
 * Redirige vers la liste des classes
 */
function redirectToListeClasse($showModal = false) {
    $url = "?controler=classe&page=listeClasse";
    if ($showModal) {
        $url .= "&show_add_modal=1";
    }
    header("Location: $url");
    exit();
}