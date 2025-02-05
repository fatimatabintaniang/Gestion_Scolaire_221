<?php
if (isset($_REQUEST["page"])) {
    $page = $_REQUEST["page"];
    
    // Cas où on affiche la liste des commandes ou les commandes d'un client
    if ($page == 'Commandes' || $page == 'commande' || $page == 'commandeClient') {
        $verif = true;
        $commandes = FindAllCommandes();

        // Recherche par téléphone
        if (isset($_GET['telephone'])) {
            $client = FindClientWithOrdersByTel($_GET['telephone']);
            if ($client) {
                $commandes = $client['commandes'];
            }
        } 
        // Recherche par ID de client
        elseif (isset($_GET["id"])) {
            $client = FindClientById($_GET['id']);
            $verif = false;
            if ($client) {
                $commandes = $client['commandes'];
            }
        }

        require_once "../views/commandes/listeCommande.html.php";
    } 
   
    elseif ($page == 'detail' && isset($_GET['id'])) {
        $commandeId = $_GET['id'];
        $commandeDetail = FindCommandeById($commandeId);

        
        if ($commandeDetail) {
            $produits = FindProduitsByCommandeId($commandeId);

            require_once "../views/commandes/detailCommande.html.php";
        } else {
            echo "Commande non trouvée.";
        }
        exit; // Stoppe l'exécution pour éviter de charger d'autres pages
    }
    // Gestion de l'ajout d'une commande
    elseif ($page == 'ajout') {
        $client = null; // Initialiser la variable client
        
        if (isset($_GET['telephone'])) {
            $client = FindClientWithOrdersByTel($_GET['telephone']); // Trouver le client
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validation des champs
            $errors = [];
            isEmpty("article", $errors);
            isEmpty("prix_unitaire", $errors);
            isEmpty("quantite", $errors);
            
            if (empty($errors)) {
                $commande = [
                    'article' => $_POST['article'],
                    'prix_unitaire' => $_POST['prix_unitaire'],
                    'quantite' => $_POST['quantite'],
                    'client_id' => $client ? $client['id'] : null
                ];
            }
        }
        
        require_once "../views/commandes/form.commande.html.php";
    }
    
}
?>
