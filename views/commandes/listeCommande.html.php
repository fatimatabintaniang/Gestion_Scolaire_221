<?php
require_once "../views/composant/header.php";
?>

<body>
    <div class="container mt-4">
        <div class="card shadow p-4">
            <div class="text-center fs-4 mb-4">Liste des Commandes</div>
            <div class="row mb-4">
                <?php if ($verif) : ?>
                    <div class="col-10">
                        <form class="form1" method="GET">
                            <input type="text" class="form-control" placeholder="Rechercher par téléphone..." name="telephone">
                            <input type="hidden" name="controler" value="commande">
                            <input type="hidden" name="page" value="commande">
                            <button type="submit" class="btn btn-success">Rechercher</button>
                        </form>
                    </div>
                <?php endif ?>
                <div class="col-2 text-end">
                <a href="<?= WEBROOB ?>?controler=commande&page=ajout" class="btn btn-success">Nouveau</a>

                </div>
            </div>
            <table class="table table-bordered table-striped table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Montant</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($commandes)) : ?>
                        <?php foreach ($commandes as $commande) : ?>
                            <tr>
                                <td><?= htmlspecialchars($commande['date']) ?></td>
                                <td><?= htmlspecialchars($commande['montant']) ?> FCFA</td>
                                <td><?= htmlspecialchars($commande['statut']) ?></td>
                                <td>
                                <a href="<?=WEBROOB?>?controler=commande&page=detail&id=<?= $commande['id'] ?>" class="btn btn-info">Voir Détails</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="3" class="text-danger">Aucune commande trouvée</td>
                            </t>
                        <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
    require_once "../views/composant/header.php";
    ?>