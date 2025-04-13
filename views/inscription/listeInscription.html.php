<!-- Contenu Principal -->
<!-- <div class="flex-1 p-6 rounded shadow">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold mb-4">Liste des Etudiants inscrit</h2>
        <div class="space-x-3">
            <button class=" text-black shadow px-4 py-2 rounded">filtrer</button>
            <button class="bg-purple-600 text-white px-4 py-2 rounded">Nouveau</button>
        </div>
    </div>

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
</div> -->


<!-- Contenu Principal -->
<div class="flex-1 p-6 md:p-8 rounded-2xl bg-white shadow-xl">

    <!-- En-tête avec titre et boutons -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Emploi du temps</h2>
            <p class="text-gray-500 mt-1">Liste des Etudiants inscrit</p>
        </div>

        <div class="flex space-x-3">
            <button class="flex items-center px-4 py-2.5 border border-gray-200 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md">
                <i class="fas fa-sliders-h mr-2 text-primary"></i> Filtres
            </button>
            <a href="?controler=inscription&page=listeInscription&show_add_modal=1" class="bg-purple-600 text-white px-4 py-2 rounded bg-gradient-to-r from-primary to-accent">
                Nouveau
            </a>

        </div>
    </div>

    <!-- Modale Ajout cours -->
    <div id="add-course-modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 
        <?= (isset($_GET['show_add_modal']) || !empty($errors)) ? '' : 'hidden' ?>">
        <div class="bg-white p-6 rounded-lg shadow-lg w-[50%]">
            <h2 class="text-xl font-bold mb-4">Ajouter un inscription</h2>
            <?php if (isset($errors['general'])): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                    <?= $errors['general'] ?>
                </div>
            <?php endif; ?>

            <form action="<?= WEBROOB ?>?controler=inscription&page=listeInscription" method="POST">
                <input type="hidden" name="action" value="add_inscription">
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-2">
                        <label class="block">nom :</label>
                        <input type="nom" name="nom" class="w-full p-2 border rounded <?= isset($errors['nom']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['nom'] ?? '') ?>">
                        <?php if (isset($errors['nom'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['nom'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label class="block">prenom :</label>
                        <input type="prenom" name="prenom" class="w-full p-2 border rounded <?= isset($errors['prenom']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['prenom'] ?? '') ?>">
                        <?php if (isset($errors['prenom'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['prenom'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-2">
                        <label class="block">email :</label>
                        <input type="email" name="email" class="w-full p-2 border rounded <?= isset($errors['email']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['email'] ?? '') ?>">
                        <?php if (isset($errors['email'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['email'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label class="block">matricule :</label>
                        <input type="matricule" name="matricule" class="w-full p-2 border rounded <?= isset($errors['matricule']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['matricule'] ?? '') ?>">
                        <?php if (isset($errors['matricule'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['matricule'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="mb-2">
                        <label class="block">adresse :</label>
                        <input type="adresse" name="adresse" class="w-full p-2 border rounded <?= isset($errors['adresse']) ? 'border-red-500' : '' ?>"
                            value="<?= htmlspecialchars($formData['adresse'] ?? '') ?>">
                        <?php if (isset($errors['adresse'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['adresse'] ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-2">
                        <label class="block">Classe :</label>
                        <select name="classe" class="w-full p-2 border rounded <?= isset($errors['classe']) ? 'border-red-500' : '' ?>">
                            <option value="">Sélectionner une classe</option>
                            <?php foreach ($classes as $classe): ?>
                                <option value="<?= $classe['id_classe'] ?>" <?= (isset($formData['classe']) && $formData['classe'] == $classe['id_classe']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($classe['libelle']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?php if (isset($errors['classe'])): ?>
                            <p class="text-red-500 text-sm"><?= $errors['classe'] ?></p>
                        <?php endif; ?>
                    </div>
                </div>



                <div class="flex justify-end space-x-2">
                    <a href="?controler=inscription&page=listeInscription" class="bg-gray-400 text-white px-4 py-2 rounded">
                        Annuler
                    </a>
                    <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded">
                        Ajouter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Liste des cours en cartes premium -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        <?php if (empty($inscriptions)): ?>
            <div class="col-span-full py-16 text-center animate-pulse">
                <div class="mx-auto w-28 h-28 rounded-full bg-gradient-to-br from-gray-100 to-gray-50 flex items-center justify-center mb-6 shadow-inner">
                    <i class="fas fa-calendar-alt text-4xl text-gray-300"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-700">Aucun etudiant inscrit</h3>
                <p class="text-gray-400 mt-2">les inscrit apparaîtra ici</p>
            </div>


        <?php else: ?>
            <?php foreach ($inscriptions as $inscription): ?>
                <div class="relative bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 group transform hover:-translate-y-2 border border-gray-100">
                    <!-- Effet de vague animé -->
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-primary to-accent"></div>

                    <!-- Indicateur de statut -->
                    <div class="absolute top-3 right-3">
                        <span class="relative flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                        </span>
                    </div>

                    <!-- Contenu principal -->
                    <div class="p-5 pt-6">
                        <!-- En-tête -->
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-primary/10 text-primary mb-2">
                                    <?= htmlspecialchars($inscription["nom"] ?? 'Non definit') ?>
                                </span>
                                <h3 class="text-sm font-bold text-gray-800 group-hover:text-primary transition-colors duration-300">
                                    Adresse <?= htmlspecialchars($inscription["adresse"] ?? 'Non definit') ?>
                                </h3>
                            </div>


                            <div class="">
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-primary/10 text-primary mb-2">
                                    <?= htmlspecialchars($inscription["prenom"] ?? 'Non definit') ?>
                                </span>
                                <h3 class=" text-sm font-bold text-gray-800 group-hover:text-primary transition-colors duration-300">
                                    libelle <?= htmlspecialchars($inscription["libelle"] ?? 'Non definit') ?>
                                </h3>
                            </div>



                            <span class="bg-white shadow-md rounded-lg px-2.5 py-1 text-sm font-bold text-primary border border-gray-100">
                                <?= htmlspecialchars($inscription["matricule"] ?? 'Non definit') ?>
                            </span>
                        </div>

                        <!-- Professeur -->
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg group-hover:bg-primary/5 transition-colors duration-300">

                            <div class="ml-4">
                                <h4 class="text-sm font-semibold text-gray-800">
                                    <?= htmlspecialchars($inscription["email"] ?? ' non assigné') ?>
                                </h4>
                                <p class="text-xs text-gray-500">Intervenant</p>
                            </div>
                        </div>
                    </div>

                    <!-- Pied de carte -->
                    <div class="px-5 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                        <div class="flex space-x-2">
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 flex items-center">
                                <i class="fas fa-book-open mr-1 text-xs"></i> Cours
                            </span>
                            <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 flex items-center">
                                <i class="fas fa-university mr-1 text-xs"></i> Présentiel
                            </span>
                        </div>
                        <button class="text-sm font-medium text-primary hover:text-primary-dark transition-colors duration-300 flex items-center">
                            Détails <i class="fas fa-chevron-right ml-1 text-xs"></i>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>