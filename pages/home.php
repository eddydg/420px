<div id="content">
    <?php if ($Auth->isLogged()): ?>
        Bienvenue <b><?php echo $_SESSION['Auth']['login']; ?><b>
    <?php else: ?>
        Connectez-vous pour voir les images de tous les utilisateurs.
    <?php endif; ?>
</div>
