<?php
require_once "../model/professeur.model.php";
require_once "../model/classe.model.php";
require_once "../model/utilisateur.model.php";

function handleListeProfesseur()
{
    try {
        // Récupération et nettoyage du terme de recherche
        $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
        $currentPage = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
        $perPage = 5; // Nombre d'éléments par page
        
        $result = FindAllProfesseur($searchTerm, $currentPage, $perPage);
        
        $data = [
            'professeurs' => $result['professeurs'],
            'allClasses' => FindAllClasse(),
            'errors' => $_SESSION['errors'] ?? [],
            'formData' => $_SESSION['formData'] ?? [],
            'successMessage' => $_SESSION['message'] ?? null,
            'currentSearch' => $searchTerm,
            'totalProfesseur' => $result['total'],
            'currentPage' => $result['currentPage'],
            'perPage' => $result['perPage']
        ];

        // Gestion de l'édition (reste inchangé)
        if (isset($_GET['edit_id'])) {
            $professeur = FindProfesseurById($_GET['edit_id']);
            if ($professeur) {
                $data['formData'] = array_merge($professeur, [
                    'classes' => FindClassesByProfesseur($_GET['edit_id'])
                ]);
                $data['isEditMode'] = true;
                $data['editId'] = $_GET['edit_id'];
            }
        }

        unset($_SESSION['errors'], $_SESSION['formData'], $_SESSION['message']);

        RenderView("professeur/listeProfesseur", $data, "professeur.layout");
        
    } catch (Exception $e) {
        error_log("[ERREUR] " . $e->getMessage());
        $_SESSION['error'] = "Erreur lors du chargement des données";
        header("Location: ?controler=professeur&page=listeProfesseur");
        exit();
    }
}

function handleAddProfesseur()
{
    if ($_SERVER["REQUEST_METHOD"] != "POST") return;

    try {
        $errors = validateProfesseurData($_POST);

        if (!empty($errors)) {
            storeFormDataAndRedirect($errors, $_POST);
        }

        $userId = createUser($_POST);
        $professeurId = createProfesseur($userId, $_POST);
        assignClassesToProfessor($professeurId, $_POST['classes']);

        setSuccessMessageAndRedirect("Professeur ajouté avec succès! ID: $professeurId");
    } catch (Exception $e) {
        handleProfessorException($e, $_POST);
    }
}

function validateProfesseurData($postData, $isEditMode = false)
{
    $errors = [];
    $requiredFields = [
        'nom' => "Nom obligatoire",
        'prenom' => "Prénom obligatoire",
        'email' => "Email obligatoire",
        'specialite' => "Spécialité obligatoire",
        'grade' => "Grade obligatoire",
        'classes' => "Au moins une classe requise"
    ];

    // En mode édition, le mot de passe n'est pas obligatoire
    if (!$isEditMode) {
        $requiredFields['password'] = "Mot de passe obligatoire";
    }

    foreach ($requiredFields as $field => $message) {
        if (empty($postData[$field])) {
            $errors[$field] = $message;
        }
    }

    return $errors;
}
function createUser($data)
{
    return AddUser([
        'nom' => $data['nom'],
        'prenom' => $data['prenom'],
        'email' => $data['email'],
        'password' => $data['password'],
        'id_role' => 3 // ID du rôle professeur
    ]);
}

function createProfesseur($userId, $data)
{
    return AddProfesseur([
        'id_utilisateur' => $userId,
        'specialite' => $data['specialite'],
        'grade' => $data['grade']
    ]);
}

function assignClassesToProfessor($professeurId, $classes)
{
    foreach ($classes as $classeId) {
        if (!affecterProfesseurClasse($professeurId, $classeId)) {
            throw new Exception("Échec affectation classe $classeId");
        }
    }
}

function storeFormDataAndRedirect($errors, $formData)
{
    $_SESSION['errors'] = $errors;
    $_SESSION['formData'] = $formData;
    redirectToListWithModal();
}

function setSuccessMessageAndRedirect($message)
{
    $_SESSION['message'] = $message;
    redirectToList();
}

function handleProfessorException($e, $postData)
{
    error_log("Erreur ajout professeur: " . $e->getMessage());
    $_SESSION['errors'] = ['general' => "Erreur lors de l'ajout: " . $e->getMessage()];
    $_SESSION['formData'] = $postData;
    redirectToListWithModal();
}

