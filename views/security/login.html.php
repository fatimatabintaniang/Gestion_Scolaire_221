
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-lg flex max-w-4xl w-full space-x-10 rounded">
        <!-- Image Section -->
        <div class="w-1/2 ">
            <img src="https://img.freepik.com/photos-gratuite/nature-morte-livres-contre-technologie_23-2150062920.jpg?ga=GA1.1.1421185707.1725292688&semt=ais_hybrid"  class="rounded-lg object-cover w-[100%] h-[70vh]">
        </div>

        <!-- Form Section -->
        <div class="w-1/2 p-6 flex flex-col justify-center shadow-lg h-[70vh]">
            <h2 class="text-2xl font-bold mb-6 text-center">Connexion</h2>
            <form action="<?= WEBROOB ?>" method="post">
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Adresse Mail</label>
                    <div class="relative">
                        <input type="email" name="email" placeholder="Entrez votre adresse mail" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-purple-500">
                        <span class="absolute right-3 top-3 text-gray-500">✉️</span>
                    </div>
                    <?php if (isset($errors['email'])): ?>
                        <div class="text-red-500 text-sm"><?= $errors['email'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Password</label>
                    <input type="password" name="password" placeholder="Entrez votre mot de passe" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-purple-500">
                    <?php if (isset($errors['password'])): ?>
                        <div class="text-red-500 text-sm"><?= $errors['password'] ?></div>
                    <?php endif; ?>
                </div>
                <div>
                <input type="hidden" name="controller" value="login">
                <input type="hidden" name="page" value="login">
                <button type="submit" class="w-full bg-purple-500 text-white py-3 rounded-lg font-medium hover:bg-purple-600">Se connecter</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>