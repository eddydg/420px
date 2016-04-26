<?php

if (isset($_POST["user_name"]) && isset($_POST["user_password"])) {
    if ($Auth->login($_POST["user_name"], $_POST["user_password"])) {
        $messageSuccess = "Vous êtes connecté !";
        ?>
        <script type="text/javascript">
            setTimeout("window.location.href = 'index.php';", 1500);
        </script>
        <?php
    } else {
        $messageError .= "Identifiants incorrects.";
    }
}



?>

<form method="post" class="navbar-form navbar-left" role="search">
    <div class="form-group">
        <input type="input" name="user_name" value="" class="form-control" placeholder="Username" required>
        <input type="password" name="user_password" value="" class="form-control" placeholder="Password" required>
    </div>
    <button type="submit" class="btn btn-default">Se connecter</button>
</form>

<!-- <div id="content">

    <form method="post">
        <input type="input" name="user_name" value="" required>
        <input type="password" name="user_password" value="" required>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>

</div> -->
