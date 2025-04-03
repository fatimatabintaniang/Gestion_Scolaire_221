<!-- views/layout/security.layout.php -->
<div class="flex h-screen ">
    <?php require_once "../views/composant/sidebarAtt.html.php"; ?>
    
    <main class="flex-1 ">
        <?php require_once "../views/composant/navbar.html.php"; ?>
        <div class="mt-6 p-6">
            <?= $content; ?>
        </div>
    </main>
</div>
