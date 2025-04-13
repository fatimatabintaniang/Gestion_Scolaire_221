<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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

<body class="flex items-center justify-center min-h-screen bg-gradient-to-br from-indigo-50 to-purple-50 p-4">
    <div class="flex max-w-5xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden" style="max-height: 90vh;">
        <!-- Image Section -->
        <div class="hidden md:block w-1/2 relative overflow-hidden" style="max-height: 90vh;">
            <div class="absolute inset-0 bg-gradient-to-br from-primary/80 to-accent/80"></div>
            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80" 
                 alt="Team working together"
                 class="w-full h-full object-cover object-center transform transition duration-700 hover:scale-105">
            <div class="absolute inset-0 flex items-end p-8">
                <div>
                    <h2 class="text-4xl font-bold text-white mb-2">Bienvenue !</h2>
                    <p class="text-lg text-white opacity-90">Votre aventure commence ici</p>
                    <div class="mt-4 h-1 w-20 bg-secondary rounded-full"></div>
                </div>
            </div>
        </div>

        <!-- Form Section -->
        <div class="w-full md:w-1/2 p-8 overflow-y-auto" style="max-height: 90vh;">
            <div class="text-center mb-8">
                <div class="mx-auto w-20 h-20 rounded-full bg-gradient-to-r from-primary to-accent flex items-center justify-center mb-4 hover:-translate-y-1 transition-transform duration-300 shadow-lg hover:shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916 13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118 6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364 0-1.457.39-2.823 1.07-4" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-primary to-accent bg-clip-text text-transparent">Connectez-vous</h1>
                <p class="text-gray-500 mt-2">Accédez à votre espace personnel</p>
            </div>

            <form action="<?= WEBROOB ?>" method="post" class="space-y-5">
                <input type="hidden" name="controller" value="login">
                <input type="hidden" name="page" value="login">
                
                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="far fa-envelope text-gray-400"></i>
                            </div>
                            <input id="email" name="email" type="email" placeholder="votre@email.com" 
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition duration-300 hover:border-primary/50">
                        </div>
                        <?php if (isset($errors['email'])): ?>
                            <p class="mt-2 text-xs text-red-500 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> <?= $errors['email'] ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-gray-400"></i>
                            </div>
                            <input id="password" name="password" type="password" placeholder="••••••••" 
                                class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-primary focus:border-primary transition duration-300 hover:border-primary/50">
                        </div>
                        <?php if (isset($errors['password'])): ?>
                            <p class="mt-2 text-xs text-red-500 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i> <?= $errors['password'] ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-primary focus:ring-primary border-gray-300 rounded">
                            <label for="remember-me" class="ml-2 block text-sm text-gray-700">Se souvenir de moi</label>
                        </div>
                        <a href="#" class="text-sm font-medium text-primary hover:text-primary/80 transition duration-300">
                            Mot de passe oublié?
                        </a>
                    </div>
                </div>

                <div>
                    <button type="submit" 
                        class="w-full flex justify-center items-center py-3 px-6 rounded-xl shadow-md hover:shadow-lg text-lg font-semibold text-white bg-gradient-to-r from-primary to-accent hover:from-primary/90 hover:to-accent/90 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary/50 transition-all duration-300 hover:-translate-y-0.5">
                        <i class="fas fa-sign-in-alt mr-2"></i> Se connecter
                    </button>
                </div>
            </form>

         
        </div>
    </div>
</body>

</html>