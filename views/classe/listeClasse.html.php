<!-- Contenu Principal -->
<div class="flex-1 p-6 rounded shadow">

    <!-- Barre de recherche et bouton -->
    <div class="flex justify-between items-center mb-4">
    <div>
            <h2 class="text-3xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Liste des Classes</h2>
            <p class="text-gray-500 mt-1">Liste des classes</p>
        </div>

        <div class="flex space-x-3">
            <div class="relative group">
                <button class="text-black shadow px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 transition-colors">filtrer</button>
                <div class="hidden group-hover:block absolute bg-white shadow-md rounded p-2 right-0 z-10 border border-gray-100">

                    <div class="flex space-x-3">
                        <form method="GET" class="flex items-center space-x-2">
                            <input type="hidden" name="controler" value="classe">
                            <input type="hidden" name="page" value="listeClasse">

                            <div class="relative">
                                <input
                                    type="search"
                                    name="search"
                                    placeholder="Rechercher par filière ou niveau..."
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
                                <a href="?controler=classe&page=listeClasse" class="text-gray-600 hover:text-gray-800 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                    Effacer
                                </a>
                            <?php endif; ?>
                        </form>
                    </div>

                    <?php if (!empty($currentSearch)): ?>
                        <div class="mb-4 p-3 bg-gray-100 rounded flex items-center">
                            <span class="font-medium mr-2">Résultats pour :</span>
                            <span class="bg-gray-200 px-3 py-1 rounded-full text-sm">
                                "<?= htmlspecialchars($currentSearch) ?>"
                            </span>
                            <a href="?controler=classe&page=listeClasse" class="text-red-500 ml-3 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                                Effacer
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <a href="?controler=classe&page=listeClasse&show_add_modal=1" class="bg-gradient-to-r from-primary to-accent text-white px-4 py-2 rounded hover:bg-purple-700">
                Nouveau
            </a>
        </div>
    </div>

    <!-- Modale Ajout classe -->
    <div id="add-course-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50
    <?= (isset($_GET['show_add_modal']) || (isset($_SESSION['errors']) && !empty($_SESSION['errors']))) ? '' : 'hidden' ?>">
        <div class="bg-white p-6 rounded-lg shadow-lg w-[30%]">
            <h2 class="text-xl font-bold mb-4">Ajouter une Classe</h2>
            <?php if (isset($_SESSION['errors']['general'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <?= $_SESSION['errors']['general'] ?>
                </div>
            <?php endif; ?>

            <form action="?controler=classe&page=ajouter" method="POST">
                <div class="grid grid-cols-1 gap-4">
                    <div class="mb-2">
                        <label class="block">Libelle :</label>
                        <input type="text" name="libelle" class="w-full p-2 border rounded <?= isset($_SESSION['errors']['libelle']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($_SESSION['formData']['libelle'] ?? '') ?>">
                        <?php if (isset($_SESSION['errors']['libelle'])): ?>
                            <p class="text-red-500 text-sm"><?= $_SESSION['errors']['libelle'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label class="block">Filiere :</label>
                        <input type="text" name="filiere" class="w-full p-2 border rounded <?= isset($_SESSION['errors']['filiere']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($_SESSION['formData']['filiere'] ?? '') ?>">
                        <?php if (isset($_SESSION['errors']['filiere'])): ?>
                            <p class="text-red-500 text-sm"><?= $_SESSION['errors']['filiere'] ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-2">
                        <label class="block">Niveau :</label>
                        <input type="text" name="niveau" class="w-full p-2 border rounded <?= isset($_SESSION['errors']['niveau']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($_SESSION['formData']['niveau'] ?? '') ?>">
                        <?php if (isset($_SESSION['errors']['niveau'])): ?>
                            <p class="text-red-500 text-sm"><?= $_SESSION['errors']['niveau'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="flex justify-end space-x-2 mt-3">
                    <a href="?controler=classe&page=listeClasse" class="bg-gray-400 text-white px-4 py-2 rounded">
                        Annuler
                    </a>
                    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">
                        Ajouter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modale d'édition -->
    <div id="edit-course-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 <?= $show_edit_modal ? '' : 'hidden' ?>">
        <div class="bg-white p-6 rounded-lg shadow-lg w-[30%]">
            <h2 class="text-xl font-bold mb-4">Modifier la Classe</h2>
            <?php if (isset($_SESSION['errors']['general'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <?= $_SESSION['errors']['general'] ?>
                </div>
            <?php endif; ?>

            <form action="?controler=classe&page=update" method="POST">
                <input type="hidden" name="id" value="<?= $editClasse['id_classe'] ?? '' ?>">
                <div class="grid grid-cols-1 gap-4">
                    <div class="mb-2">
                        <label class="block">Libelle :</label>
                        <input type="text" name="libelle" class="w-full p-2 border rounded <?= isset($_SESSION['errors']['libelle']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($editClasse['libelle'] ?? ($_SESSION['formData']['libelle'] ?? '')) ?>">
                        <?php if (isset($_SESSION['errors']['libelle'])): ?>
                            <p class="text-red-500 text-sm"><?= $_SESSION['errors']['libelle'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label class="block">Filiere :</label>
                        <input type="text" name="filiere" class="w-full p-2 border rounded <?= isset($_SESSION['errors']['filiere']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($editClasse['filiere'] ?? ($_SESSION['formData']['filiere'] ?? '')) ?>">
                        <?php if (isset($_SESSION['errors']['filiere'])): ?>
                            <p class="text-red-500 text-sm"><?= $_SESSION['errors']['filiere'] ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="mb-2">
                        <label class="block">Niveau :</label>
                        <input type="text" name="niveau" class="w-full p-2 border rounded <?= isset($_SESSION['errors']['niveau']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($editClasse['niveau'] ?? ($_SESSION['formData']['niveau'] ?? '')) ?>">
                        <?php if (isset($_SESSION['errors']['niveau'])): ?>
                            <p class="text-red-500 text-sm"><?= $_SESSION['errors']['niveau'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="flex justify-end space-x-2 mt-3">
                    <a href="?controler=classe&page=listeClasse" class="bg-gray-400 text-white px-4 py-2 rounded">
                        Annuler
                    </a>
                    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">
                        Modifier
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de confirmation d'archivage -->
    <div id="archive-confirm-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 <?= $showArchiveModal ? '' : 'hidden' ?>">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-bold mb-4">Confirmer l'archivage</h2>
            <p class="mb-6">Êtes-vous sûr de vouloir archiver cette classe ?</p>

            <div class="flex justify-end space-x-3">
                <a href="?controler=classe&page=listeClasse"
                    class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                    Annuler
                </a>
                <a href="?controler=classe&page=archiver&id=<?= $archiveId ?>&confirm=yes"
                    class="bg-yellow-600 text-white px-4 py-2 rounded hover:bg-yellow-700">
                    Confirmer
                </a>
            </div>
        </div>
    </div>

    <!-- Liste des classes en cartes -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (empty($classes)): ?>
            <div class="col-span-full py-16 text-center animate-pulse">
                <div class="mx-auto w-28 h-28 rounded-full bg-gradient-to-br from-gray-100 to-gray-50 flex items-center justify-center mb-6 shadow-inner">
                    <i class="fas fa-school text-4xl text-gray-300"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-700">Aucune classe trouvée</h3>
                <p class="text-gray-400 mt-2"><?= !empty($currentSearch) ? 'Aucun résultat pour "' . htmlspecialchars($currentSearch) . '"' : 'Les classes apparaîtront ici' ?></p>
            </div>
        <?php else: ?>
            <?php foreach ($classes as $classe): ?>
                <div class="relative bg-white rounded-xl overflow-hidden shadow-lg border border-gray-100 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <!-- Bandeau coloré en haut -->
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-500 to-purple-600"></div>

                    <!-- Contenu de la carte -->
                    <div class="p-6 pt-8">
                        <!-- En-tête avec libellé -->
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">
                                    <?= htmlspecialchars($classe["libelle"]) ?>
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    ID: <?= htmlspecialchars($classe["id_classe"]) ?>
                                </p>
                            </div>
                            <!-- Icône de classe -->
                            <div class="w-12 h-12 rounded-full bg-purple-100 flex items-center justify-center">
                                <i class="fas fa-chalkboard-teacher text-purple-600"></i>
                            </div>
                        </div>

                        <!-- Détails -->
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-graduation-cap text-gray-400 mr-2 w-5"></i>
                                <span class="text-gray-700"><?= htmlspecialchars($classe["filiere"]) ?></span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-layer-group text-gray-400 mr-2 w-5"></i>
                                <span class="text-gray-700">Niveau: <?= htmlspecialchars($classe["niveau"]) ?></span>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="mt-6 pt-4 border-t border-gray-100 flex justify-between items-center">
                            <a href="?controler=classe&page=voirEtudiants&id_classe=<?= $classe['id_classe'] ?>"
                               class="text-purple-600 text-sm hover:text-purple-800 flex items-center">
                               <i class="fas fa-users mr-1"></i> Étudiants
                            </a>

                            <a href="?controler=classe&page=modifier&id=<?= $classe['id_classe'] ?>"
                                        class="block px-3 py-2 hover:bg-gray-100 rounded text-sm text-left">
                                        <i class="fas fa-edit mr-2 text-blue-500"></i> Modifier
                                    </a>

                                    <a href="?controler=classe&page=archiver&id=<?= $classe['id_classe'] ?>"
                                        class="block px-3 py-2 hover:bg-gray-100 rounded text-sm text-left text-yellow-600">
                                        <i class="fas fa-archive mr-2"></i> Archiver
                                    </a>
                            
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>