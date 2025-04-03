<?php
require_once "../model/justification.model.php";
if (isset($_REQUEST["page"]) && $_REQUEST["page"] == "listeJustification") {
    $justifications= FindAllJustifications();
    RenderView("justification/listeJustification", ['justifications' => $justifications], "justification.layout");
}

