<header>
        <nav>
        <li><?php if (isset($_SESSION['login'])){echo "<p>Bienvenue ".$_SESSION['login']." ! Vous êtes connecté ! </p>";}?></li>

            <ul>
                <li><a href=index.php>Accueil</a></li>
                <li><a href=display-score.php>Scores</a></li>
                <?php if (isset($_SESSION['login'])&& !empty($_SESSION['login'])){?>
                <li><a href=logout.php>Déconnexion</a></li>
                <?php } ?>
                <?php if (empty($_SESSION['login'])){?>
                <li><a href=connexion.php>Connexion</a></li>
                <li><a href=inscription.php>Inscription</a></li>
                <?php } ?>

            </ul>
        </nav>
    </header>