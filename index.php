<?php
require_once("config.php");
require_once("lib/Database.php");
require_once("lib/Auth.php");
require_once("lib/ImageManager.php");
require_once("lib/SimpleImage.php");

session_start();

$db = Database::getDB();
$Auth = new Auth($db);
$ImageManager = new ImageManager($db);

$isLogged = $Auth->isLogged();
$messageError = "";
$messageWarning = "";
$messageSuccess = "";
$messageInfo = "";

$page = "home";
if (isset($_GET["p"])) {
    $page = $_GET["p"];

    if ($page == "rssFeed") {
        header('Location: rssFeed.php');
        exit();
    }
    elseif ($page == "login" && $isLogged) {
        header('Location: index.php');
    }
    elseif  (file_exists("pages/" . $_GET["p"] . ".php")) {

        if ($page == "imageManager" && !$isLogged)
            header('Location: index.php');
    }
    else
        $page = "404";
}
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <title>420px</title>
    <!-- <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="//bootswatch.com/darkly/bootstrap.min.css">
    <link rel="stylesheet" href="//blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
    <link rel="stylesheet" href="public/css/bootstrap-image-gallery.min.css">
    <link rel="stylesheet" href="public/css/style.css">
    </head>
    <body>

        <!-- Navigation Bar -->
        <nav>
            <?php include("inc/menu.php"); ?>
        </nav>

        <!-- Debug Info -->
        <!-- <h3>Session</h3> -->
        <?php //var_dump($_SESSION); ?>

        <?php if ($messageError != "" || $messageWarning != "" || $messageSuccess != "" || $messageInfo != ""): ?>
            <h3>Infos</h3>

            <?php if ($messageError != "") {
                echo "<div class='alert alert-danger' role='alert'>$messageError</div>";
            } ?>
            <?php if ($messageWarning != "") {
                echo "<div class='alert alert-warning' role='alert'>$messageWarning</div>";
            } ?>
            <?php if ($messageSuccess != "") {
                echo "<div class='alert alert-success' role='alert'>$messageSuccess</div>";
            } ?>
            <?php if ($messageInfo != "") {
                echo "<div class='alert alert-info' role='alert'>$messageInfo</div>";
            } ?>
        <?php endif; ?>

        <!-- Main Content -->
        <div id="page">
            <?php include_once("pages/" . $page . ".php"); ?>
        </div>

        <div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-use-bootstrap-modal="false">
            <!-- The container for the modal slides -->
            <div class="slides"></div>
            <!-- Controls for the borderless lightbox -->
            <h3 class="title"></h3>
            <a class="prev">‹</a>
            <a class="next">›</a>
            <a class="close">×</a>
            <a class="play-pause"></a>
            <ol class="indicator"></ol>
            <!-- The modal dialog, which will be used to wrap the lightbox content -->
            <div class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body next"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default pull-left prev">
                                <i class="glyphicon glyphicon-chevron-left"></i>
                                Previous
                            </button>
                            <button type="button" class="btn btn-primary next">
                                Next
                                <i class="glyphicon glyphicon-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="//blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
        <script src="public/js/bootstrap-image-gallery.min.js"></script>
    </body>
</html>
