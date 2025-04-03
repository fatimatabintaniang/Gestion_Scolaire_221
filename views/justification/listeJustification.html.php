<!-- Contenu Principal -->
<div class="flex-1 p-6 rounded shadow">

    <!-- Barre de recherche et bouton -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold mb-4">Liste des Justifications</h2>
        <div class="space-x-3">
            <button class=" text-black shadow px-4 py-2 rounded">filtrer</button>
        </div>
    </div>

    <!-- Tableau -->
    <div class="bg-white text-black p-4 rounded-lg shadow">
        <table class="w-full text-center border-collapse">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Motif</th>
                    <th>Etat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($justifications as $justification) { ?>
                    <tr class="border-b">
                        <td><?= $justification["date"] ?></td>
                        <td><?= $justification["motif"] ?></td>
                        <td class="text-red-500"><?= $justification["etat"] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>