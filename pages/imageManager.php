<?php

$message = "";
if (isset($_FILES) && isset($_FILES['image'])) {
    $message = $ImageManager->uploadImage($_FILES['image'], $_SESSION['Auth']['userId']);
}
else if (isset($_GET['delete_image'])) {
    if ($ImageManager->deleteImage($_GET['delete_image'], $_SESSION['Auth']['userId']))
        $message = "L'image a été supprimée.";
    else
        $message = "Vous n'êtes pas autorisé à supprimer cette image.";
}
?>

<pre>
    <?php echo $message; ?>
</pre>

<div id="content">
    <form class="" method="post" enctype="multipart/form-data">
        <input type="file" name="image" value="">
        <input type="submit" name="submit" value="Envoyer">
    </form>
</div>

<?php foreach ($ImageManager->getImages() as $image): ?>
    <img src="<?php echo IMG_TARGET_FOLDER . $image->name; ?>" alt="" />
    <a href="?p=imageManager&amp;delete_image=<?php echo $image->id; ?>">Supprimer</a>
    <br>
<?php endforeach; ?>
