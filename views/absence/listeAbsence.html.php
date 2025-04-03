<!-- Contenu Principal -->
<div class="flex-1 p-6 rounded shadow">

    <!-- Barre de recherche et bouton -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold mb-4"> Liste des absences</h2>
        <div class="space-x-3">
            <button class=" text-black shadow px-4 py-2 rounded">filtrer</button>
            <button class="bg-purple-600 text-white px-4 py-2 rounded">Nouveau</button>
        </div>
    </div>

    <!-- Tableau -->
    <div class="bg-white text-black p-4 rounded-lg shadow">
        <table class="w-full text-center border-collapse">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>HD</th>
                    <th>HF</th>
                    <th>Semestre</th>
                    <th>Prof</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($absences as $absence) { ?>
                    <tr class="border-b">
                        <td><?= htmlspecialchars($absence["date"] ?? 'Non défini') ?></td>
                        <td><?= htmlspecialchars($absence["heure_debut"] ?? 'Non défini') ?></td>
                        <td><?= htmlspecialchars($absence["heure_fin"] ?? 'Non défini') ?></td>
                        <td><?= htmlspecialchars($absence["semestre"] ?? 'Non défini') ?></td>
                        <td><?= htmlspecialchars($absence["nom"] ?? 'Non assigné') ?></td>
                        <td class="p-2 relative group">
                            <button class="p-2 rounded bg-gray-200 hover:bg-gray-300 transition-colors">Justifier</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>