<?php
require_once "../model/inscription.model.php";
if (isset($_REQUEST["page"]) && $_REQUEST["page"] == "listeInscription") {
    $inscriptions= FindAllInscriptions();
    RenderView("inscription/listeInscription", ['inscriptions' => $inscriptions], "inscription.layout");
}

