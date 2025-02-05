<?php
require_once "data.php";
function FindAllClient(): array
{
   return $GLOBALS["clients"];
}

function FindClientByTel($telephone)
{
   $clients = FindAllClient();
   foreach ($clients as  $client) {
      if ($client["telephone"] == $telephone) {
         return [$client];
        
      }
   }
   return $clients;
}
function FindClientById($id)
{
   $clients = FindAllClient();
   foreach ($clients as $client) {
      if ($client["id"] == $id) {
         return $client;
      }
   }
   return null;
}

   function FindAllCommandes(): array
{
    $clients = FindAllClient();
    $allCommandes = [];

    foreach ($clients as $client) {
        foreach ($client['commandes'] as $commande) {
            $allCommandes[] = $commande;
        }
    }
    return $allCommandes;
}

function FindClientWithOrdersByTel($telephone) {
   $clients = FindAllClient();
   foreach ($clients as $client) {
       if ($client["telephone"] == $telephone) {
           return $client; // Retourne le client avec ses commandes
       }
   }
   return null; // Retourne null si aucun client trouvé
}
function isEmpty($name,&$errors){
   if (empty($_POST[$name])) {
      $errors[$name] =ucfirst($name). " est obligatoire.";
  }
}

function FindCommandeById($id) {
   $clients = FindAllClient();
   foreach ($clients as $client) {
       foreach ($client['commandes'] as $commande) {
           if ($commande['id'] == $id) {
               return $commande;
           }
       }
   }
   return null;
}

function FindProduitsByCommandeId($commandeId) {
   $clients = FindAllClient();
   foreach ($clients as $client) {
       foreach ($client['commandes'] as $commande) {
           if ($commande['id'] == $commandeId) {
               return $client['produit']; // Retourne les produits du client qui a passé cette commande
           }
       }
   }
   return [];
}



