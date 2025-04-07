<?php
function AddUser($data) {
    $pdo = connectToDatabase();
    
    $stmt = $pdo->prepare("
        INSERT INTO utilisateur 
        (nom, prenom, email, mot_de_passe, id_role) 
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $data['nom'],
        $data['prenom'],
        $data['email'],
        $data['password'],
        $data['id_role']
    ]);
    return $pdo->lastInsertId();
}