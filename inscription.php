<?php
session_start();
?>

<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css" />
        <meta http-equiv="x-ua-compatible" content="IE=edge" />
        <title>Inscription</title>

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
            <section id="connexion_form">
                <form action="" method="post">
                    <h3>Création de compte</h3>
                    <input type="text" name="login" id="login" placeholder="Login*" required minlength="3">
                    <input type="text" name="email" id="email" placeholder="Email*" required minlength="3"> 
                    <input type="password" name="password" id="password" placeholder="Password*" required minlength="3">
                    </select>
                    <input class="submit" type="submit" value="Envoyer">
                    <i class="small">* Champs obligatoires avec 3 caractères minimum</i>

        
    <?php
     $login = $_POST['login']; 
     $password = $_POST['password']; // pb avec $password, n'est pas reconnu
     $email = $_POST['email']; 
     //$checkpassword = $_POST['conf_password']; 

    ?>
    <?php 
        include 'User-PDO.php';
        if((isset($_POST['login'])) AND (isset($_POST['password'])) AND (isset($_POST['email']))){
            echo "<br>Le mot de passe est ".$_POST['password'];
            echo "<br>Le login est ".$login;
            $test0 = new User("$login",$_POST['password'], "$email");
            $test0 ->register("$login",$_POST['password'], "$email"); 
        }else{
            echo "Il manque au moins un champs à remplir";
        }
        // $test = new User("marguerit","bouture12", "bibi@gmail.com");
        // $test ->register("marguerit","bouture12", "bibi@gmail.com");
    ?>
       


    </form>
</section>
</main>
<?php include('footer.php'); ?>
</body>
