<div class="flex-1 p-6 rounded shadow">
    <!-- En-tête -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">
                Étudiants de la classe : <?= htmlspecialchars($classe['libelle']) ?>
            </h2>
            <p class="text-gray-500 mt-1"><?= count($etudiants) ?> étudiant(s) inscrit(s)</p>
        </div>
        <a href="?controler=classe&page=listeClasse" class="bg-gradient-to-r from-primary to-accent text-white px-4 py-2 rounded hover:bg-purple-700 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Retour
        </a>
    </div>

    <!-- Liste des étudiants en cartes -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php if (!empty($etudiants)): ?>
            <?php foreach ($etudiants as $etudiant): ?>
                <div class="relative bg-white rounded-xl overflow-hidden shadow-lg border border-gray-100 transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                    <!-- Bandeau coloré en haut -->
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-500 to-purple-600"></div>

                    <!-- Contenu de la carte -->
                    <div class="p-6 pt-8">
                        <!-- En-tête avec nom/prénom -->
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">
                                    <?= htmlspecialchars($etudiant['prenom'] . ' ' . $etudiant['nom']) ?>
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    <span class="inline-block px-2 py-1 bg-gray-100 rounded-full">
                                        <?= htmlspecialchars($etudiant['matricule']) ?>
                                    </span>
                                </p>
                            </div>
                            <!-- Avatar avec initiales -->
                            <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                                <?= substr($etudiant['prenom'], 0, 1) . substr($etudiant['nom'], 0, 1) ?>
                            </div>
                        </div>

                        <!-- Détails -->
                        <div class="space-y-3 mt-4">
                            <div class="flex items-start">
                                <i class="fas fa-envelope text-gray-400 mr-2 mt-1"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="text-gray-700 font-medium truncate"><?= htmlspecialchars($etudiant['email']) ?></p>
                                </div>
                            </div>
                            
                            <?php if (!empty($etudiant['adresse'])): ?>
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt text-gray-400 mr-2 mt-1"></i>
                                <div>
                                    <p class="text-sm text-gray-500">Adresse</p>
                                    <p class="text-gray-700 font-medium"><?= htmlspecialchars($etudiant['adresse']) ?></p>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-span-full py-16 text-center animate-pulse">
                <div class="mx-auto w-28 h-28 rounded-full bg-gradient-to-br from-gray-100 to-gray-50 flex items-center justify-center mb-6 shadow-inner">
                    <i class="fas fa-user-graduate text-4xl text-gray-300"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-700">Aucun étudiant trouvé</h3>
                <p class="text-gray-400 mt-2">Cette classe ne contient aucun étudiant pour le moment</p>
            </div>
        <?php endif; ?>
    </div>
</div>