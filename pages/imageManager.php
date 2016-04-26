<?php

if (isset($_FILES) && isset($_FILES['image'])) {
    $messageInfo = $ImageManager->uploadImage($_FILES['image'], $_SESSION['Auth']['userId']);
}
else if (isset($_GET['delete_image'])) {
    if ($ImageManager->deleteImage($_GET['delete_image'], $_SESSION['Auth']['userId']))
        $messageSuccess = "L'image a été supprimée.";
    else
        $messageError = "Vous n'êtes pas autorisé à supprimer cette image.";
}
?>

<div id="content">
    <form class="" method="post" enctype="multipart/form-data">
        <input type="file" name="image" value="">
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
</div>

<div class="image-gallery" id="links">

    <?php foreach ($ImageManager->getImages() as $image): ?>

    <div class="image-box">
        <a href="<?php echo IMG_TARGET_FOLDER . $image->name; ?>" title="" data-gallery>
            <img src="<?php echo IMG_TARGET_FOLDER . $image->name; ?>" alt=""><br>
            <a href="?p=imageManager&amp;delete_image=<?php echo $image->id; ?>">Supprimer</a>
        </a>
    </div>

    <?php endforeach; ?>
</div>
