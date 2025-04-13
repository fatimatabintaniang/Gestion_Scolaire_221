

<!-- Contenu Principal -->
<div class="flex-1 p-6 md:p-8 rounded-2xl bg-white shadow-xl overflow-y-auto h-[68vh] ">

    <!-- En-tête avec titre et boutons - Fonctionnalités conservées -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Liste des Cours</h2>
            <p class="text-gray-500 mt-1">Liste des cours</p>
        </div>
        
        <div class="flex space-x-3">
         <!-- Barre de recherche et bouton -->
    <div class="flex justify-between items-center mb-4">
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



            <a href="?controler=cours&page=listeCours&show_add_modal=1" class="bg-purple-600 text-white px-4 py-2 rounded bg-gradient-to-r from-primary to-accent">
                Nouveau
            </a>

        </div>
    </div>

        </div>
    </div>

<!-- Modale Ajout cours -->
<div id="add-course-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 
    <?= (isset($_GET['show_add_modal']) || !empty($errors)) ? '' : 'hidden' ?>">
    <div class="bg-white p-6 rounded-2xl shadow-xl w-[50%] max-w-3xl min-w-[600px] relative max-h-[90vh] overflow-y-auto">
        <!-- Bouton fermeture -->
        <a href="?controler=cours&page=listeCours" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </a>

        <h2 class="text-xl font-bold mb-4 text-purple-700 border-b pb-2">Ajouter un Cours</h2>
        
        <?php if (isset($errors['general'])): ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-4 rounded">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <span class="text-sm"><?= $errors['general'] ?></span>
                </div>
            </div>
        <?php endif; ?>

        <form action="<?= WEBROOB ?>?controler=cours&page=ajouter" method="POST" class="space-y-3">
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">Date :</label>
                    <input type="date" name="date" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition <?= isset($errors['date']) ? 'border-red-500 bg-red-50' : '' ?>"
                        value="<?= htmlspecialchars($formData['date'] ?? '') ?>">
                    <?php if (isset($errors['date'])): ?>
                        <p class="text-red-500 text-xs mt-1 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <?= $errors['date'] ?>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">Heure Début :</label>
                    <input type="time" name="heure_debut" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition <?= isset($errors['heure_debut']) ? 'border-red-500 bg-red-50' : '' ?>"
                        value="<?= htmlspecialchars($formData['heure_debut'] ?? '') ?>">
                    <?php if (isset($errors['heure_debut'])): ?>
                        <p class="text-red-500 text-xs mt-1 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <?= $errors['heure_debut'] ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">Heure Fin :</label>
                    <input type="time" name="heure_fin" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition <?= isset($errors['heure_fin']) ? 'border-red-500 bg-red-50' : '' ?>"
                        value="<?= htmlspecialchars($formData['heure_fin'] ?? '') ?>">
                    <?php if (isset($errors['heure_fin'])): ?>
                        <p class="text-red-500 text-xs mt-1 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <?= $errors['heure_fin'] ?>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">Nombre d'heures :</label>
                    <input type="number" name="nombre_heures" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition <?= isset($errors['nombre_heures']) ? 'border-red-500 bg-red-50' : '' ?>"
                        value="<?= htmlspecialchars($formData['nombre_heures'] ?? '') ?>">
                    <?php if (isset($errors['nombre_heures'])): ?>
                        <p class="text-red-500 text-xs mt-1 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <?= $errors['nombre_heures'] ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">Semestre :</label>
                    <input type="text" name="semestre" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition <?= isset($errors['semestre']) ? 'border-red-500 bg-red-50' : '' ?>"
                        value="<?= htmlspecialchars($formData['semestre'] ?? '') ?>">
                    <?php if (isset($errors['semestre'])): ?>
                        <p class="text-red-500 text-xs mt-1 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <?= $errors['semestre'] ?>
                        </p>
                    <?php endif; ?>
                </div>
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700">Professeur :</label>
                    <select name="professeur" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition <?= isset($errors['professeur']) ? 'border-red-500 bg-red-50' : '' ?>">
                        <option value="">Sélectionnez un professeur</option>
                        <?php foreach ($professeurs as $prof): ?>
                            <option value="<?= $prof['id_professeur'] ?>" <?= (isset($formData['professeur'])) && $formData['professeur'] == $prof['id_professeur'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($prof['prenom'] . ' ' . $prof['nom']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (isset($errors['professeur'])): ?>
                        <p class="text-red-500 text-xs mt-1 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                            <?= $errors['professeur'] ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="space-y-1">
                <label class="block text-sm font-medium text-gray-700">Module :</label>
                <select name="module" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition <?= isset($errors['module']) ? 'border-red-500 bg-red-50' : '' ?>">
                    <option value="">Sélectionnez un module</option>
                    <?php foreach ($modules as $module): ?>
                        <option value="<?= $module['id_module'] ?>" <?= (isset($formData['module']) && $formData['module'] == $module['id_module'] ? 'selected' : '') ?>>
                            <?= htmlspecialchars($module['libelle']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['module'])): ?>
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <?= $errors['module'] ?>
                    </p>
                <?php endif; ?>
            </div>

            <!-- Section pour l'affectation des classes -->
            <div class="space-y-1">
                <label class="block text-sm font-medium text-gray-700">Affecter aux classes :</label>
                <div class="grid grid-cols-3 gap-2 max-h-32 overflow-y-auto p-3 border border-gray-300 rounded-lg bg-gray-50">
                    <?php foreach ($allClasses as $classe): ?>
                        <div class="flex items-center">
                            <input type="checkbox" name="classes[]" id="classe_<?= $classe['id_classe'] ?>"
                                value="<?= $classe['id_classe'] ?>"
                                class="h-3.5 w-3.5 text-purple-600 focus:ring-purple-500 border-gray-300 rounded <?= (isset($formData['classes']) && in_array($classe['id_classe'], $formData['classes'])) ? 'checked' : '' ?>">
                            <label for="classe_<?= $classe['id_classe'] ?>" class="ml-2 text-xs text-gray-700">
                                <?= htmlspecialchars($classe['libelle']) ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php if (isset($errors['classes'])): ?>
                    <p class="text-red-500 text-xs mt-1 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        <?= $errors['classes'] ?>
                    </p>
                <?php endif; ?>
            </div>

            <div class="flex justify-end space-x-3 pt-3 border-t">
                <a href="?controler=cours&page=listeCours" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50 transition duration-200 text-sm">
                    Annuler
                </a>
                <button type="submit" class="px-4 py-2 rounded-lg bg-gradient-to-r from-purple-600 to-purple-700 text-white hover:from-purple-700 hover:to-purple-800 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition duration-200 shadow text-sm">
                    Ajouter
                </button>
            </div>
        </form>
    </div>
</div>

    <!-- Modale Modification cours -->
    <div id="edit-course-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 <?= isset($showEditModal) && $showEditModal ? '' : 'hidden' ?>">
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

                    <!-- Section pour l'affectation des classes -->
                    <div class="mb-4">
                    <label class="block mb-2">Affecter aux classes :</label>
                    <div class="grid grid-cols-3 gap-2 max-h-40 overflow-y-auto p-2 border rounded">
                        <?php foreach ($allClasses as $classe): ?>
                            <div class="flex items-center">
                                <input type="checkbox" name="classes[]" id="edit_classe_<?= $classe['id_classe'] ?>"
                                    value="<?= $classe['id_classe'] ?>"
                                    class="mr-2" <?= (isset($formData['classes']) && in_array($classe['id_classe'], $formData['classes'])) ? 'checked' : '' ?>>
                                <label for="edit_classe_<?= $classe['id_classe'] ?>"><?= htmlspecialchars($classe['libelle']) ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (isset($errors['classes'])): ?>
                        <p class="text-red-500 text-sm"><?= $errors['classes'] ?></p>
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
    <div id="view-classes-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 <?= isset($showClassesModal) && $showClassesModal ? '' : 'hidden' ?>">
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
    <div id="confirm-annuler-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 <?= isset($showConfirmAnnuler) ? '' : 'hidden' ?>">
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

    <!-- Liste des cours en cartes - Mêmes données et fonctionnalités -->
    <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-3 gap-6  ">
        <?php if (empty($cours)): ?>
            <div class="col-span-full py-16 text-center animate-pulse">
                <div class="mx-auto w-28 h-28 rounded-full bg-gradient-to-br from-gray-100 to-gray-50 flex items-center justify-center mb-6 shadow-inner">
                    <i class="fas fa-chalkboard-teacher text-4xl text-gray-300"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-700">Aucun cours programmé</h3>
                <p class="text-gray-400 mt-2">Les cours apparaîtront ici</p>
            </div>
        <?php else: ?>
            <?php foreach ($cours as $cour): ?>
                <div class="relative bg-white rounded-2xl overflow-hidden shadow-lg border transition-all duration-500 group transform hover:-translate-y-2 border border-gray-100 ">
                    <!-- Bandeau coloré neutre -->
                    <div class="absolute top-0 left-0 w-full h-2 text-white bg-gradient-to-r from-primary to-accent"></div>

                    <!-- Contenu principal -->
                    <div class="p-5 pt-6">
                        <!-- En-tête -->
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">
                                    <?= htmlspecialchars($cour["date"] ?? 'Non défini') ?>
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    <?= htmlspecialchars($cour["semestre"] ?? 'Non défini') ?>
                                </p>
                            </div>
                            <span class="bg-gray-100 shadow-inner rounded-lg px-2.5 py-1 text-sm font-medium text-gray-700">
                                <?= htmlspecialchars($cour["heure_debut"] ?? '--:--') ?>-<?= htmlspecialchars($cour["heure_fin"] ?? '--:--') ?>
                            </span>
                        </div>

                        <!-- Classe -->
                        <div class="mb-4">
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                <?= htmlspecialchars($cour["professeur"] ?? 'Non assigné') ?>
                            </span>
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                <?= htmlspecialchars($cour["nombre_heures"] ?? 'Non assigné') ?>h
                            </span>
                        </div>

                        <div class="mb-4">
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                <?= htmlspecialchars($cour["module"] ?? 'Non assigné') ?>
                            </span>
                        </div>
                    </div>

                    <!-- Pied de carte avec menu identique -->
                    <div class="px-5 py-4 bg-gray-50 border-t border-gray-100 flex justify-end">
                                <a href="?controler=cours&page=prepareModifierCours&cours_id=<?= $cour['id_cours'] ?><?= isset($_GET['professeur_filtre']) ? '&professeur_filtre=' . $_GET['professeur_filtre'] : '' ?><?= isset($_GET['date_debut']) ? '&date_debut=' . $_GET['date_debut'] : '' ?><?= isset($_GET['date_fin']) ? '&date_fin=' . $_GET['date_fin'] : '' ?><?= isset($_GET['page_num']) ? '&page_num=' . $_GET['page_num'] : '' ?>"
                                    class="block p-2 hover:bg-gray-100 rounded text-xs">✏️ Modifier</a>
                                <a href="?controler=cours&page=voirClasses&cours_id=<?= $cour['id_cours'] ?>" class="block text-xs p-2 hover:bg-gray-100 rounded">👀 Voir Classes</a>
                                <a href="?controler=cours&page=confirmAnnuler&cours_id=<?= $cour['id_cours'] ?>"
                                    class="block p-2 hover:bg-gray-100 rounded text-red-500 text-xs">🗑 Annuler</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>
<!-- Pagination -->
<?php if (isset($totalCours) && $totalCours > ($perPage ?? 5)): ?>
    <div class="flex justify-between items-center mt-4">
        <div class="text-sm text-gray-600">
            Affichage de <?= (($currentPage - 1) * ($perPage ?? 5)) + 1 ?> à <?= min($currentPage * ($perPage ?? 5), $totalCours) ?> sur <?= $totalCours ?> cours
        </div>
        <div class="flex space-x-2">
            <?php if ($currentPage > 1): ?>
                <a href="?controler=cours&page=listeCours&page_num=<?= $currentPage - 1 ?><?= !empty($currentSearch) ? '&search=' . urlencode($currentSearch) : '' ?>"
                    class="px-4 py-2 border rounded hover:bg-gray-100">
                    Précédent
                </a>
            <?php endif; ?>

            <?php
            $perPage = $perPage ?? 5; // Default to 5 if not set
            $totalPages = ceil($totalCours / $perPage);
            $startPage = max(1, $currentPage - 2);
            $endPage = min($totalPages, $currentPage + 2);

            for ($i = $startPage; $i <= $endPage; $i++): ?>
                <a href="?controler=cours&page=listeCours&page_num=<?= $i ?><?= !empty($currentSearch) ? '&search=' . urlencode($currentSearch) : '' ?>"
                    class="px-4 py-2 border rounded <?= $i == $currentPage ? 'bg-purple-600 text-white' : 'hover:bg-gray-100' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
                <a href="?controler=cours&page=listeCours&page_num=<?= $currentPage + 1 ?><?= !empty($currentSearch) ? '&search=' . urlencode($currentSearch) : '' ?>"
                    class="px-4 py-2 border rounded hover:bg-gray-100">
                    Suivant
                </a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>