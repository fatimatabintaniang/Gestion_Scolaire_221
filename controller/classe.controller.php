<?php
require_once "../model/classe.model.php";
if (!isset($_REQUEST["page"])) {
    header("Location: ?controler=classe&page=listeclasse");
    exit();
}

$page = $_REQUEST["page"];

switch ($page) {
    case 'listeClasse':
        handleListeClasse(); 
        break;
    
        case 'ajouter':
            handleAjouter();
            break;

            case 'modifier':
                handleModifier();
                break;
                
            case 'update':
                handleUpdate();
                break;

                case 'voirEtudiants':
                    handleVoirEtudiants();
                    break;

                    case 'archiver':
                        handleArchiver();
                        break;
                        
                    case 'restaurer':
                        handleRestaurer();
                        break;
    
}

function handleListeClasse() {
    if (!isset($_GET['show_add_modal'])) {
        unset($_SESSION['errors']);
        unset($_SESSION['formData']);
    }
    
    $search = trim($_GET['search'] ?? '');
    $showArchived = isset($_GET['show_archived']) && $_GET['show_archived'] == 1;

    $classes = FindAllClasse($search, $showArchived);
    
    // Ajoutez ces lignes pour gérer l'édition
    $editClasse = null;
    $show_edit_modal = false;
    
    if (isset($_GET['page']) && $_GET['page'] === 'modifier' && isset($_GET['id'])) {
        $editClasse = FindClasseById($_GET['id']);
        $show_edit_modal = true;
    }

    // Gestion de la confirmation d'archivage
    $show_archive_modal = isset($_GET['show_archive_modal']) && $_GET['show_archive_modal'] == 1;
    $archiveId = $_GET['archive_id'] ?? null;
    
    RenderView("classe/listeClasse", [
        'classes' => $classes,
        'search' => $search,
        'currentSearch' => $search,
        'editClasse' => $editClasse,
        'show_edit_modal' => $show_edit_modal,
        'showArchiveModal' => $show_archive_modal,
        'archiveId' => $archiveId
    ], "classe.layout");
}
// Gère l'ajout de classe
function handleAjouter() {
    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        header("Location: ?controler=classe&page=listeclasse");
        exit();
    }

    $errors = [];
    if (empty(trim($_POST['libelle']))) {
        $errors['libelle'] = "Le libellé est obligatoire";
    }
    
    if (empty(trim($_POST['filiere']))) {
        $errors['filiere'] = "La filière est obligatoire";
    }
    
    if (empty(trim($_POST['niveau']))) {
        $errors['niveau'] = "Le niveau est obligatoire";
    }


    if (empty($errors)) {
        $data = [
            'libelle' => $_POST['libelle'],
            'filiere' => $_POST['filiere'],
            'niveau' => $_POST['niveau']
        ];

        if (AddClasse($data)) {
            unset($_SESSION['formData']);
            unset($_SESSION['errors']);
            header("Location: ?controler=classe&page=listeClasse");
            exit();
        } else {
            $errors['general'] = "Erreur lors de l'ajout de la classe";
        }
    }

    $_SESSION['formData'] = $_POST;
    $_SESSION['errors'] = $errors;
    header("Location: ?controler=classe&page=listeClasse&show_add_modal=1");
    exit();
}

function handleModifier() {
    if (!isset($_GET['id'])) {
        header("Location: ?controler=classe&page=listeClasse");
        exit();
    }

    $id = $_GET['id'];
    $classe = FindClasseById($id);

    if (!$classe) {
        header("Location: ?controler=classe&page=listeClasse");
        exit();
    }

    RenderView("classe/listeClasse", [
        'classes' => FindAllClasse(),
        'editClasse' => $classe,
        'show_edit_modal' => true
    ], "classe.layout");
}

function handleUpdate() {
    if ($_SERVER["REQUEST_METHOD"] != "POST" || !isset($_POST['id'])) {
        header("Location: ?controler=classe&page=listeClasse");
        exit();
    }

    $errors = [];
    if (empty(trim($_POST['libelle']))) {
        $errors['libelle'] = "Le libellé est obligatoire";
    }
    
    if (empty(trim($_POST['filiere']))) {
        $errors['filiere'] = "La filière est obligatoire";
    }
    
    if (empty(trim($_POST['niveau']))) {
        $errors['niveau'] = "Le niveau est obligatoire";
    }

    if (empty($errors)) {
        $data = [
            'libelle' => $_POST['libelle'],
            'filiere' => $_POST['filiere'],
            'niveau' => $_POST['niveau']
        ];

        if (UpdateClasse($_POST['id'], $data)) {
            unset($_SESSION['formData']);
            unset($_SESSION['errors']);
            header("Location: ?controler=classe&page=listeClasse");
            exit();
        } else {
            $errors['general'] = "Erreur lors de la modification de la classe";
        }
    }

    $_SESSION['formData'] = $_POST;
    $_SESSION['errors'] = $errors;
    header("Location: ?controler=classe&page=modifier&id=".$_POST['id']);
    exit();
}

function handleVoirEtudiants() {
    if (!isset($_GET['id_classe'])) {
        header("Location: ?controler=classe&page=listeClasse");
        exit();
    }

    $id_classe = $_GET['id_classe'];
    $etudiants = getEtudiantsByClasse($id_classe);
    $classe = FindClasseById($id_classe);

    RenderView("classe/voirEtudiants", [
        'etudiants' => $etudiants,
        'classe' => $classe
    ], "classe.layout");
}

function handleArchiver() {
    if (!isset($_GET['id'])) {
        $_SESSION['error'] = "ID classe manquant";
        header("Location: ?controler=classe&page=listeClasse");
        exit();
    }

    // Si confirmation, on procède à l'archivage
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        if (archiverClasse($_GET['id'])) {
            $_SESSION['success'] = "Classe archivée avec succès";
        } else {
            $_SESSION['error'] = "Erreur lors de l'archivage";
        }
        header("Location: ?controler=classe&page=listeClasse");
        exit();
    }

    // Sinon, on affiche la liste avec le modal
    header("Location: ?controler=classe&page=listeClasse&show_archive_modal=1&archive_id=".$_GET['id']);
    exit();
}
function handleRestaurer() {
    if (!isset($_GET['id'])) {
        $_SESSION['error'] = "ID classe manquant";
        header("Location: ?controler=classe&page=listeClasse");
        exit();
    }

    if (restaurerClasse($_GET['id'])) {
        $_SESSION['success'] = "Classe restaurée avec succès";
    } else {
        $_SESSION['error'] = "Erreur lors de la restauration";
    }

    header("Location: ?controler=classe&page=listeClasse");
    exit();
}