<?php
session_start();
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
    } elseif ($page == 'detail' && isset($_GET['id'])) {
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
        if (isset($_REQUEST["page"])) {
            $page = $_REQUEST["page"];

            if ($page == 'ajout') {
                $client = null;

                if (isset($_GET['telephone'])) {
                    $client = FindClientWithOrdersByTel($_GET['telephone']);
                    if ($client) {
                        // Vérifier si c'est un nouveau client
                        if (!isset($_SESSION['client']) || $_SESSION['client']['telephone'] !== $_GET['telephone']) {
                            // Nouveau client détecté  Vider le panier
                            $_SESSION['produits'] = [];
                        }

                        // Stocker les infos du client
                        $_SESSION['client'] = [
                            'nom' => $client['nom'],
                            'prenom' => $client['prenom'],
                            'telephone' => $_GET['telephone']
                        ];
                    }else{
                        $client = null;
                        unset($_SESSION['client']);
                    }
                }

                if (!isset($_SESSION['produits'])) {
                    $_SESSION['produits'] = [];
                }

                // Suppression d'un produit
                if (isset($_GET['remove']) && isset($_SESSION['produits'])) {
                    foreach ($_SESSION['produits'] as $key => $produit) {
                        if ($produit['article'] == $_GET['remove']) {
                            unset($_SESSION['produits'][$key]);
                            break;
                        }
                    }
                    $_SESSION['produits'] = array_values($_SESSION['produits']);
                    header("Location: ?controler=commande&page=ajout");
                    exit;
                }

                // Ajout d'un produit
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $errors = [];
                    isEmpty("article", $errors);
                    isEmpty("prix_unitaire", $errors);
                    isEmpty("quantite", $errors);

                    if (empty($errors)) {
                        $article = $_POST['article'];
                        $prix_unitaire = floatval($_POST['prix_unitaire']);
                        $quantite = intval($_POST['quantite']);
                        $montant = $prix_unitaire * $quantite;

                        // Vérifier si le produit existe déjà
                        $produitExistant = false;
                        foreach ($_SESSION['produits'] as &$produit) {
                            if ($produit['article'] === $article) {
                                $produit['quantite'] += $quantite;
                                $produit['montant'] += $montant;
                                $produitExistant = true;
                                break;
                            }
                        }

                        // Si le produit n'existe pas encore, on l'ajoute
                        if (!$produitExistant) {
                            $_SESSION['produits'][] = [
                                'article' => $article,
                                'prix_unitaire' => $prix_unitaire,
                                'quantite' => $quantite,
                                'montant' => $montant
                            ];
                        }
                    }
                }

                // Charger la page avec les produits stockés en session
                $produits = $_SESSION['produits'];
                require_once "../views/commandes/form.commande.html.php";
            }
        }
    }
}
