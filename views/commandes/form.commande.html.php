<?php
require_once "../views/composant/header.php";
?>
<div class="container mt-5">
    <div class="card p-4 shadow">
        <h3 class="text-center">Ajouter une Commande</h3>
        <!-- form.commande.html.php -->

        <form class="form1 d-flex" method="GET">
            <input type="text" class="form-control me-2" placeholder="Rechercher par téléphone..." name="telephone" value="<?= isset($_GET['telephone']) ? $_GET['telephone'] : '' ?>">
            <?php if (isset($errors['telephone'])): ?>
                <div class="text-danger"><?= $errors['telephone'] ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-success" name="search">Rechercher</button>
            <input type="hidden" name="controler" value="commande">
            <input type="hidden" name="page" value="ajout">
        </form>

        <?php if (!empty($client)): ?>
            <div class="mt-4">
                <h4>Client trouvé :</h4>
                <p><strong>Nom:</strong> <?= htmlspecialchars($client['nom']) ?></p>
                <p><strong>Téléphone:</strong> <?= htmlspecialchars($client['prenom']) ?></p>
            </div>
        <?php endif; ?>


        <!-- Ajout Produits -->
        <form action="<?= WEBROOB ?>?controler=commande&page=ajout" method="post">
            <div class="row mb-3">
                <div class="col-md-3">
                    <label for="telephone" class="form-label">Article</label>
                    <input type="text" class="form-control" id="telephone" name="telephone">
                    <?php if (isset($errors['article'])): ?>
                        <div class="text-danger"><?= $errors['article'] ?></div>
                    <?php endif; ?>

                </div>
                <div class="col-md-3">
                    <label for="nom" class="form-label">Prix unitaire</label>
                    <input type="text" class="form-control" id="prix_unitaire" name="prix_unitaire">
                    <?php if (isset($errors['prix_unitaire'])): ?>
                        <div class="text-danger"><?= $errors['prix_unitaire'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-3">
                    <label for="quantite" class="form-label">Quantite</label>
                    <input type="text" class="form-control" id="quantite" name="quantite">
                    <?php if (isset($errors['quantite'])): ?>
                        <div class="text-danger"><?= $errors['quantite'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Ajouter</button>
                </div>
            </div>
        </form>





        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Article</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Montant</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="table-body">
            </tbody>
        </table>
        <div class="col-3">
            <button type="button" class="btn btn-primary">Ajouter Produit</button>
        </div>
        <div class="mt-3">
            <h4>Total: <span id="total">0</span> FCFA</h4>
        </div>
        <button type="submit" class="btn btn-success mt-3">Commander</button>
    </div>
</div>


<?php
require_once "../views/composant/footer.php";
?>