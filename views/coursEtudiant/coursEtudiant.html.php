<!-- Contenu Principal -->
<div class="flex-1 p-6 md:p-8 rounded-2xl bg-white shadow-xl">

    <!-- En-tête avec titre et boutons -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Emploi du temps</h2>
            <p class="text-gray-500 mt-1">Vos prochains cours programmés</p>
        </div>

        <div class="relative group">
            <button class="text-black shadow px-4 py-2 rounded bg-gray-200 hover:bg-gray-300 transition-colors">filtrer</button>
            <div class="hidden group-hover:block absolute bg-white shadow-md rounded p-2 right-0 z-10 border border-gray-100">

                <div class="flex space-x-3">
                    <form method="GET" class="flex items-center space-x-2">
                        <input type="hidden" name="controler" value="coursEtudiant">
                        <input type="hidden" name="page" value="coursEtudiant">

                        <div class="relative">
                            <input
                                type="search"
                                name="search"
                                placeholder="Filtrer par semestre (ex: S1, S2...)"
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
                            <a href="?controler=coursEtudiant&page=coursEtudiant" class="text-gray-600 hover:text-gray-800 flex items-center">
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
                        <a href="?controler=coursEtudiant&page=coursEtudiant" class="text-red-500 ml-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                            Effacer
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Liste des cours en cartes premium -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        <?php if (empty($coursEtudiants)): ?>
            <div class="col-span-full py-16 text-center animate-pulse">
                <div class="mx-auto w-28 h-28 rounded-full bg-gradient-to-br from-gray-100 to-gray-50 flex items-center justify-center mb-6 shadow-inner">
                    <i class="fas fa-calendar-alt text-4xl text-gray-300"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-700">Aucun cours programmé</h3>
                <p class="text-gray-400 mt-2">Votre emploi du temps apparaîtra ici</p>
            </div>
        <?php else: ?>
            <?php foreach ($coursEtudiants as $coursEtudiant): ?>
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
                                    <?= htmlspecialchars($coursEtudiant["semestre"] ?? 'Semestre') ?>
                                </span>
                                <h3 class="text-xl font-bold text-gray-800 group-hover:text-primary transition-colors duration-300">
                                    Cours <?= htmlspecialchars($coursEtudiant["module"] ?? 'Module') ?>
                                </h3>
                            </div>
                            <span class="bg-white shadow-md rounded-lg px-2.5 py-1 text-sm font-bold text-primary border border-gray-100">
                                <?= htmlspecialchars($coursEtudiant["nombre_heures"] ?? '0') ?>h
                            </span>
                        </div>

                        <!-- Date et heure -->
                        <div class="flex items-center mb-5 space-x-4">
                            <div class="flex items-center">
                                <i class="far fa-calendar text-gray-400 mr-2"></i>
                                <span class="text-sm font-medium text-gray-600">
                                    <?= htmlspecialchars($coursEtudiant["date"] ?? '--/--/----') ?>
                                </span>
                            </div>
                            <div class="flex items-center">
                                <i class="far fa-clock text-gray-400 mr-2"></i>
                                <span class="text-sm font-medium text-gray-600">
                                    <?= htmlspecialchars($coursEtudiant["heure_debut"] ?? '--:--') ?> - <?= htmlspecialchars($coursEtudiant["heure_fin"] ?? '--:--') ?>
                                </span>
                            </div>
                        </div>

                        <!-- Professeur -->
                        <div class="flex items-center p-3 bg-gray-50 rounded-lg group-hover:bg-primary/5 transition-colors duration-300">
                            <div class="relative">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-purple-100 to-blue-100 flex items-center justify-center shadow-inner">
                                    <span class="text-xl font-bold text-primary">
                                        <?= substr(htmlspecialchars($coursEtudiant["professeur"] ?? 'P'), 0, 1) ?>
                                    </span>
                                </div>
                                <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white"></span>
                            </div>
                            <div class="ml-4">
                                <h4 class="text-sm font-semibold text-gray-800">
                                    <?= htmlspecialchars($coursEtudiant["professeur"] ?? 'Professeur non assigné') ?>
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