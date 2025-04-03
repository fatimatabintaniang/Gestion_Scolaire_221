<?php
require_once "../model/login.model.php";


if (isset($_REQUEST["page"])) {
    $page = $_REQUEST["page"];

    if ($page == "login") {
        if ($_SERVER["REQUEST_METHOD"] === "GET") {
            RenderView("security/login", [], "security.layout");
        } elseif ($_SERVER["REQUEST_METHOD"] === "POST") {
            $errors = [];
            $email = trim($_POST["email"] ?? '');
            $password = trim($_POST["password"] ?? '');

            if (empty($email)) {
                $errors["email"] = "L'email est obligatoire.";
            }
            if (empty($password)) {
                $errors["password"] = "Le mot de passe est obligatoire.";
            }
            if (empty($errors)) {

                $user = findUserConnect($email, $password);

                if ($user) {
                    $_SESSION["utilisateur"] = $user; // Stocke l'utilisateur dans la session
                    switch ($user['role']) {
                        case 'RP':
                            header("Location: " . WEBROOB . "?controler=dashboard&page=dashboard");
                            break;
                        case 'Professeur':
                            header("Location: " . WEBROOB . "?controler=coursProfesseur&page=coursProfesseur");
                            break;
                        case 'Attaché':
                            header("Location: " . WEBROOB . "?controler=dashboardatt&page=dashboardatt");
                            break;
                        case 'Étudiant':
                            header("Location: " . WEBROOB . "?controler=coursEtudiant&page=coursEtudiant");
                            break;
                        default:
                            header("Location: " . WEBROOB . "?controler=dashboard&page=dashboard");
                            break;
                    }
                } else {
                    $errors["email"] = "Email ou mot de passe incorrect.";
                }
            }
            RenderView("security/login", ["errors" => $errors], "security.layout");
            exit;
        }
    } elseif ($page == "deconnexion") {
        session_unset();
        session_destroy();
        header("Location:?controler=login&page=login");
        exit;
    }
}
RenderView("security/login", [], "security.layout");
