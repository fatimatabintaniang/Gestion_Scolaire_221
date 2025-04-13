
<!-- Main Content -->
<main class="flex-1 space-y-8 p-6 -mt-6">

    <div class="relative bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-3xl overflow-hidden shadow-2xl">
        <div class="absolute inset-0 bg-[url('https://patternico.com/5a5a5a/000000/pattern-15.svg')] opacity-10"></div>
        <div class="relative z-10 p-8 md:p-10 flex flex-col md:flex-row justify-between items-center">
            <div class="mb-6 md:mb-0">
                <h1 class="text-3xl md:text-4xl font-bold mb-2">Bienvenue, <span class="text-yellow-300"><?= htmlspecialchars($_SESSION["utilisateur"]["prenom"] ?? 'Utilisateur') ?></span></h1>
                <p class="text-purple-100 text-lg">Votre tableau de bord en temps réel</p>
                <div class="mt-4 flex space-x-3">
                    <div class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full flex items-center">
                        <i class="fas fa-calendar-day mr-2"></i>
                        <span id="current-date" class="text-sm font-medium"></span>
                    </div>
                </div>
            </div>
            <div class="animate-float">
                <img src="image/avatar.png" class="w-40 md:w-56" alt="Dashboard Illustration">
            </div>
        </div>
    </div>


    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transform transition-all hover:-translate-y-1 hover:shadow-2xl">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-cyan-400 to-blue-500"></div>
            <div class="p-6 flex items-start">
                <div class="bg-blue-100/20 p-3 rounded-lg mr-4">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white p-3 rounded-md">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Nombre total 
                    de d’etudiant</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">
                    <?= isset($stats["total_etudiant"]) ? htmlspecialchars($stats["total_etudiant"]) : 0 ?>
                    </p>
                    <div class="mt-2 flex items-center text-sm text-blue-600">
                        <i class="fas fa-arrow-up mr-1"></i>
                        <span>+12% ce mois</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Classes Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transform transition-all hover:-translate-y-1 hover:shadow-2xl">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-400 to-pink-500"></div>
            <div class="p-6 flex items-start">
                <div class="bg-purple-100/20 p-3 rounded-lg mr-4">
                    <div class="bg-gradient-to-br from-purple-500 to-pink-500 text-white p-3 rounded-md">
                        <i class="fas fa-chalkboard-teacher text-xl"></i>
                    </div>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Nombre total  
                    de  classes</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">
                    <?= isset($stats["total_classe"]) ? htmlspecialchars($stats["total_classe"]) : 0 ?>
                    </p>
                    <div class="mt-2 flex items-center text-sm text-purple-600">
                        <i class="fas fa-circle-notch fa-spin mr-1"></i>
                        <span>3 nouvelles cette semaine</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Registrations Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden transform transition-all hover:-translate-y-1 hover:shadow-2xl">
            <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-green-400 to-teal-500"></div>
            <div class="p-6 flex items-start">
                <div class="bg-green-100/20 p-3 rounded-lg mr-4">
                    <div class="bg-gradient-to-br from-green-500 to-teal-500 text-white p-3 rounded-md">
                        <i class="fas fa-user-edit text-xl"></i>
                    </div>
                </div>
                <div>
                    <p class="text-gray-500 text-sm font-medium">Nombre total 
                    de professeur</p>
                    <p class="text-3xl font-bold text-gray-800 mt-1">
                    <?= isset($stats["total_classe"]) ? htmlspecialchars($stats["total_professeur"]) : 0 ?>                    </p>
                    <div class="mt-2 flex items-center text-sm text-green-600">
                        <i class="fas fa-bolt mr-1"></i>
                        <span>Activité élevée</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

