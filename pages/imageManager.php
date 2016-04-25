<?php

$message = "";
if (isset($_FILES) && isset($_FILES['image']))
{
    $message = $ImageManager->uploadImage($_FILES['image'], $_SESSION["Auth"]["userId"]);
}

var_dump($message);



?>

<div id="content">
    <form class="" method="post" enctype="multipart/form-data">
        <input type="file" name="image" value="">
        <input type="submit" name="submit" value="Envoyer">
    </form>
</div>
