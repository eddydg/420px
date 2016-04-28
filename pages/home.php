<div id="content">
    <?php if ($Auth->isLogged()): ?>
        <h2>Bonjour <b><?php echo htmlspecialchars($_SESSION['Auth']['login']); ?><b></h2>
    <?php endif; ?>
    <?php $allImages = $ImageManager->getImages(); ?>
    <?php if (count($allImages) > 0): ?>
        <div class="image-gallery">
        <?php foreach ($allImages as $image): ?>
            <div class="image-box">
                <a href="<?php echo IMG_TARGET_FOLDER . $image->name; ?>" title="" data-gallery>
                    <img src="<?php echo IMG_TARGET_FOLDER . $image->name; ?>" alt="" />
                </a>
                <div class="details">
                    <span class="details-user-name">
                        <a href="index.php?p=imageManager&amp;user=<?php echo $image->user_id; ?>">
                            <?php echo htmlspecialchars($image->username); ?>
                        </a>
                    </span><br>
                    <!-- <span class="details-image-name"><?php echo htmlspecialchars($image->name); ?></span> -->
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        Aucune image n'a été publiée.;
    <?php endif; ?>

</div>
