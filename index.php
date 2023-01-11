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
    <?php include ('get-button.php'); ?>


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
     

        <div id="memory-card">
        <!-- <img src="images/1.jpg"/> -->
        
        </div>

        <?php include 'Card-PDO.php'; ?>
        <div id="all-card">
        <?php
        //$_SESSION['temporary_array']=[]; //pour réinitialiser le tableau
        //$_SESSION['permanent_array']=[]; //pour réinitialiser le jeu

        $temporary_array=$_SESSION['temporary_array'];
        $permanent_array=$_SESSION['permanent_array'];
        var_dump($temporary_array);
        echo "<- temporary array";
        var_dump($permanent_array);
        echo "<- permanent array";
            $num_in_arr= count($temporary_array);
            echo "Taille du tableau : ".$num_in_arr." <br>";
           




            

            if($_SESSION['memory_game'] != "card_set"){
                    $display = [
                        1 => '1.jpg',
                        2 => '2.jpg',
                        3 => '3.jpg',
                        4 => '4.jpg',
                        5 => '5.jpg',
                        6 => '6.jpg',
                        7 => '7.jpg',
                        8 => '8.jpg',
                        9 => '9.jpg',
                        10 => '10.jpg',
                        11 => '11.jpg',
                        12=> '12.jpg',
                        13 => '1.jpg',
                        14 => '2.jpg',
                        15 => '3.jpg',
                        16 => '4.jpg',
                        17 => '5.jpg',
                        18 => '6.jpg',
                        19 => '7.jpg',
                        20 => '8.jpg',
                        21 => '9.jpg',
                        22 => '10.jpg',
                        23 => '11.jpg',
                        24 => '12.jpg'
                    ];
                    shuffle($display);
                    $_SESSION['order_card'] = $display;
                    $_SESSION['memory_game'] = "card_set";
                    foreach ($display as $key => $value){
                        $id = $key;
                        $faceon = "<img src = 'images/".$value."'/>";
                        $infoCard[$key] = new Game("$id","$faceon");
                        echo "<form id ='board-card' titre = 'get' action='index.php'  method='get'> <div class='card'><button type='submit' value ='".$key."' name='button".$key."'>".$infoCard[$key]->getFaceOn()."</div></form>";
                    }
            }elseif(($_SESSION['memory_game'] == "card_set")){
                    $display = $_SESSION['order_card'];
                    foreach ($display as $key => $value){
                        $id = $key;
                        $faceon = "<img src = 'images/".$value."'/>";
                        $faceoff = "<img src = 'images/back.jpg'/>";
                        $infoCard[$key] = new Game("$id","$faceon");
                        $temporary_array=$_SESSION['temporary_array'];
                        $permanent_array=$_SESSION['permanent_array'];
                        //$returnedCard = [ 1, 2,3,4,5];
                        if (in_array($key,$temporary_array)|| in_array($key,$permanent_array)) {
                            echo "<form id ='board-card' titre = 'get' action='index.php'  method='get'> <div class='card'><button type='submit' value ='".$key."' name='button".$key."'>".$infoCard[$key]->getFaceOn()."</div></form>";

                        }elseif(!in_array($key, $temporary_array)|| in_array($key,$permanent_array)){
                            echo "<form id ='board-card' titre = 'get' action='index.php'  method='get'> <div class='card'><button type='submit' value ='".$key."' name='button".$key."'>".$infoCard[$key]->getFaceOff()."</div></form>";
                        }
            }

            if($num_in_arr === 2){
                $val1=$temporary_array[0];
                $val2=$temporary_array[1];
                echo "Les valeurs sont ".$val1."et".$val2.".";
            //aller chercher les image dont les id correspondent aux valeurs et les comparer
            $card1 = $infoCard[$val1]->getFaceOn();
            $card2 = $infoCard[$val2]->getFaceOn();

            //si card1 et card2 sont pareil push les id dans array permanent_array
            if(($card1===$card2) && ($val1!=$val2)){
                if ($_SESSION['set_array'] != "OK"){
                    $_SESSION['set_array'] = "OK";
                    $permanent_array=[];
                   $new_permanent_array= array_merge ($temporary_array, $permanent_array);
                   $_SESSION['permanent_array']=$new_permanent_array;
                   echo "Tableau permanent si deux cartes pareils";
                   echo var_dump($new_permanent_array);
                   $_SESSION['temporary_array']=[];
                }elseif($_SESSION['set_array'] === "OK"){
                    echo "GGGGGGGGGGGG";
                    $permanent_array=$_SESSION['permanent_array'];
                    $new_permanent_array= array_merge ($temporary_array, $permanent_array);
                   $_SESSION['permanent_array']=$new_permanent_array;
                   echo "Tableau permanent si deux cartes pareils";
                   echo var_dump($new_permanent_array);
                   $_SESSION['temporary_array']=[];
                }
            }if(($card1===$card2) && ($val1===$val2)){
                $_SESSION['temporary_array']=[];
            }
            //si card1 et card2 sont différents reset le tableau $temporary_array
            if($card1 != $card2){
                $_SESSION['temporary_array']=[];
            }



            }

            /* ___________________________création d'un tableau de _SESSION pour les images retournées test ________*/

            // echo  $infoCard[0]->toggleFlip();
            // echo  $infoCard[0]->testFlip();
            // echo "hello".$_GET["button0"];
            // //     $card1 = $_GET["button0"];
            // //    $card2 = $_GET["button1"];
            // //    echo $card1."<br>".$card2;
            // $faceoff = "<img src = 'images/back.jpg'/>";
            // 
            // echo  $infoCard[0]->getFaceOn();
       

    //    $infoCard[$key]->toggleFlip();  // _____pour conserver carte retournée pour la prochaine instanciation 
    //    $isFlipped = $infoCard[$key]->getFlip(); // ______faire variable array de _session ?
    //    //echo gettype($isFlipped);     //___ faire 2 array, un qui contient les 2 cartes temporaires et un qui contient cartes définitivement retournée
    //    if($isFlipped === false){
    //        echo 'La variable est sur false';
    //    }elseif($isFlipped === true){
    //        echo 'La variable est sur true';
    //    }
   }


       //echo $infoCard[10]->getFaceOn();



        /* ___________________________pour comparer deux résultats de cartes, chercher du côtés de GET ________*/
    
        ?>


<?php
        
        ?>
  
        </div>
        <h1>Ecrire quelque chose ....</h1>
        <h1>Ecrire quelque chose ....</h1>
        <h1>Ecrire quelque chose ....</h1>


        </div>
    </main>


    <?php include('footer.php'); ?>
</body>