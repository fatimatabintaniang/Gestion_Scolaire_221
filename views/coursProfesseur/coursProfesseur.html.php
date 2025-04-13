<!-- Contenu Principal -->
<div class="flex-1 p-6 md:p-8 rounded-2xl bg-white shadow-xl">

    <!-- En-tête avec titre et boutons - Fonctionnalités conservées -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Liste des Cours</h2>
            <p class="text-gray-500 mt-1">Cours du professeur</p>
        </div>
        
        <div class="flex space-x-3">
            <!-- Bouton Filtres (identique en fonctionnalité) -->
            <button class="flex items-center px-4 py-2.5 border border-gray-200 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <i class="fas fa-filter mr-2 text-primary"></i> Filtres
            </button>
            
        </div>
    </div>

    <!-- Liste des cours en cartes - Mêmes données et fonctionnalités -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 ">
        <?php if (empty($coursProfesseurs)): ?>
            <div class="col-span-full py-16 text-center animate-pulse">
                <div class="mx-auto w-28 h-28 rounded-full bg-gradient-to-br from-gray-100 to-gray-50 flex items-center justify-center mb-6 shadow-inner">
                    <i class="fas fa-chalkboard-teacher text-4xl text-gray-300"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-700">Aucun cours programmé</h3>
                <p class="text-gray-400 mt-2">Les cours apparaîtront ici</p>
            </div>
        <?php else: ?>
            <?php foreach ($coursProfesseurs as $coursProfesseur): ?>
                <div class="relative bg-white rounded-2xl overflow-hidden shadow-lg border transition-all duration-500 group transform hover:-translate-y-2 border border-gray-100 ">
                    <!-- Bandeau coloré neutre -->
                    <div class="absolute top-0 left-0 w-full h-2 text-white bg-gradient-to-r from-primary to-accent"></div>

                    <!-- Contenu principal -->
                    <div class="p-5 pt-6">
                        <!-- En-tête -->
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">
                                    <?= htmlspecialchars($coursProfesseur["date"] ?? 'Non défini') ?>
                                </h3>
                                <p class="text-sm text-gray-500 mt-1">
                                    <?= htmlspecialchars($coursProfesseur["semestre"] ?? 'Non défini') ?>
                                </p>
                            </div>
                            <span class="bg-gray-100 shadow-inner rounded-lg px-2.5 py-1 text-sm font-medium text-gray-700">
                                <?= htmlspecialchars($coursProfesseur["heure_debut"] ?? '--:--') ?>-<?= htmlspecialchars($coursProfesseur["heure_fin"] ?? '--:--') ?>
                            </span>
                        </div>

                        <!-- Classe -->
                        <div class="mb-4">
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                <?= htmlspecialchars($coursProfesseur["classe"] ?? 'Non assigné') ?>
                            </span>
                        </div>
                    </div>

                    <!-- Pied de carte avec menu identique -->
                    <div class="px-5 py-4 bg-gray-50 border-t border-gray-100 flex justify-end">
                        <div class="">
                            <button class="bg-purple-300 text-purple-800 p-1 rounded"><a href="view_etudiants.php?cours_id=# ?>">Voir Classe</a></button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>