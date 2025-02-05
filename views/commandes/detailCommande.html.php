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
                            <th>Nom</th>
                            <th>Référence</th>
                            <th>Prix</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produits as $produit) : ?>
                            <tr>
                                <td><?= htmlspecialchars($produit['nom']) ?></td>
                                <td><?= htmlspecialchars($produit['reference']) ?></td>
                                <td><?= htmlspecialchars($produit['prix']) ?> FCFA</td>
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
