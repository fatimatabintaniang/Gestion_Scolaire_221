<!-- Contenu Principal -->
<div class="flex-1 p-6 rounded shadow">

    <!-- Barre de recherche et bouton -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold mb-4">Liste des Cours</h2>
        <div class="space-x-3 flex">
            <div class="relative group">
                <button class=" text-black shadow px-4 py-2  rounded bg-gray-200 hover:bg-gray-300 transition-colors">filtrer</button>
                <!-- Menu déroulant -->
                <div class="hidden group-hover:block absolute bg-white shadow-md rounded p-2 right-0 z-10  border border-gray-100">
                    <form method="GET" class=" space-y-3  mb-4">
                        <input type="hidden" name="controler" value="cours">
                        <input type="hidden" name="page" value="listeCours">

                        <select name="professeur_filtre" class="border p-2 rounded">
                            <option value="">-- Tous les professeurs --</option>
                            <?php foreach ($professeurs as $prof): ?>
                                <option value="<?= $prof['id_professeur'] ?>"
                                    <?= (isset($_GET['professeur_filtre']) && $_GET['professeur_filtre'] == $prof['id_professeur']) ? 'selected' : '' ?>>
                                    <?= $prof['prenom'] . ' ' . $prof['nom'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>

                        <div class="grid grid-cols-2 gap-3">
                            <input type="date" name="date_debut" class="border p-2 rounded"
                                value="<?= htmlspecialchars($_GET['date_debut'] ?? '') ?>">

                            <input type="date" name="date_fin" class="border p-2 rounded"
                                value="<?= htmlspecialchars($_GET['date_fin'] ?? '') ?>">

                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Filtrer
                        </button>
                    </form>

                </div>
            </div>



            <a href="?controler=cours&page=listeCours&show_add_modal=1" class="bg-purple-600 text-white px-4 py-2 rounded">
                Nouveau
            </a>

        </div>
    </div>


     <!-- Modale Ajout cours -->
     <div id="add-course-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 
        <?= (isset($_GET['show_add_modal']) || !empty($errors)) ? '' : 'hidden' ?>">
        <div class="bg-white p-6 rounded-lg shadow-lg w-[50%]">
            <h2 class="text-xl font-bold mb-4">Ajouter un Cours</h2>
            <?php if (isset($errors['general'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <?= $errors['general'] ?>
                </div>
            <?php endif; ?>
            
            <form action="<?= WEBROOB ?>?controler=cours&page=ajouter" method="POST">
            <div class="grid grid-cols-2 gap-4">
                    <div class="mb-2">
                        <label class="block">Date :</label>
                        <input type="date" name="date" class="w-full p-2 border rounded <?= isset($errors['date']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['date'] ?? '') ?>">
                        <?php if (isset($errors['date'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['date'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label class="block">Heure Début :</label>
                        <input type="time" name="heure_debut" class="w-full p-2 border rounded <?= isset($errors['heure_debut']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['heure_debut'] ?? '') ?>">
                        <?php if (isset($errors['heure_debut'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['heure_debut'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-2">
                        <label class="block">Heure Fin :</label>
                        <input type="time" name="heure_fin" class="w-full p-2 border rounded <?= isset($errors['heure_fin']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['heure_fin'] ?? '') ?>">
                        <?php if (isset($errors['heure_fin'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['heure_fin'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label class="block">Nombre d'heures :</label>
                        <input type="number" name="nombre_heures" class="w-full p-2 border rounded <?= isset($errors['nombre_heures']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['nombre_heures'] ?? '') ?>">
                        <?php if (isset($errors['nombre_heures'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['nombre_heures'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-2">
                        <label class="block">Semestre :</label>
                        <input type="text" name="semestre" class="w-full p-2 border rounded <?= isset($errors['semestre']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['semestre'] ?? '') ?>">
                        <?php if (isset($errors['semestre'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['semestre'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label class="block">Professeur :</label>
                        <select name="professeur" class="w-full p-2 border rounded <?= isset($errors['professeur']) ? 'border-red-500' : '' ?>">
                            <option value="">Sélectionnez un professeur</option>
                            <?php foreach ($professeurs as $prof): ?>
                                <option value="<?= $prof['id_professeur'] ?>" <?= (isset($formData['professeur'])) && $formData['professeur'] == $prof['id_professeur'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($prof['prenom'] . ' ' . $prof['nom']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($errors['professeur'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['professeur'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="block">Module :</label>
                    <select name="module" class="w-full p-2 border rounded <?= isset($errors['module']) ? 'border-red-500' : '' ?>">
                        <option value="">Sélectionnez un module</option>
                        <?php foreach ($modules as $module): ?>
                            <option value="<?= $module['id_module'] ?>" <?= (isset($formData['module']) && $formData['module'] == $module['id_module'] ? 'selected' : '') ?>>
                                <?= htmlspecialchars($module['libelle']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['module'])): ?>
                        <p class="text-red-500 text-sm"><?= $errors['module'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="flex justify-end space-x-2">
 <!-- Lien PHP pour fermer la modale -->
 <a href="?controler=cours&page=listeCours" class="bg-gray-400 text-white px-4 py-2 rounded">
                        Annuler
                    </a>
                    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">
                        Ajouter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modale Modification cours -->
    <div id="edit-course-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 <?= isset($showEditModal) && $showEditModal ? '' : 'hidden' ?>">
        <div class="bg-white p-6 rounded-lg shadow-lg w-[50%]">
            <h2 class="text-xl font-bold mb-4">Modifier le Cours</h2>
            <?php if (isset($errors['general'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <?= $errors['general'] ?>
                </div>
            <?php endif; ?>
            <form action="?controler=cours&page=modifierCours&cours_id=<?= $coursToEdit['id_cours'] ?>" method="POST">
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-2">
                        <label class="block">Date :</label>
                        <input type="date" name="date" class="w-full p-2 border rounded <?= isset($errors['date']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['date'] ?? $coursToEdit['date']) ?>">
                        <?php if (isset($errors['date'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['date'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label class="block">Heure Début :</label>
                        <input type="time" name="heure_debut" class="w-full p-2 border rounded <?= isset($errors['heure_debut']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['heure_debut'] ?? $coursToEdit['heure_debut']) ?>">
                        <?php if (isset($errors['heure_debut'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['heure_debut'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-2">
                        <label class="block">Heure Fin :</label>
                        <input type="time" name="heure_fin" class="w-full p-2 border rounded <?= isset($errors['heure_fin']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['heure_fin'] ?? $coursToEdit['heure_fin']) ?>">
                        <?php if (isset($errors['heure_fin'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['heure_fin'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label class="block">Nombre d'heures :</label>
                        <input type="number" name="nombre_heures" class="w-full p-2 border rounded <?= isset($errors['nombre_heures']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['nombre_heures'] ?? $coursToEdit['nombre_heures']) ?>">
                        <?php if (isset($errors['nombre_heures'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['nombre_heures'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-2">
                        <label class="block">Semestre :</label>
                        <input type="text" name="semestre" class="w-full p-2 border rounded <?= isset($errors['semestre']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['semestre'] ?? $coursToEdit['semestre']) ?>">
                        <?php if (isset($errors['semestre'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['semestre'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label class="block">Professeur :</label>
                        <select name="professeur" class="w-full p-2 border rounded <?= isset($errors['professeur']) ? 'border-red-500' : '' ?>">
                            <option value="">Sélectionnez un professeur</option>
                            <?php foreach ($professeurs as $prof): ?>
                                <option value="<?= $prof['id_professeur'] ?>"
                                    <?= ((isset($formData['professeur']) && $formData['professeur'] == $prof['id_professeur']) ||
                                        (!isset($formData['professeur']) && $coursToEdit['id_professeur'] == $prof['id_professeur'])) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($prof['prenom'] . ' ' . $prof['nom']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($errors['professeur'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['professeur'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="mb-2">
                    <label class="block">Module :</label>
                    <select name="module" class="w-full p-2 border rounded <?= isset($errors['module']) ? 'border-red-500' : '' ?>">
                        <option value="">Sélectionnez un module</option>
                        <?php foreach ($modules as $module): ?>
                            <option value="<?= $module['id_module'] ?>"
                                <?= ((isset($formData['module']) && $formData['module'] == $module['id_module'])) ||
                                    (!isset($formData['module']) && $coursToEdit['id_module'] == $module['id_module']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($module['libelle']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['module'])): ?>
                        <p class="text-red-500 text-sm"><?= $errors['module'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="flex justify-end space-x-2">
                    <a href="?controler=cours&page=listeCours" class="bg-gray-400 text-white px-4 py-2 rounded">
                        Annuler
                    </a>
                    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal pour afficher les classes -->
    <div id="view-classes-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 <?= isset($showClassesModal) && $showClassesModal ? '' : 'hidden' ?>">
        <div class="bg-white p-6 rounded-lg shadow-lg w-[50%] max-h-[80vh] flex flex-col">
            <h2 class="text-xl font-bold mb-4">Classes pour ce cours</h2>

            <div class="overflow-y-auto flex-grow">
                <?php if (!empty($classesForModal)): ?>
                    <div class="grid grid-cols-2 gap-4">
                        <?php foreach ($classesForModal as $classe): ?>
                            <div class="bg-white rounded-lg border border-gray-200 shadow p-4 hover:shadow-md transition-shadow">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="font-semibold text-lg"><?= htmlspecialchars($classe['libelle']) ?></h3>
                                        <?php if (isset($classe['effectif'])): ?>
                                            <p class="text-gray-600 mt-1">Effectif: <?= htmlspecialchars($classe['effectif']) ?> élèves</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="mt-2 text-gray-600">Aucune classe trouvée pour ce cours</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="flex justify-end mt-4">
                <a href="?controler=cours&page=listeCours" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition-colors">
                    Fermer
                </a>
            </div>
        </div>
    </div>

    <!-- Modal de confirmation pour annuler un cours -->
    <div id="confirm-annuler-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 <?= isset($showConfirmAnnuler) ? '' : 'hidden' ?>">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-xl font-bold mb-4">Confirmer l'annulation</h2>
            <p class="mb-6">Êtes-vous sûr de vouloir annuler ce cours ? Cette action est irréversible.</p>

            <div class="flex justify-end space-x-3">
                <a href="?controler=cours&page=listeCours" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition-colors">
                    Non, annuler
                </a>
                <a href="?controler=cours&page=annuler&cours_id=<?= isset($coursToAnnuler) ? $coursToAnnuler : '' ?>"
                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition-colors">
                    Oui, confirmer
                </a>
            </div>
        </div>
    </div>


    <?php if (isset($_SESSION['message'])): ?>
        <div class="fixed top-4 right-4 z-50">
            <div class="<?= $_SESSION['message_type'] == 'success' ? 'bg-green-500' : 'bg-red-500' ?> text-white px-4 py-2 rounded shadow-lg">
                <?= $_SESSION['message'] ?>
            </div>
        </div>
        <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
    <?php endif; ?>


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
                                <a href="?controler=cours&page=prepareModifierCours&cours_id=<?= $cour['id_cours'] ?><?= isset($_GET['professeur_filtre']) ? '&professeur_filtre=' . $_GET['professeur_filtre'] : '' ?><?= isset($_GET['date_debut']) ? '&date_debut=' . $_GET['date_debut'] : '' ?><?= isset($_GET['date_fin']) ? '&date_fin=' . $_GET['date_fin'] : '' ?><?= isset($_GET['page_num']) ? '&page_num=' . $_GET['page_num'] : '' ?>"
                                    class="block p-2 hover:bg-gray-100 rounded">✏️ Modifier</a>
                                <a href="?controler=cours&page=voirClasses&cours_id=<?= $cour['id_cours'] ?>" class="block p-2 hover:bg-gray-100 rounded">👀 Voir Classes</a>
                                <a href="?controler=cours&page=confirmAnnuler&cours_id=<?= $cour['id_cours'] ?>"
                                    class="block p-2 hover:bg-gray-100 rounded text-red-500">🗑 Annuler</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <?php if (isset($totalPages) && $totalPages > 1): ?>
            <div class="flex justify-between items-center mt-4">
                <div class="text-sm text-gray-600">
                    Affichage de <?= (($currentPage - 1) * 5) + 1 ?> à <?= min($currentPage * 5, $totalCours) ?> sur <?= $totalCours ?> cours
                </div>

                <div class="flex space-x-2">
                    <?php if ($currentPage > 1): ?>
                        <a href="?controler=cours&page=listeCours&page_num=<?= $currentPage - 1 ?><?= isset($_GET['professeur_filtre']) ? '&professeur_filtre=' . $_GET['professeur_filtre'] : '' ?><?= isset($_GET['date_debut']) ? '&date_debut=' . $_GET['date_debut'] : '' ?><?= isset($_GET['date_fin']) ? '&date_fin=' . $_GET['date_fin'] : '' ?>"
                            class="px-4 py-2 border rounded hover:bg-gray-100">
                            Précédent
                        </a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?controler=cours&page=listeCours&page_num=<?= $i ?><?= isset($_GET['professeur_filtre']) ? '&professeur_filtre=' . $_GET['professeur_filtre'] : '' ?><?= isset($_GET['date_debut']) ? '&date_debut=' . $_GET['date_debut'] : '' ?><?= isset($_GET['date_fin']) ? '&date_fin=' . $_GET['date_fin'] : '' ?>"
                            class="px-4 py-2 border rounded <?= $i == $currentPage ? 'bg-purple-600 text-white' : 'hover:bg-gray-100' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>

                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?controler=cours&page=listeCours&page_num=<?= $currentPage + 1 ?><?= isset($_GET['professeur_filtre']) ? '&professeur_filtre=' . $_GET['professeur_filtre'] : '' ?><?= isset($_GET['date_debut']) ? '&date_debut=' . $_GET['date_debut'] : '' ?><?= isset($_GET['date_fin']) ? '&date_fin=' . $_GET['date_fin'] : '' ?>"
                            class="px-4 py-2 border rounded hover:bg-gray-100">
                            Suivant
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
