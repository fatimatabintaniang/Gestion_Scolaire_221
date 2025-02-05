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
    "produit" => [
        ["id" => 1,"nom" => "iphone 6s","reference" => "652GSJ_1","prix" => "60000"],
        ["id" => 2,"nom" => "iphone 7","reference" => "UWEQII_1","prix" => "60000"],
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
        "produit" => [
        ["id" => 3,"nom" => "Xr","reference" => "ASDFGH_2","prix" => "90000"],
        ["id" => 4,"nom" => "11pro","reference" => "QWERTY_2","prix" => "110000"],
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