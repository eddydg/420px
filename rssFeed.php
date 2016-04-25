<?php
require_once("lib/Database.php");
require_once("lib/ImageManager.php");
require_once("lib/RSSFeed.php");

$ImageManager = new ImageManager(Database::getDB());

RSSFeed::saveFeed($ImageManager->getImages());
header('Location: rss.xml');
?>
