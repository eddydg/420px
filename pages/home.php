<div id="content">
    <?php if ($Auth->isLogged()): ?>
        <h2>Bienvenue <b><?php echo htmlspecialchars($_SESSION['Auth']['login']); ?><b> !</h2>
    <?php endif; ?>
    <br>
    <?php foreach ($ImageManager->getImages() as $image): ?>
        <img src="<?php echo IMG_TARGET_FOLDER . $image->name; ?>" alt="" />
    <?php endforeach; ?>
</div>
