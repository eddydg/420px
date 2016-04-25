<div id="content">
    <?php if ($Auth->isLogged()): ?>
        <?php foreach ($ImageManager->getImages() as $image): ?>
            <?php var_dump($image); ?>
            <img src="<?php echo IMG_TARGET_FOLDER . $image->name; ?>" alt="" />
        <?php endforeach; ?>
    <?php else: ?>
        Connectez-vous pour voir les images de tous les utilisateurs.
    <?php endif; ?>
</div>
