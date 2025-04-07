<!-- Contenu Principal -->
<div class="flex-1 p-6 rounded shadow">

    <!-- Barre de recherche et bouton -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold mb-4">Liste des Professeurs</h2>

        <div class="flex space-x-3">
            <div class="relative group">
                <button class=" text-black shadow px-4 py-2  rounded bg-gray-200 hover:bg-gray-300 transition-colors">filtrer</button>
                <div class="hidden group-hover:block absolute bg-white shadow-md rounded p-2 right-0 z-10  border border-gray-100 ">

                    <form method="GET" class="flex items-center space-x-2">
                        <input type="hidden" name="controler" value="professeur">
                        <input type="hidden" name="page" value="listeProfesseur">

                        <div class="relative">
                            <input
                                type="search"
                                name="search"
                                placeholder="Nom, Prénom ou Spécialité..."
                                value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                                class="border p-2 rounded pl-10 w-64 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <svg class="absolute left-3 top-3 h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>

                        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                            Rechercher
                        </button>

                        <?php if (!empty($_GET['search'])): ?>
                            <a href="?controler=professeur&page=listeProfesseur" class="text-gray-600 hover:text-gray-800 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                                Effacer
                            </a>
                        <?php endif; ?>
                    </form>
                    <?php if (!empty($currentSearch)): ?>
                        <div class="mb-4 p-3 bg-gray-100 rounded flex items-center">
                            <span class="font-medium mr-2">Résultats pour :</span>
                            <span class="bg-gray-200 px-3 py-1 rounded-full text-sm">
                                "<?= htmlspecialchars($currentSearch) ?>"
                            </span>
                            <a href="?controler=professeur&page=listeProfesseur" class="text-red-500 ml-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                                Effacer
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <a href="?controler=professeur&page=listeProfesseur&show_add_modal=1" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                Nouveau
            </a>
        </div>
    </div>

    <!-- Modale Ajout Professeur -->
    <div id="add-course-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 
    <?= (isset($_GET['show_add_modal']) || !empty($errors)) ? '' : 'hidden' ?>">
        <div class="bg-white p-6 rounded-lg shadow-lg w-[50%]">
            <h2 class="text-xl font-bold mb-4">Ajouter un Professeur</h2>
            <?php if (isset($errors['general'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <?= $errors['general'] ?>
                </div>
            <?php endif; ?>

            <form action="<?= WEBROOB ?>?controler=professeur&page=ajouter" method="POST">
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-2">
                        <label class="block">Nom :</label>
                        <input type="text" name="nom" class="w-full p-2 border rounded <?= isset($errors['nom']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['nom'] ?? '') ?>">
                        <?php if (isset($errors['nom'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['nom'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label class="block">Prenom :</label>
                        <input type="text" name="prenom" class="w-full p-2 border rounded <?= isset($errors['prenom']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['prenom'] ?? '') ?>">
                        <?php if (isset($errors['prenom'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['prenom'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-2">
                        <label class="block">Specialite :</label>
                        <input type="text" name="specialite" class="w-full p-2 border rounded <?= isset($errors['specialite']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['specialite'] ?? '') ?>">
                        <?php if (isset($errors['specialite'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['specialite'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label class="block">Grade :</label>
                        <input type="text" name="grade" class="w-full p-2 border rounded <?= isset($errors['grade']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['grade'] ?? '') ?>">
                        <?php if (isset($errors['grade'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['grade'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-2">
                        <label class="block">Email :</label>
                        <input type="email" name="email"
                            class="w-full p-2 border rounded <?= isset($errors['email']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['email'] ?? '') ?>">
                        <?php if (isset($errors['email'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['email'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label class="block">Mot de passe :</label>
                        <input type="password" name="password"
                            class="w-full p-2 border rounded <?= isset($errors['password']) ? 'border-red-500' : '' ?>">
                        <?php if (isset($errors['password'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['password'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>




                <!-- Nouvelle section pour l'affectation des classes -->
                <div class="mb-4">
                    <label class="block mb-2">Affecter aux classes :</label>
                    <div class="grid grid-cols-3 gap-2 max-h-40 overflow-y-auto p-2 border rounded">
                        <?php foreach ($allClasses as $classe): ?>
                            <div class="flex items-center">
                                <input type="checkbox" name="classes[]" id="classe_<?= $classe['id_classe'] ?>"
                                    value="<?= $classe['id_classe'] ?>"
                                    class="mr-2" <?= (isset($formData['classes']) && in_array($classe['id_classe'], $formData['classes'])) ? 'checked' : '' ?>>
                                <label for="classe_<?= $classe['id_classe'] ?>"><?= htmlspecialchars($classe['libelle']) ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?php if (isset($errors['classes'])): ?>
                        <p class="text-red-500 text-sm"><?= $errors['classes'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="flex justify-end space-x-2">
                    <a href="?controler=professeur&page=listeProfesseur" class="bg-gray-400 text-white px-4 py-2 rounded">
                        Annuler
                    </a>
                    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">
                        Ajouter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modale Modification Professeur -->
    <div id="edit-course-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 
    <?= (isset($_GET['show_edit_modal']) || (!empty($errors) && isset($isEditMode))) ? '' : 'hidden' ?>">
        <div class="bg-white p-6 rounded-lg shadow-lg w-[50%]">
            <h2 class="text-xl font-bold mb-4">Modifier le Professeur</h2>
            <?php if (isset($errors['general'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <?= $errors['general'] ?>
                </div>
            <?php endif; ?>

            <form action="?controler=professeur&page=modifier&id=<?= $editId ?? '' ?>" method="POST">
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-2">
                        <label class="block">Nom :</label>
                        <input type="text" name="nom" class="w-full p-2 border rounded <?= isset($errors['nom']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['nom'] ?? '') ?>">
                        <?php if (isset($errors['nom'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['nom'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label class="block">Prenom :</label>
                        <input type="text" name="prenom" class="w-full p-2 border rounded <?= isset($errors['prenom']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['prenom'] ?? '') ?>">
                        <?php if (isset($errors['prenom'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['prenom'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-2">
                        <label class="block">Specialite :</label>
                        <input type="text" name="specialite" class="w-full p-2 border rounded <?= isset($errors['specialite']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['specialite'] ?? '') ?>">
                        <?php if (isset($errors['specialite'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['specialite'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label class="block">Grade :</label>
                        <input type="text" name="grade" class="w-full p-2 border rounded <?= isset($errors['grade']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['grade'] ?? '') ?>">
                        <?php if (isset($errors['grade'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['grade'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-2">
                        <label class="block">Email :</label>
                        <input type="email" name="email"
                            class="w-full p-2 border rounded <?= isset($errors['email']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['email'] ?? '') ?>">
                        <?php if (isset($errors['email'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['email'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label class="block">Mot de passe :</label>
                        <input type="password" name="password"
                            class="w-full p-2 border rounded <?= isset($errors['password']) ? 'border-red-500' : '' ?>"
                            placeholder="Laissez vide pour ne pas changer">
                        <?php if (isset($errors['password'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['password'] ?></p>
                        <?php endif; ?>
                    </div>
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
                    <a href="?controler=professeur&page=listeProfesseur" class="bg-gray-400 text-white px-4 py-2 rounded">
                        Annuler
                    </a>
                    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">
                        Modifier
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal pour afficher les classes -->
    <div id="view-classes-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 <?= isset($showClassesModal) && $showClassesModal ? '' : 'hidden' ?>">
        <div class="bg-white p-6 rounded-lg shadow-lg w-[50%] max-h-[80vh] flex flex-col">
        <h2 class="text-xl font-bold mb-4">Classes pour ce professeur </h2>
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
            <a href="?controler=professeur&page=listeProfesseur&page_num=<?= $currentPage ?><?= !empty($currentSearch) ? '&search=' . urlencode($currentSearch) : '' ?>" 
               class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition-colors">
                Fermer
            </a>
        </div>
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
            <?php if (empty($professeurs)): ?>
            <tr>
                <td colspan="5" class="text-center py-4">
                    Aucun résultat trouvé pour "<?= htmlspecialchars($currentSearch ?? '') ?>"
                </td>
            </tr>
        <?php else: ?>
                <?php foreach ($professeurs as $professeur) { ?>
                    <tr class="border-b">
                        <td><?= $professeur["nom"] ?></td>
                        <td><?= $professeur["prenom"] ?></td>
                        <td><?= $professeur["specialite"] ?></td>
                        <td><?= $professeur["grade"] ?></td>
                        <!-- Dans la partie tableau, modifiez la colonne Action -->
                        <td class="p-2 relative group">
                            <!-- Bouton "⋮" -->
                            <button class="p-2 rounded bg-gray-200 hover:bg-gray-300 transition-colors">⋮</button>

                            <!-- Menu déroulant -->
                            <div class="hidden group-hover:block absolute bg-white shadow-md rounded p-2 right-0 z-10 w-48 border border-gray-100">
                                <a href="?controler=professeur&page=listeProfesseur&show_edit_modal=1&edit_id=<?= $professeur['id_professeur'] ?>"
                                    class="block p-2 hover:bg-gray-100 rounded">✏️ Modifier</a>
                                    <a href="?controler=professeur&page=voirClasses&professeur_id=<?= $professeur['id_professeur'] ?>" 
                                    class="block p-2 hover:bg-gray-100 rounded">👀 Voir Classes</a>
                                <a href="#" class="block p-2 hover:bg-gray-100 rounded">📂 Archiver</a>
                            </div>
                        </td>

                    </tr>
                <?php } ?>
                 <?php endif; ?>
            </tbody>
        </table>
<!-- Pagination -->
<?php if ($totalProfesseur > $perPage): ?>
    <div class="flex justify-center mt-4">
        <div class="flex space-x-2">
            <?php if ($currentPage > 1): ?>
                <a href="?controler=professeur&page=listeProfesseur&page_num=<?= $currentPage - 1 ?><?= !empty($currentSearch) ? '&search=' . urlencode($currentSearch) : '' ?>"
                   class="px-4 py-2 border rounded hover:bg-gray-100">
                    Précédent
                </a>
            <?php endif; ?>

            <?php 
            $totalPages = ceil($totalProfesseur / $perPage);
            $startPage = max(1, $currentPage - 2);
            $endPage = min($totalPages, $currentPage + 2);
            
            for ($i = $startPage; $i <= $endPage; $i++): ?>
                <a href="?controler=professeur&page=listeProfesseur&page_num=<?= $i ?><?= !empty($currentSearch) ? '&search=' . urlencode($currentSearch) : '' ?>"
                   class="px-4 py-2 border rounded <?= $i == $currentPage ? 'bg-purple-600 text-white' : 'hover:bg-gray-100' ?>">
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
                <a href="?controler=professeur&page=listeProfesseur&page_num=<?= $currentPage + 1 ?><?= !empty($currentSearch) ? '&search=' . urlencode($currentSearch) : '' ?>"
                   class="px-4 py-2 border rounded hover:bg-gray-100">
                    Suivant
                </a>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
        
    </div>
</div>