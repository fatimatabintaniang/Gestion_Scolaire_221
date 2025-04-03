<!-- Main Content -->
<main class="flex-1">
    <div class="flex justify-between items-center bg-gradient-to-b from-purple-400 to-purple-600 text-white p-6 rounded">
        <div>
            <h2 class="text-2xl font-semibold">Bienvenue dans l'interface , <?= $_SESSION["utilisateur"]["prenom"] ?? 'Utilisateur' ?></h2>
        </div>
        <div class="">
            <img src="../image/img1.png" class="w-[30%]" alt="">
        </div>
    </div>

    <!-- Statistiques -->
    <div class="grid grid-cols-3 gap-4 mt-6">
        <div class="p-4 bg-white rounded shadow-md flex items-center space-x-6">
            <p class="text-2xl font-bold bg-purple-700 p-2 text-white rounded"><?= isset($stats["total_inscription"]) ? htmlspecialchars($stats["total_etudiant"]) : 0 ?>
            </p>
            <p class="text-gray-500 text-xl">Nombre total 
            de d’etudiant inscrit</p>
        </div>
        <div class="p-4 bg-white rounded shadow-md flex items-center space-x-6">
            <p class="text-2xl font-bold bg-purple-700 p-2 text-white rounded">
            <?= isset($stats["total_classe"]) ? htmlspecialchars($stats["total_classe"]) : 0 ?>
            </p>
            <p class="text-gray-500 text-xl">Nombre total  
            de classe</p>
        </div>
        <div class="p-4 bg-white rounded shadow-md flex items-center space-x-6">
            <p class="text-2xl font-bold bg-purple-700 p-2 text-white rounded">
            <?= isset($stats["total_etudiant"]) ? htmlspecialchars($stats["total_etudiant"]) : 0 ?>
            </p>
            <p class="text-gray-500 text-xl">Nombre total 
            d'etudiant</p>
        </div>
    </div>

    <!-- Conteneur des graphiques -->
    <div class="grid grid-cols-2 gap-4 mt-6">
        <div class="space-y-2">
            <div>
            <h1>Réservations effectuées par mois</h1>
            </div>
            <div class=" bg-gradient-to-b from-purple-400 to-purple-600 text-white h-[40vh] p-3 rounded ">
                <canvas id="reservationsChart"></canvas>
            </div>
        </div>

        <div class="space-y-2">
        <h1>réservations validées vs en attente</h1>
        <div class=" bg-gradient-to-b from-purple-400 to-purple-600 text-white bg-white p-10  h-[40vh] rounded shadow-md">
            <canvas id="trafficChart" class=""></canvas>
        </div>
        </div>
      
    </div>

</main>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Graphique des réservations par mois
        var ctx1 = document.getElementById("reservationsChart").getContext("2d");
        var reservationsChart = new Chart(ctx1, {
            type: "bar",
            data: {
                labels: ["Jan", "Fév", "Mar", "Avr", "Mai", "Juin", "Juil", "Aout", "Sep", "Oct", "Nov", "Dev"],
                datasets: [{
                    label: "Réservations",
                    data: [12, 19, 3, 5, 2, 3, 10, 9, 30, 5, 6, 2], // Remplace avec tes vraies données
                    backgroundColor: "rgba(75, 192, 192, 0.5)",
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Graphique des trafics par localisation
        var ctx2 = document.getElementById("trafficChart").getContext("2d");
        var trafficChart = new Chart(ctx2, {
            type: "pie",
            data: {
                labels: ["Valider", "Attente"],
                datasets: [{
                    label: "Traffic",
                    data: [52.1, 22.8], // Remplace avec tes vraies données
                    backgroundColor: ["#ff6384", "#36a2eb"]
                }]
            },
            options: {
                responsive: true
            }
        });
    });
</script>