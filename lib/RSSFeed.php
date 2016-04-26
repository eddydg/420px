<?php

class RSSFeed {

    public static function getFeed($images) {
        $result = "<?xml version='1.0' encoding='UTF-8'?>";
        $result .= "<rss version='2.0'>";
        $result .= "<channel>";
        $result .= "<title>420px</title>";

        foreach ($images as $image) {
            $result .= "<item>";

            $result .= "<title>" . $image->name . "</title>";
            $result .= "<image><url>" . IMG_TARGET_FOLDER . $image->name . "</url></image>";

            $result .= "</item>";
        }

        $result .= "</channel>";
        $result .= "</rss>";

        return $result;
    }

    public static function saveFeed($images) {
        file_put_contents("rss.xml", RSSFeed::getFeed($images));
    }
}

?>
