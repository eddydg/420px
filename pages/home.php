<div id="content">
    <?php if ($Auth->isLogged()): ?>
        <h2>Bienvenue <b><?php echo htmlspecialchars($_SESSION['Auth']['login']); ?><b> !</h2>
        <br>
    <?php endif; ?>
    <?php
    $allImages = $ImageManager->getImages();
    if (count($allImages) > 0) {
      foreach ($allImages as $image) {
          echo "<img src='" . IMG_TARGET_FOLDER . $image->name . "' alt='' />";
      }
    } else {
      echo "Aucune image n'a été publiée.";
    }
    ?>

</div>
