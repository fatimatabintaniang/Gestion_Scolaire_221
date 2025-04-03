<!-- views/components/sidebar.php -->
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des propriétaires</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="bg-gray-100">

    <!-- Sidebar -->
    <aside class="w-[17%] bg-gradient-to-b from-purple-400 to-purple-600 text-white flex flex-col p-5 rounded">
        <!-- Logo -->
        <div class="flex items-center justify-center">
            <div class="bg-white text-purple-600 text-3xl font-bold rounded w-16 h-16 p-10 flex items-center justify-center">
                GB
            </div>
        </div>

        <!-- Menu -->
        <nav class="mt-16 flex-1 space-y-3">
            <a href="<?=WEBROOB?>?controler=dashboard&page=dashboard" class="flex items-center text-sm py-3 px-4 rounded-lg hover:bg-white hover:bg-opacity-20 transition">
                <span class="mr-2">📊</span> Dashboard
            </a>
            <a href="<?=WEBROOB?>?controler=cours&page=listeCours" class="flex items-center text-sm py-3 px-4 hover:bg-white hover:bg-opacity-20  rounded-lg">
                <span class="mr-2">🏠</span> Liste des cours
            </a>
            <a href="<?=WEBROOB?>?controler=professeur&page=listeProfesseur" class="flex items-center text-sm py-3 px-4 rounded-lg hover:bg-white hover:bg-opacity-20 transition">
                <span class="mr-2">🏡</span> Liste des professeurs
            </a>
            <a href="<?=WEBROOB?>?controler=classe&page=listeClasse" class="flex items-center text-sm py-3 px-4 rounded-lg hover:bg-white hover:bg-opacity-20 transition">
                <span class="mr-2">🔖</span>Liste des classes
            </a>
        </nav>

        <!-- Déconnexion -->
        <a href="<?=WEBROOB?>?controler=login&page=deconnexion" class="mt-auto bg-white text-purple-600 font-bold py-2 px-4 rounded-md w-full text-center">🚪 Déconnexion</a>
    </aside>

</body>

</html>