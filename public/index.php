<?php
define("WEBROOB","http://fatima.niang.ecole221.sn:8000");
require_once "../model.php";


if (isset($_GET["controler"])) {
    $controler=$_GET["controler"];
    if ($controler=="client") {
        require_once "../controller/client.controller.php";
        exit;
    }elseif ($controler=="commande") {
        require_once "../controller/commande.controller.php";
        exit;
    }
    
    elseif ($controler=="ajout"){
        require_once "../controller/commande.controller.php";
        exit;
    }
    elseif ($controler=="detail") {
        require_once "../controller/detailCommande.controller.php";
        exit;
    }
}
else {
        require_once "../controller/client.controller.php";
        exit;
    }
