<?php
require_once "../model/classe.model.php";
if (isset($_REQUEST["page"]) && $_REQUEST["page"] == "listeClasse") {
    $classes= FindAllClasse();
    RenderView("classe/listeClasse", ['classes' => $classes], "classe.layout");
}

