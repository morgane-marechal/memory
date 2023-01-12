<?php
session_start();
?>

<?php

?>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css" />
        <meta http-equiv="x-ua-compatible" content="IE=edge" />
        <title>Memory</title>

</head>
<body>
    
    <?php include('header.php'); ?> 
    <?php $num_for_win_game=count($permanent_array); //<-condition de fin de jeu quand ce tableau comporte le nombre total de carte
    $total_card=$_SESSION['total_card'];
    if($num_for_win_game===$total_card){
        echo "<div id = 'win'>Bravo vous avez fini le jeu !<br></div>";
}
    echo $total_card;?>
    <?php include ('get-button.php'); ?>


    <div id="sessionlog">
        <?php if (isset($_SESSION['login'])){
                        echo "<p>Bonjour ".$_SESSION['login'].". Vous êtes connecté</p>";
                    }
        ?>
    </div>
    <main>
                <?php if(empty($_SESSION['login'])){
                    echo "<div id='welcome_no_connect'>Vous devez être connecté pour jouer au Memory !</div>";
                }
                ?>
                <?php if (isset($_SESSION['login'])&& !empty($_SESSION['login'])){?>

            
                <div id="welcome">
                    <h1>Voulez-vous jouer au Memory ?</h1>
                </div>
                <div id="buttons">

                    <form id = "nb-pairs" action="" method="post">
                        <label for="nombre de paires">Nombre de paires :</label>
                        <SELECT name="nb_pairs" >
                        <OPTION>3
                        <OPTION>4
                        <OPTION>5
                        <OPTION>6
                        <OPTION>7
                        <OPTION>8
                        <OPTION>9
                        <OPTION>10
                        <OPTION>11
                        <OPTION>12
                        </SELECT>
                        <input class="submit" type="submit" value="Envoyer">
                        <i class="small">* Toujours reset avant de lancer une nouvelle partie</i>
                    </form>

                    <form id="reset" action="" method="post">
                        <input class="submit" name = "reset" type="submit" value="Reset">
                    </form>

                </div>
            <?php } ?>
        
            <?php include 'Card-PDO.php'; ?>
            <div id="all-card">
    <?php
        //_______________pour reset session_____________
    
        if(isset($_POST['reset'])){
            $_SESSION['temporary_array']=[]; //pour réinitialiser le tableau
            $_SESSION['permanent_array']=[]; //pour réinitialiser le jeu
            $_SESSION['order_card']=[];
            $_SESSION['memory_game'] = [];
        }
    // echo $_SESSION['order_card'];
    // echo $_SESSION['memory_game'];
    // echo "order card : ".$_SESSION['order_card']."<br>";

            $temporary_array=$_SESSION['temporary_array'];
            $permanent_array=$_SESSION['permanent_array'];
            $num_in_arr= count($temporary_array); // <- compte jusqu'à 2 pour ensuite vider le petit tableau
            
            $num_for_win_game=count($permanent_array); //<-condition de fin de jeu quand ce tableau comporte le nombre total de carte
            $total_card=$_SESSION['total_card'];
            //echo $total_card;
            if($num_for_win_game===$total_card){
                    echo "<div id = 'win'>Bravo vous avez fini le jeu !<br></div>";
            }
            echo $_SESSION['nb_card_return']++;

    //______________________lancer la visualisation des cartes _____________________________          

                if(($_SESSION['memory_game'] != "card_set")&&(isset($_POST['nb_pairs']))){

                    $nbpairs=$_POST['nb_pairs'];
                    $display_test=[];
                    for ($i = 1; $i <= $nbpairs; $i++) {
                    $display_test[$i] = $i.'.jpg';
                    }
            
                    for ($i = 1; $i <= $nbpairs; $i++) {
                        $display_test[$nbpairs+$i] = ($i).'.jpg';
                    }
                        $display = $display_test;
                        shuffle($display);

                        $_SESSION['order_card'] = $display;
                        $_SESSION['memory_game'] = "card_set";
                        $_SESSION['total_card']=$nbpairs*2;
                        foreach ($display as $key => $value){
                            $id = $key;
                            $faceon = "<img src = 'images/".$value."'/>";
                            $infoCard[$key] = new Game("$id","$faceon");
                            echo "<form id ='board-card' titre = 'get' action='index.php'  method='get'> <div class='card'><button type='submit' value ='".$key."' name='button".$key."'>".$infoCard[$key]->getFaceOff()."</div></form>";
                        }
                }elseif(($_SESSION['memory_game'] == "card_set")){
                    //echo $_SESSION['memory_game'];
                    $display = $_SESSION['order_card'];
                    //echo  var_dump($display);
                        foreach ($display as $key => $value){
                            $id = $key;
                            $faceon = "<img src = 'images/".$value."'/>";
                            $faceoff = "<img src = 'images/back.jpg'/>";
                            $infoCard[$key] = new Game("$id","$faceon");
                            $temporary_array=$_SESSION['temporary_array'];
                            $permanent_array=$_SESSION['permanent_array'];
                            if (in_array($key,$temporary_array)|| in_array($key,$permanent_array)) {
                                echo "<form id ='board-card' titre = 'get' action='index.php'  method='get'> <div class='card'><button type='submit' value ='".$key."' name='button".$key."'>".$infoCard[$key]->getFaceOn()."</div></form>";

                            }elseif(!in_array($key, $temporary_array)|| in_array($key,$permanent_array)){
                                echo "<form id ='board-card' titre = 'get' action='index.php'  method='get'> <div class='card'><button type='submit' value ='".$key."' name='button".$key."'>".$infoCard[$key]->getFaceOff()."</div></form>";
                            }
                }

    //____________________vérifier les cartes retournées et garder en mémoire les paires________________

                if($num_in_arr === 2){
                    $val1=$temporary_array[0];
                    $val2=$temporary_array[1];
                    //echo "Les valeurs sont ".$val1."et".$val2.".";
                //aller chercher les image dont les id correspondent aux valeurs et les comparer
                $card1 = $infoCard[$val1]->getFaceOn();
                $card2 = $infoCard[$val2]->getFaceOn();

                //si card1 et card2 sont pareil push les id dans array permanent_array
                if(($card1===$card2) && ($val1!=$val2)){
                    if ($_SESSION['set_array'] != "OK"){
                        $_SESSION['set_array'] = "OK";
                        $_SESSION['nb_card_return']=1; // <-initialise variable de session qui va s'incrémenter
                        $permanent_array=[];
                    $new_permanent_array= array_merge ($temporary_array, $permanent_array);
                    $_SESSION['permanent_array']=$new_permanent_array;
                    //    echo var_dump($new_permanent_array);
                    $_SESSION['temporary_array']=[];
                    }elseif($_SESSION['set_array'] === "OK"){
                        $permanent_array=$_SESSION['permanent_array'];
                        $new_permanent_array= array_merge ($temporary_array, $permanent_array);
                    $_SESSION['permanent_array']=$new_permanent_array;
                    //    echo var_dump($new_permanent_array);
                    $_SESSION['temporary_array']=[];
                    $num_for_win_game=count($new_permanent_array); //<-condition de fin de jeu quand ce tableau comporte le nombre total de carte
                    $total_card=$_SESSION['total_card'];
                    //echo $total_card;
                    if($num_for_win_game===$total_card){
                            echo "<br><div id = 'win'>Bravo vous avez fini le jeu !<br></div>";
                            $endgame=true;
                            $_SESSION['endgame']=$endgame;
                    }

                    }
                }if(($card1===$card2) && ($val1===$val2)){
                    $_SESSION['temporary_array']=[];
                    $_SESSION['nb_card_return']=$_SESSION['nb_card_return']++;
                }
                //si card1 et card2 sont différents reset le tableau $temporary_array
                if($card1 != $card2){
                    $_SESSION['temporary_array']=[];
                    $_SESSION['nb_card_return']=$_SESSION['nb_card_return']++;
                }
                }
    }
    ?>
        </div>
    </div>
</main>


    <?php include('footer.php'); ?>
</body>