<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">402px - digest_e</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <?php if ($isLogged): ?>
                <li><a href="?p=imageManager" class="active">Gestionnaire d'images</a></li>
                <?php endif; ?>
                <li><a href="?p=rssFeed">Flux RSS</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if ($isLogged): ?>
                    <li><a href="?p=logout">Se déconnecter</a></li>
                <?php else: ?>
                    <?php include_once("pages/login.php"); ?>
                    <!--<li><a href="?p=login">Se connecter</a></li>-->
                    <li><a href="?p=register">Créer un compte</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
