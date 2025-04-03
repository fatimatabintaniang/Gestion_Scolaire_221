<!-- Contenu Principal -->
<div class="flex-1 p-6 rounded shadow">

    <!-- Barre de recherche et bouton -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold mb-4">Liste des Cours</h2>
        <div class="space-x-3">
            <button class=" text-black shadow px-4 py-2 rounded">filtrer</button>

            <button id="add-course-btn" class="bg-purple-600 text-white px-4 py-2 rounded">
                Nouveau
            </button>

        </div>
    </div>

    <!-- Modale cachée -->
    <div id="add-course-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-[50%]">
            <h2 class="text-xl font-bold mb-4">Ajouter un Cours</h2>
            <form action="<?=WEBROOB?>?controler=cours&page=ajouter" method="POST">
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-2">
                        <label class="block">Date :</label>
                        <input type="date" name="date" class="w-full p-2 border rounded">
                    
                    </div>
                    <div class="mb-2">
                        <label class="block">Heure Début :</label>
                        <input type="time" name="heure_debut" class="w-full p-2 border rounded">
                       
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-2">
                        <label class="block">Heure Fin :</label>
                        <input type="time" name="heure_fin" class="w-full p-2 border rounded">
                       
                    </div>
                    <div class="mb-2">
                        <label class="block">Nombre d'heures :</label>
                        <input type="number" name="nombre_heures" class="w-full p-2 border rounded">
                     
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-2">
                        <label class="block">Semestre :</label>
                        <input type="text" name="semestre" class="w-full p-2 border rounded">
                        
                    </div>
                    <div class="mb-2">
                        <label class="block">Professeur :</label>
                        <select name="professeur" class="w-full p-2 border rounded">
                            <!-- Options chargées dynamiquement -->
                            <?php foreach ($professeurs as  $prof): ?>
                                <option value="<?= $prof['id_professeur'] ?>"><?= htmlspecialchars($prof['prenom'] . ' ' . $prof['nom']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="block">Module :</label>
                    <select name="module" class="w-full p-2 border rounded">
                        <!-- Options chargées dynamiquement -->
                        <?php foreach ($modules as $module): ?>
                            <option value="<?= $module['id_module'] ?>"><?= htmlspecialchars($module['libelle']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" id="close-modal" class="bg-gray-400 text-white px-4 py-2 rounded">
                        Annuler
                    </button>
                    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">
                        Ajouter
                    </button>
                </div>
            </form>
        </div>
    </div>



    <!-- <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">Cours ajouté avec succès!</span>
        </div>
    <?php endif; ?> -->

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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cours as $cour) { ?>
                    <tr class="border-b">
                        <td><?= htmlspecialchars($cour["date"] ?? 'Non défini') ?></td>
                        <td><?= htmlspecialchars($cour["heure_debut"] ?? 'Non défini') ?></td>
                        <td><?= htmlspecialchars($cour["heure_fin"] ?? 'Non défini') ?></td>
                        <td><?= htmlspecialchars($cour["nombre_heures"] ?? '0') ?>h</td>
                        <td><?= htmlspecialchars($cour["semestre"] ?? 'Non défini') ?></td>
                        <td><?= htmlspecialchars($cour["professeur"] ?? 'Non assigné') ?></td>
                        <td><?= htmlspecialchars($cour["module"] ?? 'Non spécifié') ?></td>
                        <td class="p-2 relative group">
                            <!-- Bouton "⋮" -->
                            <button class="p-2 rounded bg-gray-200 hover:bg-gray-300 transition-colors">⋮</button>

                            <!-- Menu déroulant -->
                            <div class="hidden group-hover:block absolute bg-white shadow-md rounded p-2 right-0 z-10 w-48 border border-gray-100">
                                <a href="edit_cours.php?id=<?= $cour['id_cours'] ?>" class="block p-2 hover:bg-gray-100 rounded">✏️ Modifier</a>
                                <a href="view_etudiants.php?cours_id=<?= $cour['id_cours'] ?>" class="block p-2 hover:bg-gray-100 rounded">👀 Voir Etudiant</a>
                                <a href="archive_cours.php?id=<?= $cour['id_cours'] ?>" class="block p-2 hover:bg-gray-100 rounded">📂 Archiver</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    document.getElementById("add-course-btn").addEventListener("click", function() {
        document.getElementById("add-course-modal").classList.remove("hidden");
    });

    document.getElementById("close-modal").addEventListener("click", function() {
        document.getElementById("add-course-modal").classList.add("hidden");
    });
</script>