<?php
session_start();
?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css" />
        <meta http-equiv="x-ua-compatible" content="IE=edge" />
        <title>Memory</title>

</head>
<body>
    
    <?php include('header.php'); ?> 

    <div id="sessionlog">
        <?php if (isset($_SESSION['login'])){
                        echo "<p>Bonjour ".$_SESSION['login'].". Vous êtes connecté</p>";
                    }
        ?>
    </div>
    <main>
        <div id="room">
            <div id="welcome">
                <h1>Voulez-vous jouer au Memory ?</h1>
            </div>
        </div>
    </main>

    <?php include('footer.php'); ?>
</body>