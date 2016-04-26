<?php

if (isset($_POST["user_name"]) && isset($_POST["user_password"])) {
    if ($Auth->register($_POST["user_name"], $_POST["user_password"])) {
        echo "Enregistré !";
    } else {
        echo "Pas enregistré :/";
    }
}

?>

<div id="content">

    <form method="post">
        <input type="input" name="user_name">
        <input type="input" name="user_password">
        <button type="submit" class="btn btn-primary">S'inscrire</button>
    </form>
</div>
