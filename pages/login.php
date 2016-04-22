<?php

if (isset($_POST["user_name"]) && isset($_POST["user_password"])) {
    if ($Auth->login($_POST["user_name"], $_POST["user_password"])) {
        echo "Connecté !";
    } else {
        echo "Pas connecté :/";
    }
}



?>

<div id="content">

    <form method="post">
        <input type="input" name="user_name" value="" required>
        <input type="input" name="user_password" value="" required>
        <input type="submit" value="Se connecter">
    </form>
</div>
