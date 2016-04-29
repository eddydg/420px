<?php

if (isset($_GET['edit_image'])): ?>
    <?php
    $imageId = $_GET['edit_image'];
    $image = $ImageManager->getImage($imageId);

    if ($image == NULL || $image->user_id != $_SESSION['Auth']['userId']) {
        die();
    }

    if (!file_exists(IMG_TARGET_FOLDER . 'temp/')) {
      mkdir(IMG_TARGET_FOLDER . 'temp/', 0777, true);
    }

    $tempImage = IMG_TARGET_FOLDER . 'temp/' . $image->name;
    if (isset($_GET['reset'])) {
        unlink($tempImage);
    } else if (isset($_GET['save'])) {
        rename($tempImage, IMG_TARGET_FOLDER . $image->name);
    }

    if (!file_exists($tempImage)) {
        copy(IMG_TARGET_FOLDER . $image->name, $tempImage);
    }

    if (isset($_GET['contrast'])) {
        $contrastValue = $_GET['contrast'];
        if ($contrastValue === "less") {
            ImageEditor::setContrast($tempImage, 50);
        } else if ($contrastValue === "more") {
            ImageEditor::setContrast($tempImage, -50);
        }
    } elseif (isset($_GET['brightness'])) {
        $brightnessValue = $_GET['brightness'];
        if ($brightnessValue === "less") {
            ImageEditor::setBrightness($tempImage, -50);
        } else if ($brightnessValue === "more") {
            ImageEditor::setBrightness($tempImage, 50);
        }
    } elseif (isset($_GET['sepia'])) {
        ImageEditor::setSepia($tempImage);
    } elseif (isset($_GET['desaturate'])) {
        ImageEditor::setDesaturate($tempImage);
    } elseif (isset($_GET['gauss'])) {
        ImageEditor::setGauss($tempImage);
    } elseif (isset($_GET['edges'])) {
        ImageEditor::setEdges($tempImage);
    }


    ?>

    <div class="editor">
        <div class="editor-image">
            <img src="<?php echo $tempImage; ?>" alt="">
        </div>
        <div class="editor-toolbar">
            <ul>
                <li>
                    <a href="?p=imageEditor&amp;edit_image=<?php echo $image->id; ?>&amp;contrast=less">-</a>
                        Contraste
                    <a href="?p=imageEditor&amp;edit_image=<?php echo $image->id; ?>&amp;contrast=more">+</a>
                </li>
                <li>
                    <a href="?p=imageEditor&amp;edit_image=<?php echo $image->id; ?>&amp;brightness=less">-</a>
                        Luminosité
                    <a href="?p=imageEditor&amp;edit_image=<?php echo $image->id; ?>&amp;brightness=more">+</a>
                </li>
                <li><a href="?p=imageEditor&amp;edit_image=<?php echo $image->id; ?>&amp;sepia">Sepia</a></li>
                <li><a href="?p=imageEditor&amp;edit_image=<?php echo $image->id; ?>&amp;desaturate">Niveau de gris</a></li>
                <li><a href="?p=imageEditor&amp;edit_image=<?php echo $image->id; ?>&amp;gauss">Filtre de Gauss</a></li>
                <li><a href="?p=imageEditor&amp;edit_image=<?php echo $image->id; ?>&amp;edges">Détection des contours</a></li>
                <li><a href="?p=imageEditor&amp;edit_image=<?php echo $image->id; ?>&amp;random">Aléatoire</a></li>
            </ul>

            <div class="editor-toolbar-actions">
                <a href="?p=imageEditor&amp;edit_image=<?php echo $image->id; ?>&amp;reset" class="btn btn-danger">Tout Annuler</a>
                <a href="?p=imageEditor&amp;edit_image=<?php echo $image->id; ?>&amp;save" class="btn btn-info">Enregistrer</a>
            </div>
        </div>

    </div>

    <div class="editor-palette">
        <?php
        /*
        $mainColors = ImageEditor::getMainColors($tempImage);
        foreach($mainColors as $color) {
            echo "<span class='palette-color' style='background-color: $color'><span>$color</span></span>";
        }
        */
        ?>
    </div>


<?php else: ?>
No image selected.

<?php endif; ?>
