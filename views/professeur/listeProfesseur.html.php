<!-- Contenu Principal -->
<div class="flex-1 p-6 rounded shadow">

    <!-- Barre de recherche et bouton -->
    <div class="flex justify-between items-center mb-4">
    <h2 class="text-2xl font-bold mb-4">Liste des Professeurs</h2>
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
                    <th>Specialite</th>
                    <th>Grade</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($professeurs as $professeur) { ?>
                    <tr class="border-b">
                        <td><?= $professeur["nom"] ?></td>
                        <td><?= $professeur["prenom"] ?></td>
                        <td><?= $professeur["specialite"] ?></td>
                        <td><?= $professeur["grade"] ?></td>
                        <td class="p-2 relative group">
    <!-- Bouton "⋮" -->
    <button class="p-2 rounded bg-gray-200 hover:bg-gray-300 transition-colors">⋮</button>
    
    <!-- Menu déroulant (caché par défaut, visible au survol) -->
    <div class="hidden group-hover:block absolute bg-white shadow-md rounded p-2 right-0 z-10 w-48 border border-gray-100">
        <a href="#" class="block p-2 hover:bg-gray-100 rounded">✏️ Modifier</a>
        <a href="#" class="block p-2 hover:bg-gray-100 rounded">👀 Voir Etudiant</a>
        <a href="#" class="block p-2 hover:bg-gray-100 rounded">📂 Archiver</a>
    </div>
</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>