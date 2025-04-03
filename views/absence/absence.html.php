<!-- Contenu Principal -->
<div class="flex-1 p-6 rounded shadow">

    <!-- Barre de recherche et bouton -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold mb-4">Liste des Cours planifier</h2>
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
                    <th>Module</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($absences as $absence) { ?>
                    <tr class="border-b">
                        <td><?= htmlspecialchars($absence["date"] ?? 'Non défini') ?></td>
                        <td><?= htmlspecialchars($absence["heure_debut"] ?? 'Non défini') ?></td>
                        <td><?= htmlspecialchars($absence["heure_fin"] ?? 'Non défini') ?></td>
                        <td><?= htmlspecialchars($absence["nombre_heures"] ?? '0') ?>h</td>
                        <td><?= htmlspecialchars($absence["semestre"] ?? 'Non défini') ?></td>
                        <td><?= htmlspecialchars($absence["professeur"] ?? 'Non assigné') ?></td>
                        <td><?= htmlspecialchars($absence["module"] ?? 'Non spécifié') ?></td>
                        <td class="p-2 relative group">
                            <!-- Bouton "⋮" -->
                            <button class="p-2 rounded bg-gray-200 hover:bg-gray-300 transition-colors">⋮</button>

                            <!-- Menu déroulant -->
                            <div class="hidden group-hover:block absolute bg-white shadow-md rounded p-2 right-0 z-10 w-48 border border-gray-100">
                                <a href="view_etudiants.php?cours_id=<?= $cour['id_cours'] ?>" class="block p-2 hover:bg-gray-100 rounded">👀 Voir classe</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>