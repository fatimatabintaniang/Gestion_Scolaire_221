<?php
require_once "../views/composant/header.php";
?>
<div class="container mt-5">
    <div class="card p-4 shadow">
        <h3 class="text-center">Ajouter une Commande</h3>
        <!-- form.commande.html.php -->
        <div class="card  shadow">
            <form class="form1 d-flex" method="GET">
            <input type="hidden" name="controler" value="commande">
            <input type="hidden" name="page" value="ajout">
                <input type="text" class="form-control me-2" placeholder="Rechercher par téléphone..." name="telephone" value="<?= isset($_GET['telephone']) ? $_GET['telephone'] : '' ?>">
                
                <button type="submit" class="btn btn-success" id="search">Rechercher</button>
                
            </form>
                <?php if (!empty($_SESSION['client'])): ?>
                    <h5 class="text-center text-primary">Client trouvé :</h5>
                    <div class="d-flex justify-content-center">
                        <span class="badge bg-secondary me-2"><?= htmlspecialchars($_SESSION['client']['nom']) ?></span>
                        <span class="badge bg-secondary"><?= htmlspecialchars($_SESSION['client']['prenom']) ?></span>

                    </div>
                <?php endif; ?>

        </div>

        <!-- Ajout Produits -->
        <div class="card p-4 shadow">

            <form action="<?= WEBROOB ?>?controler=commande&page=ajout&telephone=<?=isset($_GET['telephone']) ?$_GET['telephone']:""?>" method="post">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="telephone" class="form-label">Article</label>
                        <input type="text" class="form-control" id="article" name="article">
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
                    <?php if (isset($_SESSION['client']) && !empty($_SESSION['client'])): ?>

                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Ajouter</button>
                    </div>
                    <?php endif; ?>

                </div>
            </form>


           <div class="row">
           <table class="table table-bordered ">
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
                    <?php
                    $total = 0; // Initialisation du total

                    if (isset($_SESSION['produits']) && !empty($_SESSION['produits'])) {
                        foreach ($_SESSION['produits'] as $produit) {
                            $total += $produit['montant']; // Calcul du total des montants
                            echo "<tr>
                    <td>{$produit['article']}</td>
                    <td>{$produit['prix_unitaire']} FCFA</td>
                    <td>{$produit['quantite']}</td>
                    <td>{$produit['montant']} FCFA</td>
                    <td>
                        <a href='?controler=commande&page=ajout&remove=" . urlencode($produit['article']) . "' class='btn btn-danger btn-sm'>Supprimer</a>
                        <a href='?controler=commande&page=ajout&edit=" . urlencode($produit['article']) . "' class='btn btn-warning btn-sm'>Modifier</a>

                    </td>
                  </tr>";
                        } 
                      }
                    ?>
                </tbody>
               

            </table>
           </div>
            
            <div class="mt-3">
                <h4>Total: <span id="total"><?= $total ?></span> FCFA</h4>
            </div>
            <button type="submit" class="btn btn-success mt-3">Commander</button>
        </div>
    </div>
</div>


<?php
require_once "../views/composant/footer.php";
?>