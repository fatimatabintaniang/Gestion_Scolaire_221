<!-- Contenu Principal -->
<div class="flex-1 p-6 rounded shadow">

    <!-- Barre de recherche et bouton -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold mb-4">Liste des Etudiants inscrit</h2>
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
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Email</th>
                    <th>Matricule</th>
                    <th>Adresse</th>
                    <th>Classe</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inscriptions as $inscription) { ?>
                    <tr class="border-b">
                        <td><?= $inscription["nom"] ?></td>
                        <td><?= $inscription["prenom"] ?></td>
                        <td><?= $inscription["email"] ?></td>
                        <td><?= $inscription["matricule"] ?></td>
                        <td><?= $inscription["adresse"] ?></td>
                        <td><?= $inscription["libelle"] ?></td>
                        <td class="p-2 relative group">
                            <button class="p-2 rounded bg-gray-200 hover:bg-gray-300 transition-colors">Annuler</button>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>