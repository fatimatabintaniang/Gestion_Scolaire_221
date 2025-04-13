<!-- Contenu Principal -->
<div class="flex-1 p-6 md:p-8 rounded-2xl bg-white shadow-xl">

    <!-- En-tête avec titre et boutons -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <h2 class="text-3xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Justifications d'absence</h2>
            <p class="text-gray-500 mt-1">Historique des justifications soumises</p>
        </div>
        
        <div class="flex space-x-3">
            <button class="flex items-center px-4 py-2.5 border border-gray-200 rounded-xl shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md">
                <i class="fas fa-filter mr-2 text-primary"></i> Filtres
            </button>
        </div>
    </div>

    <!-- Liste des justifications en cartes premium -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        <?php if (empty($justifications)): ?>
            <div class="col-span-full py-16 text-center animate-pulse">
                <div class="mx-auto w-28 h-28 rounded-full bg-gradient-to-br from-gray-100 to-gray-50 flex items-center justify-center mb-6 shadow-inner">
                    <i class="fas fa-file-signature text-4xl text-gray-300"></i>
                </div>
                <h3 class="text-xl font-medium text-gray-700">Aucune justification</h3>
                <p class="text-gray-400 mt-2">Les justifications apparaîtront ici</p>
            </div>
        <?php else: ?>
            <?php foreach ($justifications as $justification): ?>
                <div class="relative bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 group transform hover:-translate-y-2 border border-gray-100">
                    <!-- Bandeau coloré selon l'état -->
                    <div class="absolute top-0 left-0 w-full h-2 
                        <?= $justification["etat"] === 'Validé' ? 'bg-gradient-to-r from-green-500 to-emerald-500' : 
                             ($justification["etat"] === 'En attente' ? 'bg-gradient-to-r from-yellow-500 to-amber-500' : 'bg-gradient-to-r from-red-500 to-orange-500') ?>">
                    </div>
                    
                    <!-- Date -->
                    <div class="p-5 pt-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full 
                                    <?= $justification["etat"] === 'Validé' ? 'bg-green-100 text-green-800' : 
                                         ($justification["etat"] === 'En attente' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') ?>">
                                    <?= htmlspecialchars($justification["etat"]) ?>
                                </span>
                                <h3 class="text-xl font-bold text-gray-800 mt-2">
                                    <?= htmlspecialchars($justification["date"]) ?>
                                </h3>
                            </div>
                            <span class="bg-white shadow-md rounded-lg px-2.5 py-1 text-sm font-bold text-primary border border-gray-100">
                                <i class="far fa-calendar mr-1"></i> Date
                            </span>
                        </div>

                        <!-- Motif -->
                        <div class="mb-5">
                            <h4 class="text-sm font-medium text-gray-500 mb-1">Motif :</h4>
                            <p class="text-gray-700 line-clamp-3">
                                <?= htmlspecialchars($justification["motif"]) ?>
                            </p>
                        </div>

                        <!-- Actions -->
                        <div class="flex space-x-3">
                            <?php if ($justification["etat"] === 'En attente'): ?>
                                <button class="flex-1 px-3 py-2 rounded-lg bg-gradient-to-r from-primary to-accent text-white text-sm font-semibold shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-0.5">
                                    <i class="fas fa-edit mr-1"></i> Modifier
                                </button>
                            <?php endif; ?>
                            
                            <button class="flex-1 px-3 py-2 rounded-lg border border-gray-200 bg-white text-gray-700 text-sm font-semibold shadow-sm hover:shadow-md transition-all duration-300 hover:-translate-y-0.5">
                                <i class="fas fa-eye mr-1"></i> Détails
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>