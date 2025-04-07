<!-- Contenu Principal -->
<div class="flex-1 p-6 rounded shadow">

    <!-- Barre de recherche et bouton -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold mb-4">Liste des Classes</h2>
        <div class="space-x-3">
            <button class=" text-black shadow px-4 py-2 rounded">filtrer</button>
            <a href="?controler=classe&page=listeClasse&show_add_modal=1" class="bg-purple-600 text-white px-4 py-2 rounded">
                Nouveau
            </a>
        </div>
    </div>

<!-- Modale Ajout classe -->
<div id="add-course-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 
    <?= (isset($_GET['show_add_modal']) || (isset($_SESSION['errors']) && !empty($_SESSION['errors']))) ? '' : 'hidden' ?>">
    <div class="bg-white p-6 rounded-lg shadow-lg w-[30%]">
        <h2 class="text-xl font-bold mb-4">Ajouter une Classe</h2>
        <?php if (isset($_SESSION['errors']['general'])): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                <?= $_SESSION['errors']['general'] ?>
            </div>
        <?php endif; ?>

        <form action="<?= WEBROOB ?>?controler=classe&page=listeClasse" method="POST">
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

    <!-- Tableau -->
    <div class="bg-white text-black p-4 rounded-lg shadow">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr>
                    <th>Libelle</th>
                    <th>Filiere</th>
                    <th>Niveau</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($classes as $classe) { ?>
                    <tr class="border-b">
                        <td><?= $classe["libelle"] ?></td>
                        <td><?= $classe["filiere"] ?></td>
                        <td><?= $classe["niveau"] ?></td>
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