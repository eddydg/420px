<div id="content">
    <?php if ($Auth->isLogged()): ?>
        <h2>Bonjour <b><?php echo htmlspecialchars($_SESSION['Auth']['login']); ?><b></h2>
    <?php endif; ?>



    <?php
        $allImages;
        $searchKeywords = "";
        if (isset($_GET['q']) && $_GET['q'] != "") {
            $searchKeywords = $_GET['q'];
            $allImages = $ImageManager->findImages($searchKeywords);
        } else {
            $allImages = $ImageManager->getImages();
        }
    ?>

    <form>
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="#00FF00, 00FF00, Toto, ..." value="<?php echo htmlspecialchars($searchKeywords); ?>">
            <span class="input-group-btn">
                <button class="btn btn-info" type="submit">Chercher</button>
            </span>
        </div>
    </form>

    <?php if (count($allImages) > 0): ?>
        <div class="image-gallery">
        <?php foreach ($allImages as $image): ?>
            <div class="image-box">
                <a href="<?php echo IMG_TARGET_FOLDER . $image->name; ?>" title="" data-gallery>
                    <img src="<?php echo IMG_TARGET_FOLDER . $image->name; ?>" alt="" />
                </a>
                <div class="details">
                    <a href="?q=<?php echo $image->main_color;?>">
                        <span class='palette-color' style='width: 20px; height: 20px;background-color: #<?php echo $image->main_color;?>'>
                            <!--<span>#<?php echo $image->main_color;?></span>-->
                        </span>
                    </a>

                    <span class="details-user-name">
                        <a href="index.php?p=imageManager&amp;user=<?php echo $image->user_id; ?>">
                            <?php echo htmlspecialchars($image->username); ?>
                        </a>
                    </span>
                    <!-- <span class="details-image-name"><?php echo htmlspecialchars($image->name); ?></span> -->
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        Aucune image trouvée
    <?php endif; ?>

</div>
