<?php
require_once "../views/composant/header.php";
?>

<body>
    
    <div class="container mt-4">
        <div class="card shadow p-4">

            <?php if (isset($commandeDetail)) : ?>
            <?php else : ?>
                <p class="text-danger">Aucune commande trouvée.</p>
            <?php endif; ?>

            <h3 class="mt-4">Details Produit</h3>
            <?php if (!empty($produits)) : ?>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Article</th>
                            <th>Référence</th>
                            <th>Prix_unitaire</th>
                            <th>Quantite</th>
                            <th>Montant</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produits as $produit) : ?>
                            <tr>
                                <td><?= htmlspecialchars($produit['article']) ?></td>
                                <td><?= htmlspecialchars($produit['reference']) ?></td>
                                <td><?= htmlspecialchars($produit['prix_unitaire']) ?></td>
                                <td><?= htmlspecialchars($produit['quantite']) ?></td>
                                <td><?= htmlspecialchars($produit['montant']) ?></td>


                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <p class="text-danger">Aucun produit associé à cette commande.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php require_once "../views/composant/footer.php"; ?>
</body>
