<?php
require_once("config.php");
require_once("lib/Database.php");
require_once("lib/Auth.php");
require_once("lib/ImageManager.php");
require_once("lib/SimpleImage.php");

session_start();
var_dump($_SESSION);

$db = Database::getDB();
$Auth = new Auth($db);
$ImageManager = new ImageManager($db);

$page = "home";
if (isset($_GET["p"])) {
    if  (file_exists("pages/" . $_GET["p"] . ".php")) {
        $page = $_GET["p"];

        if ($page == "imageManager" && !$Auth->isLogged())
            header('Location: index.php');
        elseif ($page = "rssFeed")
            header('Location: rssFeed.php');
    }

    else
        $page = "404";
}



if ($Auth->isLogged()) {
    if ($page == "login")
        header('Location: index.php');
    echo "Vous êtes connecté";
} else {
    echo "Vous n'êtes pas connecté";
}

?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <title>420px</title>
    </head>
    <body>
        <nav>
            <?php if ($Auth->isLogged()): ?>
                <a href="?p=logout">Se déconnecter</a>
            <?php else: ?>
                <a href="?p=login">Se connecter</a>
                <a href="?p=register">Créer un compte</a>
            <?php endif; ?>
            <a href="?p=imageManager">Images</a>
        </nav>
        <div id="page">
            <?php include_once("pages/" . $page . ".php"); ?>
        </div>
    </body>
</html>
