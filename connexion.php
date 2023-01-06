<?php
session_start();
?>

<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css" />
        <meta http-equiv="x-ua-compatible" content="IE=edge" />
        <title>Connection</title>

</head>
<body>
<?php include('header.php'); ?>
    

    <main>
            <section id="connexion_form">
                <form action="" method="post">
                    <h3>Connexion</h3>
                    <input type="text" name="login" id="login" placeholder="Login*" required minlength="3"> 
                    <input type="password" name="password" id="password" placeholder="Password*" required minlength="5">
                    </select>
                    <input class="submit" type="submit" value="Envoyer">
                    <i class="small">* Champs obligatoires avec 3 caractères minimum</i>
                    <?php

                    //------------------------code pour définir variable --------------------------
                    $login = $_POST['login']; 
                    $password = $_POST['password'];
                    $email = $_POST['email']; 



                        //------------------------code pour le formulaire de connexion --------------------------
                        include 'User-PDO.php';
                        if(isset($_POST['login']) && isset($_POST['password'])){
                            
                            if((isset($_POST['login'])) AND (isset($_POST['password']))){
                                echo "<br>Le mot de passe est ".$_POST['password'];
                                echo "<br>Le login est ".$login."<br>";
                                $test0 = new User("$login",$_POST['password'], "$email");
                                $test0 ->connect("$login",$_POST['password'], "$email"); 
                    
                                
                            }
                        }else{
                            echo "Il manque au moins un champs à remplir";
                        }
                                
                        ?>
                </form>
            </section>
    </main>
    <?php include('footer.php'); ?>
</body>
    
    
        