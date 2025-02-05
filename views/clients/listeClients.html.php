<?php
 require_once "../views/composant/header.php";
?>

<body>

    <!-- Contenu principal -->
    <div class="container mt-4">
        <div class="card shadow p-4">
            <div class="text-center fs-4 mb-4">Liste des Clients</div>

            <!-- Formulaire de recherche -->
            <div class="row mb-4">
                <div class="col-10">
                    <form class="form1" method="GET">
                        <input type="text" class="form-control" placeholder="Rechercher par téléphone..." name="telephone">
                        <button type="submit" class="btn btn-success">Rechercher</button>
                    </form>
                </div>
                <div class="col-2 text-end">
                    <!-- Bouton Nouveau -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="bi bi-person-plus"></i> Nouveau
                    </button>
                </div>
            </div>

            <!-- Tableau des clients -->
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clients as $client): ?>
                        <tr>
                            <td><?= htmlspecialchars($client['nom']); ?></td>
                            <td><?= htmlspecialchars($client['prenom']); ?></td>
                            <td><?= htmlspecialchars($client['telephone']); ?></td>
                            <td>
                
                                <a href="<?= WEBROOB ?>?controler=commande&page=commande&id=<?= htmlspecialchars($client['id']); ?>" class="btn btn-success btn-sm">
                                    Voir Commandes
                                </a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
           <!-- Pagination à droite -->
            <!-- <nav aria-label="Pagination">
                <ul class="pagination justify-content-end">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1"><</a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="#">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">></a>
                    </li>
                </ul>
            </nav> -->

        </div>
    </div>

    <!-- Modal Ajouter Nouveau Client -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Ajouter un Nouveau Client</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="controler.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nomClient" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nomClient" name="nom" placeholder="Entrez le nom">
                        </div>
                        <div class="mb-3">
                            <label for="prenomClient" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenomClient" name="prenom" placeholder="Entrez le prénom">
                        </div>
                        <div class="mb-3">
                            <label for="telephoneClient" class="form-label">Téléphone</label>
                            <input type="tel" class="form-control" id="telephoneClient" name="tel" placeholder="Entrez le numéro de téléphone">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" name="ajouterClient">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
 require_once "../views/composant/footer.php"
?>

