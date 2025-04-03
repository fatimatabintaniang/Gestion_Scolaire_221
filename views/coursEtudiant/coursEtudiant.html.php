<!-- Contenu Principal -->
<div class="flex-1 p-6 rounded shadow">

    <!-- Barre de recherche et bouton -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold mb-4">Liste des Cours</h2>
        <div class="space-x-3">
            <button class=" text-black shadow px-4 py-2 rounded">filtrer</button>
            <button class="bg-purple-600 text-white px-4 py-2 rounded">Nouveau</button>
        </div>
    </div>

    <!-- Tableau -->
    <div class="bg-white text-black p-4 rounded-lg shadow">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>HD</th>
                    <th>HF</th>
                    <th>NH</th>
                    <th>Semestre</th>
                    <th>Prof</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($coursEtudiants as $coursEtudiant) { ?>
                    <tr class="border-b">
                        <td><?= htmlspecialchars($coursEtudiant["date"] ?? 'Non défini') ?></td>
                        <td><?= htmlspecialchars($coursEtudiant["heure_debut"] ?? 'Non défini') ?></td>
                        <td><?= htmlspecialchars($coursEtudiant["heure_fin"] ?? 'Non défini') ?></td>
                        <td><?= htmlspecialchars($coursEtudiant["nombre_heures"] ?? '0') ?>h</td>
                        <td><?= htmlspecialchars($coursEtudiant["semestre"] ?? 'Non défini') ?></td>
                        <td><?= htmlspecialchars($coursEtudiant["professeur"] ?? 'Non assigné') ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>