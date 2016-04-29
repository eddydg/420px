<?php
require_once("lib/Database.php");
require_once("lib/ImageManager.php");
require_once("lib/RSSFeed.php");

$ImageManager = new ImageManager(Database::getDB());

$userId = 0;
if (isset($_GET['userId'])) {
  $userId = $_GET['userId'];
}
header('Content-type: text/xml');
echo RSSFeed::getFeed($ImageManager->getImages($userId));
?>
