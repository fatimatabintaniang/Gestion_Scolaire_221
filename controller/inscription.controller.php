<?php
require_once "../model/inscription.model.php";

if (isset($_REQUEST["page"]) && $_REQUEST["page"] == "listeInscription") {
    $inscriptions = FindAllInscriptions();
    
    // Récupérer les classes pour le formulaire
    $classes = FindAllClasses(); // Vous devez créer cette fonction si elle n'existe pas
    
    // Récupérer les erreurs et données du formulaire s'ils existent
    $errors = $_SESSION['errors'] ?? [];
    $formData = $_SESSION['formData'] ?? [];
    unset($_SESSION['errors']);
    unset($_SESSION['formData']);
    
    RenderView("inscription/listeInscription", [
        'inscriptions' => $inscriptions,
        'classes' => $classes,
        'errors' => $errors,
        'formData' => $formData
    ], "inscription.layout");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'add_inscription') {
    handleAjouter();
}

function handleAjouter() {
    $errors = [];
    $formData = $_POST;
    
    // Validation des champs
    $requiredFields = ['nom', 'prenom', 'email', 'matricule', 'adresse', 'classe'];
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = "Ce champ est requis";
        }
    }
    
    // Validation email
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email invalide";
    }
    
    if (empty($errors)) {
        $data = [
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'email' => $_POST['email'],
            'matricule' => $_POST['matricule'],
            'adresse' => $_POST['adresse'],
            'classe' => $_POST['classe']
        ];
        
        if (AddInscription($data)) {
            header("Location: ?controler=inscription&page=listeInscription");
            exit();
        } else {
            $errors['general'] = "Erreur lors de l'ajout de l'inscription";
        }
    }
    
    $_SESSION['formData'] = $formData;
    $_SESSION['errors'] = $errors;
    header("Location: ?controler=inscription&page=listeInscription&show_add_modal=1");
    exit();
}

// Fonction pour récupérer toutes les classes (à ajouter dans votre modèle)
function FindAllClasses() {
    $pdo = connectToDatabase();
    if ($pdo) {
        try {
            $stmt = $pdo->query("SELECT id_classe, libelle FROM classe");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erreur lors de la récupération des classes : " . $e->getMessage());
            return [];
        }
    }
    return [];
}