<?php

if (isset($_POST["user_name"]) && isset($_POST["user_password"])) {
    if ($Auth->login($_POST["user_name"], $_POST["user_password"])) {
        ?>
        Vous êtes connecté !
        <script type="text/javascript">
            setTimeout("window.location.href = 'index.php';", 1500);
        </script>
        <?php
    } else {
        ?>
        Identifiants incorrects.
        <?php
    }
}



?>

<div id="content">

    <form method="post">
        <input type="input" name="user_name" value="" required>
        <input type="password" name="user_password" value="" required>
        <input type="submit" value="Se connecter">
    </form>
</div>
