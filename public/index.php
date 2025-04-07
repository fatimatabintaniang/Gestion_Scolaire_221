<?php
session_start();
define ("WEBROOB","http://fatima.niang.ecole221.sn:8000");
require_once "../model.php";
require_once "../config/helpers.php";
$controllers=[
    "classe"=>"../controller/classe.controller.php",
    "cours"=>"../controller/cours.controller.php",
    "coursEtudiant"=>"../controller/coursEtudiant.controller.php",
    "coursProfesseur"=>"../controller/coursProfesseur.controller.php",
    "absence"=>"../controller/absence.controller.php",
    "listeAbsence"=>"../controller/listeAbsence.controller.php",
    "professeur"=>"../controller/professeur.controller.php",
    "inscription"=>"../controller/inscription.controller.php",
    "justification"=>"../controller/listeJustification.controller.php",
    "login"=>"../controller/login.controller.php",
    "dashboard"=>"../controller/dashboard.controller.php",
    "dashboardatt"=>"../controller/dashboardatt.controller.php"
];


if (isset($_GET["controler"])) {
    $controler=$_GET["controler"];
    if(array_key_exists($controler,$controllers)){
        
        if (isset($_SESSION["utilisateur"])||$controler=="login") {
            require_once $controllers[$controler];
        }
        // elseif ($_GET['controler'] == 'cours' && $_GET['page'] == 'ajouter') {
        //     AddCours($data);
        // }
        else{
            header("Location:".WEBROOB."?controler=login");
        }
        
    }else{
        echo("Controler inexistant");
    }
}else {
        require_once "../controller/login.controller.php";
        exit;
    }
