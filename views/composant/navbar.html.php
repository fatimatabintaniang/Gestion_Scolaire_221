<!-- views/components/header.php -->
<header class="flex justify-between items-center bg-white shadow-md p-4 rounded-md">
    <!-- Barre de recherche -->
    <div class="relative w-1/3">
        <input type="text" placeholder="Rechercher..." class="border p-2 rounded-md w-full">
        <button class="absolute right-2 top-2 text-gray-500">🔍</button>
    </div>

    <!-- Profil utilisateur -->
    <div class="flex items-center space-x-3">
        <img src="https://img.freepik.com/photos-gratuite/avatar-androgyne-personne-queer-non-binaire_23-2151100279.jpg?ga=GA1.1.1421185707.1725292688&semt=ais_hybrid" alt="User" class="w-10 h-10 rounded-full">
        <div>
        <p class="text-gray-700 font-semibold">
            <?= $_SESSION["utilisateur"]["prenom"] ?? 'Utilisateur' ?>
            </p>
            <p class="text-gray-700 font-semibold">
                <?= $_SESSION["utilisateur"]["nom"] ?? 'Utilisateur' ?>
            </p>

        </div>
    </div>
</header>
