<?php

if (isset($_POST["user_name"]) && isset($_POST["user_password"])) {
    if (isset($_POST['login_button'])) {
        if ($Auth->login($_POST["user_name"], $_POST["user_password"])) {
            $messageSuccess = "Vous êtes connecté !";
            ?>
            <script type="text/javascript">setTimeout("window.location.href = 'index.php';", 1500);</script>
            <?php
        } else {
            $messageError .= "Identifiants incorrects.";
        }
    } elseif (isset($_POST['register_button'])) {
        if ($Auth->register($_POST["user_name"], $_POST["user_password"])) {
            $messageSuccess = "Enregistré !";
            ?>
            <script type="text/javascript">setTimeout("window.location.href = 'index.php';", 1500);</script>
            <?php
        } else {
            $messageError = "Impossible de créer ce compte.";
        }
    }

}

?>

<form method="post" class="navbar-form navbar-left" role="search">
    <div class="form-group">
        <input type="input" name="user_name" value="" class="form-control" placeholder="Username" required>
        <input type="password" name="user_password" value="" class="form-control" placeholder="Password" required>
    </div>
    <button type="submit" name="login_button" class="btn btn-info">Se connecter</button>
    <button type="submit" name="register_button" class="btn btn-default">S'inscrire</button>
</form>
