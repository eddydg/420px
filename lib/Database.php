<?php

require_once("config.php");

class Database {

    static function getDB() {
        try {
            $PDO = new PDO(DB_TYPE . ":host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
            $PDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
            $PDO->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
            return $PDO;
        } catch (PDOException $e) {
            echo "Connexion impossible à la base de données";
        }
    }
}

?>
