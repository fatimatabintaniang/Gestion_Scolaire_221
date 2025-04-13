<!-- Contenu Principal -->
<div class="flex-1 p-6 md:p-8 rounded-2xl bg-white shadow-xl">

    <!-- En-tête avec titre et boutons -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Liste des Absences</h2>
            <p class="text-gray-500 mt-1">Gestion des absences étudiantes</p>
        </div>
        
        <div class="flex space-x-3">
            <button class="flex items-center px-4 py-2.5 border border-gray-200 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md">
                <i class="fas fa-sliders-h mr-2 text-primary"></i> Filtres
            </button>

        </div>
    </div>

    <!-- Liste des absences en cartes premium -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        <?php if (empty($absences)): ?>
            <div class="col-span-full py-16 text-center animate-pulse">
                <div class="mx-auto w-28 h-28 rounded-full bg-gradient-to-br from-gray-100 to-gray-50 flex items-center justify-center mb-6 shadow-inner">
                    <i class="fas fa-user-clock text-4xl text-gray-300"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-700">Aucune absence enregistrée</h3>
                <p class="text-gray-400 mt-2">Les absences apparaîtront ici</p>
            </div>
        <?php else: ?>
            <?php foreach ($absences as $absence): ?>
                <div class="relative bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 group transform hover:-translate-y-2 border border-gray-100">
                    <!-- Bandeau coloré -->
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-red-500 to-orange-500"></div>
                    
                    <!-- Statut -->
                    <div class="absolute top-3 right-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            Non justifiée
                        </span>
                    </div>

                    <!-- Contenu principal -->
                    <div class="p-5 pt-6">
                        <!-- En-tête -->
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-600 mb-2">
                                    Absence
                                </span>
                                <h3 class="text-xl font-bold text-gray-800 group-hover:text-primary transition-colors duration-300">
                                    <?= htmlspecialchars($absence["date"] ?? 'Date inconnue') ?>
                                </h3>
                            </div>
                            <span class="bg-white shadow-md rounded-lg px-2.5 py-1 text-sm font-bold text-primary border border-gray-100">
                                <?= htmlspecialchars($absence["heure_debut"] ?? '--:--') ?>-<?= htmlspecialchars($absence["heure_fin"] ?? '--:--') ?>
                            </span>
                        </div>

                        <!-- Détails -->
                        <div class="flex items-center mb-5 space-x-4">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-day text-gray-400 mr-2"></i>
                                <span class="text-sm font-medium text-gray-600">
                                    <?= htmlspecialchars($absence["semestre"] ?? 'Semestre inconnu') ?>
                                </span>
                            </div>
                        </div>

                        <!-- Professeur -->
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg group-hover:bg-primary/5 transition-colors duration-300">
                            <div class="relative">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-100 to-blue-100 flex items-center justify-center shadow-inner">
                                    <span class="text-xl font-bold text-primary">
                                        <?= substr(htmlspecialchars($absence["professeur"] ?? 'P'), 0, 1) ?>
                                    </span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-semibold text-gray-800">
                                    <?= htmlspecialchars($absence["professeur"] ?? 'Professeur non assigné') ?>
                                </h4>
                                <p class="text-xs text-gray-500">Cours manqué</p>
                            </div>
                        </div>
                    </div>

                    <!-- Pied de carte -->
                    <div class="px-5 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                        <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 flex items-center">
                            <i class="fas fa-exclamation-triangle mr-1 text-xs"></i> À justifier
                        </span>
                        <button class="px-3 py-1.5 rounded-lg bg-gradient-to-r from-primary to-accent text-white text-xs font-semibold shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-0.5">
                            Justifier <i class="fas fa-pen ml-1 text-xs"></i>
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>