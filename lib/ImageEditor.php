<?php

class ImageEditor {

    public static function setContrast($imagePath, $value) {
        $image = new abeautifulsite\SimpleImage($imagePath);
        $image->contrast($value);
        $image->save();
    }

    public static function setBrightness($imagePath, $value) {
        $image = new abeautifulsite\SimpleImage($imagePath);
        $image->brightness($value);
        $image->save();
    }

    public static function setSepia($imagePath) {
        $image = new abeautifulsite\SimpleImage($imagePath);
        $image->sepia();
        $image->save();
    }
    public static function setDesaturate($imagePath) {
        $image = new abeautifulsite\SimpleImage($imagePath);
        $image->desaturate();
        $image->save();
    }
    public static function setGauss($imagePath) {
        $image = new abeautifulsite\SimpleImage($imagePath);
        $image->blur('gaussian', 2);
        $image->save();
    }
    public static function setEdges($imagePath) {
        $image = new abeautifulsite\SimpleImage($imagePath);
        $image->edges();
        $image->save();
    }

    public static function getMainColors($imagePath, $number = 5) {
        $palette = League\ColorExtractor\Palette::fromFilename($imagePath);
        $extractor = new League\ColorExtractor\ColorExtractor($palette);
        $colors = array();
        foreach ($extractor->extract($number) as $color) {
            array_push($colors, League\ColorExtractor\Color::fromIntToHex($color));
        }
        return $colors;
    }

}


?>
