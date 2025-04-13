<?php
// traitement_justification.php
require_once "../model/listeAbsence.model.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valider les données
    $date = $_POST['date'] ?? null;
    $heureDebut = $_POST['heure_debut'] ?? null;
    $heureFin = $_POST['heure_fin'] ?? null;
    $motif = $_POST['motif'] ?? null;
    $idEtudiant = $_SESSION['utilisateur']['id_etudiant'] ?? null;

    if ($date && $heureDebut && $heureFin && $motif && $idEtudiant) {
        // Convertir la date du format français (d/m/Y) au format MySQL (Y-m-d)
        $dateParts = explode('/', $date);
        if (count($dateParts) === 3) {
            $mysqlDate = $dateParts[2] . '-' . $dateParts[1] . '-' . $dateParts[0];
        }

        $pdo = connectToDatabase();
        if ($pdo) {
            try {
                // Trouver l'ID de l'absence
                $stmt = $pdo->prepare("
                    SELECT a.id_absence 
                    FROM absence a
                    JOIN cours c ON a.id_cours = c.id_cours
                    WHERE a.id_etudiant = :id_etudiant
                    AND a.date = :date
                    AND c.heure_debut = :heure_debut
                    AND c.heure_fin = :heure_fin
                ");
                
                $stmt->execute([
                    'id_etudiant' => $idEtudiant,
                    'date' => $mysqlDate,
                    'heure_debut' => date('H:i:s', strtotime($heureDebut)),
                    'heure_fin' => date('H:i:s', strtotime($heureFin))
                ]);
                
                $absence = $stmt->fetch(PDO::FETCH_ASSOC);
                
                if ($absence) {
                    // Mettre à jour l'absence
                    $updateStmt = $pdo->prepare("
                        UPDATE absence 
                        SET motif = :motif, 
                            statut = 'justifiee',
                            date_justification = NOW()
                        WHERE id_absence = :id_absence
                    ");
                    
                    $updateStmt->execute([
                        'motif' => $motif,
                        'id_absence' => $absence['id_absence']
                    ]);
                    
                    $_SESSION['message'] = [
                        'type' => 'success',
                        'text' => 'Votre justification a bien été enregistrée.'
                    ];
                }
            } catch (PDOException $e) {
                $_SESSION['message'] = [
                    'type' => 'error',
                    'text' => 'Une erreur est survenue lors de la justification.'
                ];
            }
        }
    } else {
        $_SESSION['message'] = [
            'type' => 'error',
            'text' => 'Tous les champs requis ne sont pas remplis.'
        ];
    }
    
    header('Location: index.php?page=listeAbsence');
    exit();
}