

<!-- views/components/sidebar.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des propriétaires</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#7C3AED',
                        secondary: '#F59E0B',
                        accent: '#EC4899',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-100">

    <!-- Sidebar modernisée -->
    <aside class="w-[17%] bg-gradient-to-b from-accent to-accent-dark text-white flex flex-col p-5 rounded-r-xl shadow-xl border-r border-gray-200">
        <!-- Logo amélioré -->
        <div class="flex items-center justify-center mb-10">
            <div class="bg-white text-primary text-2xl font-bold rounded-xl w-14 h-14 flex items-center justify-center shadow-md hover:scale-105 transition-transform duration-300">
                GB
            </div>
        </div>

        <!-- Menu avec animations -->
        <nav class="mt-8 flex-1 space-y-2">
            <a href="<?=WEBROOB?>?controler=dashboard&page=dashboard" 
               class="flex items-center text-sm py-3 px-4 rounded-lg hover:bg-white/20 transition-all duration-300 group">
                <span class="mr-3 text-lg group-hover:text-secondary">📊</span> 
                <span class="font-medium group-hover:translate-x-1 transition-transform duration-300">Dashboard</span>
            </a>
            
            <a href="<?=WEBROOB?>?controler=cours&page=listeCours" 
               class="flex items-center text-sm py-3 px-4 rounded-lg hover:bg-white/20 transition-all duration-300 group">
                <span class="mr-3 text-lg group-hover:text-secondary">🏠</span>
                <span class="font-medium group-hover:translate-x-1 transition-transform duration-300">Liste des cours</span>
            </a>
            
            <a href="<?=WEBROOB?>?controler=professeur&page=listeProfesseur" 
               class="flex items-center text-sm py-3 px-4 rounded-lg hover:bg-white/20 transition-all duration-300 group">
                <span class="mr-3 text-lg group-hover:text-secondary">🏡</span>
                <span class="font-medium group-hover:translate-x-1 transition-transform duration-300">Liste des professeur</span>
            </a>

            <a href="<?=WEBROOB?>?controler=classe&page=listeClasse" 
               class="flex items-center text-sm py-3 px-4 rounded-lg hover:bg-white/20 transition-all duration-300 group">
                <span class="mr-3 text-lg group-hover:text-secondary">🏡</span>
                <span class="font-medium group-hover:translate-x-1 transition-transform duration-300">Liste des classes</span>
            </a>
        </nav>

        <!-- Bouton déconnexion modernisé -->
        <a href="<?=WEBROOB?>?controler=login&page=deconnexion" 
           class="mt-auto bg-white text-primary font-bold py-2.5 px-4 rounded-lg w-full text-center shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-0.5 flex items-center justify-center">
            <span class="mr-2">🚪</span> Déconnexion
        </a>
    </aside>

</body>

</html>