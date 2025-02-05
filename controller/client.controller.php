<?php
$clients = FindAllClient();

if (isset($_GET['telephone'])) {
    $clients = FindClientByTel($_GET['telephone']) ;
   
}
require_once "../views/clients/listeClients.html.php";

