<?php
$clients=[
[
    "id"=>1,
    "nom"=>"Niang",
    "prenom"=>"Fatima",
    "telephone"=>77,
    "commandes" => [
            ["id" => 1,"date" => "2024-01-20","montant" => "2500","statut" => "paye"],
            ["id" => 2,"date" => "2024-01-21","montant" => "2700","statut" => "impaye"]
    ],
    "produits" => [
        ["id" => 1,"article" => "iphone 6s","reference" => "652GSJ_1","prix_unitaire" => "30","quantite" => "2","montant" => "60"],
        ["id" => 2,"article" => "iphone 7","reference" => "UWEQII_1","prix_unitaire" => "60","quantite" => "2","montant" => "120"],
        ]
],

[
    "id"=>2,
    "nom"=>"Diop",
    "prenom"=>"Astou",
    "telephone"=>78,
    "commandes" => [
            [ "id" => 3,"date" => "2024-01-25","montant" => "2900","statut" => "paye"]
    ],
        "produits" => [
        ["id" => 3,"article" => "Xr","reference" => "ASDFGH_2","prix_unitaire" => "10","quantite" => "5","montant" => "50"],
        ["id" => 4,"article" => "11pro","reference" => "QWERTY_2","prix_unitaire" => "11","quantite" => "3","montant" => "33"],
            ]
],

[
    "id"=>3,
    "nom"=>"Ndiaye",
    "prenom"=>"Mansour",
    "telephone"=>75,
    "commandes" => [],
    "produit" => []
] 

];