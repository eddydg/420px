<?php

$currentUserId = 0;

if (isset($_GET['user'])) {
  $currentUserId = $_GET['user'];
} elseif ($isLogged) {
  $currentUserId = $_SESSION['Auth']['userId'];
} else {
  die();
}

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
        <div class="form-group" style="margin: auto; width: 600px; text-align: center;">
            <label class="control-label">Select File</label>
            <input type="file" name="image" class="form-control file" data-allowed-file-extensions='["jpg", "jpeg", "gif", "png"]'>
            <!-- <button type="submit" class="btn btn-primary form-control">Envoyer</button> -->
        </div>
    </form>
</div>

<div class="image-gallery" id="links">

    <?php foreach ($ImageManager->getImages($currentUserId) as $image): ?>

    <div class="image-box">
        <a href="<?php echo IMG_TARGET_FOLDER . $image->name; ?>" title="" data-gallery>
            <img src="<?php echo IMG_TARGET_FOLDER . $image->name; ?>" alt=""><br>
            <?php if ($isLogged): ?>
                <a class="delete-image-btn" href="?p=imageManager&amp;delete_image=<?php echo $image->id; ?>">Supprimer</a>
            <?php endif; ?>
        </a>
        <div class="details">
            <span class="details-user-name"><?php echo htmlspecialchars($image->username); ?></span><br>
            <!-- <span class="details-image-name"><?php echo htmlspecialchars($image->name); ?></span> -->
        </div>
    </div>

    <?php endforeach; ?>
</div>
