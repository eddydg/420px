<?php

class Auth {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function isLogged() {
        if (isset($_SESSION['Auth']) && isset($_SESSION['Auth']['login']) && isset($_SESSION['Auth']['password'])) {
            extract($_SESSION['Auth']);

            $req = $this->db->prepare(
                "SELECT * FROM User WHERE email = ? and password = ?");
            $req->execute(array($login, $password));

            return $req->fetch();
        }
        return false;
    }

    public function login($email, $password) {
        $hashed_pass = hash(HASH_TYPE, $password);

        $req = $this->db->prepare(
            "SELECT * FROM User WHERE email = ? and password = ?");
        $req->execute(array($email, $hashed_pass));

        if ($result = $req->fetch()) {
            $_SESSION['Auth'] = array(
                'userId' => $result->id,
                'login' => $email,
                'password' => $hashed_pass
            );
            return true;
        } else {
            return false;
        }
    }

    public function register($email, $password) {

        // Check if email isn't already used
        $req = $this->db->prepare("SELECT * FROM User WHERE email = ?");
        $req->execute(array($email));

        if ($result = $req->fetch())
            return false;

        // Registering new user
        $req = $this->db->prepare("INSERT INTO user (email, password) VALUES (?, ?)");

        $hashed_pass = hash(HASH_TYPE, $password);

        if ($req->execute(array($email, $hashed_pass))) {
            $this->login($email, $password);
            return true;
        } else {
            return false;
        }

    }
}

 ?>