function redirectToList()
{
    header("Location: ?controler=professeur&page=listeProfesseur");
    exit();
}

function redirectToListWithModal()
{
    header("Location: ?controler=professeur&page=listeProfesseur&show_add_modal=1");
    exit();
}

function redirectToErrorPage()
{
    die("Une erreur s'est produite. Veuillez réessayer plus tard.");
    // Ou mieux : afficher une vue d'erreur intégrée
    // RenderView("erreur/500", [], "layout.base");
}
function handleModifyProfesseur()
{
    if (!isset($_GET['id'])) {
        redirectToList();
        return;
    }

    $professeurId = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        handleUpdateProfesseur($professeurId);
        return;
    }

    // Redirigez vers la liste avec les paramètres d'édition
    $_SESSION['formData'] = array_merge(
        FindProfesseurById($professeurId),
        ['classes' => FindClassesByProfesseur($professeurId)]
    );
    header("Location: ?controler=professeur&page=listeProfesseur&show_edit_modal=1&edit_id=" . $professeurId);
    exit();
}
function handleUpdateProfesseur($professeurId)
{
    try {
        $errors = validateProfesseurData($_POST, true); // true pour mode édition

        if (!empty($errors)) {
            storeFormDataAndRedirect($errors, $_POST);
        }

        $professeur = FindProfesseurById($professeurId);
        if (!$professeur) {
            throw new Exception("Professeur non trouvé");
        }

        // Mise à jour des données
        $updateData = [
            'id_utilisateur' => $professeur['id_utilisateur'],
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'email' => $_POST['email'],
            'specialite' => $_POST['specialite'],
            'grade' => $_POST['grade']
        ];

        if (!empty($_POST['password'])) {
            $updateData['password'] = $_POST['password'];
        }

        UpdateProfesseur($professeurId, $updateData);
        UpdateProfesseurClasses($professeurId, $_POST['classes'] ?? []);

        setSuccessMessageAndRedirect("Professeur mis à jour avec succès!");
    } catch (Exception $e) {
        handleProfessorException($e, $_POST);
    }
}
function showEditForm($professeurId)
{
    $professeur = FindProfesseurById($professeurId);
    if (!$professeur) {
        redirectToList();
        return;
    }

    $classes = FindClassesByProfesseur($professeurId);

    $data = [
        'professeurs' => FindAllProfesseur(),
        'allClasses' => FindAllClasse(),
        'formData' => array_merge($professeur, ['classes' => $classes]),
        'isEditMode' => true,
        'editId' => $professeurId
    ];

    RenderView("professeur/listeProfesseur", $data, "professeur.layout");
}

// ============================= Fonction pour afficher les classes associées==========================
function handleVoirClasses()
{
    $professeur_id = $_GET['professeur_id'] ?? null;

    if (!$professeur_id) {
        header("Location: ?controler=professeur&page=listeprofesseur");
        exit();
    }

    $classes = getClassesByProfesseurId($professeur_id);
    $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
    $currentPage = isset($_GET['page_num']) ? (int)$_GET['page_num'] : 1;
    $perPage = 5;

    // On récupère les professeurs avec pagination pour maintenir l'état de la liste
    $professeursData = FindAllProfesseur($searchTerm, $currentPage, $perPage);

    RenderView("professeur/listeprofesseur", [
        'professeurs' => $professeursData['professeurs'],
        'allClasses' => FindAllClasse(),
        'showClassesModal' => true,
        'classesForModal' => $classes,
        'currentSearch' => $searchTerm,
        'totalProfesseur' => $professeursData['total'],
        'currentPage' => $currentPage,
        'perPage' => $perPage,
        'currentProfesseurId' => $professeur_id
    ], "professeur.layout");
    exit();
}


// Routeur principal
if (isset($_REQUEST["page"])) {
    switch ($_REQUEST["page"]) {
        case "listeProfesseur":
            handleListeProfesseur();
            break;
        case "ajouter":
            handleAddProfesseur();
            break;
        case "modifier":
            handleModifyProfesseur();
            break;

        case 'voirClasses':
            handleVoirClasses();
            break;
    }
}
