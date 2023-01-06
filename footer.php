<footer>
                <ul>
                    <li><a href="https://github.com/morgane-marechal/reservation-salles" target="_blank" ><img class="logo" src="github-noir.png" alt="github"></a></li>
                    <?php if (empty($_SESSION['login'])){?>
                    <li class="lien"><a href="connection.php">Se connecter</a></li>
                    <li class="lien"><a href="inscription.php">S'inscrire</a></li>
                    <?php } ?>
                </ul>
</footer>