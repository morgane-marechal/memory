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
     

        <div id="memory-card">
        <!-- <img src="images/1.jpg"/> -->
        
        </div>

        <?php include 'Card-PDO.php'; ?>
        <div id="all-card">

        <?php

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
                $faceon = "<img src = 'images/".$value."'/>";
                echo "<form id = 'board-card' method='get'><div class='card'><button type='submit' name='button".$key."'>$faceon</div> </form>";
                $id = $key;
                $infoCard[$key] = new Game("$id","$faceon");
            }
    }elseif(($_SESSION['memory_game'] == "card_set")){
        $display = $_SESSION['order_card'];

        foreach ($display as $key => $value){
            $faceon = "<img src = 'images/".$value."'/>";
        echo "<form id = 'board-card' method='get'><div class='card'><button type='submit' name='button".$key."'>$faceon</div> </form>";
        $id = $key;
        $infoCard[$key] = new Game("$id","$faceon");
    }
    }

       echo $infoCard[23]->getId();
       //echo $infoCard[10]->getFaceOn();
        /* ___________________________pour comparer deux résultats de cartes, chercher du côtés de GET ________*/
    
        ?>

         <?php  
        // echo $_SESSION['memory_game'];
        // if($_SESSION['memory_game'] != "card_set"){

        //     $allInfo = $bdd -> prepare("SELECT * FROM cartes LIMIT 24 ;  ");
        //     $allInfo -> execute();
        //     $result = $allInfo->fetchAll(PDO::FETCH_ASSOC);
        //     shuffle($result);
        //     $infoCard=$result;
        //     var_dump($infoCard);
            
        //     $_SESSION['order_card'] = $infoCard;
        //     $_SESSION['memory_game'] = "card_set";
            
        //     for ($i = 0; $i <= 24; $i++) {
        //     $id=$result[$i]['id'];
        //     $name=$result[$i]['nom_carte'];
        //     $faceon=$result[$i]['face_on'];
        //     $faceoff=$result[$i]['face_off'];
        //     $infoCard[$i] = new Card("$id","$name", "$faceon", "$faceoff");
        //     echo "<form method='post'><div class='card'><button type='submit' name='button".$i."'>".$faceon."</div> </form>";
        //     }
        // }elseif(($_SESSION['memory_game'] == "card_set")){
        //    $infoCard = $_SESSION['order_card'];
        //    $result=$infoCard;
        //    //echo  var_dump($infoCard);

        //     for ($i = 0; $i <= 23; $i++) {
        //         $id=$result[$i]['id'];
        //         $name=$result[$i]['nom_carte'];
        //         $faceon=$result[$i]['face_on'];
        //         $faceoff=$result[$i]['face_off'];
        //         $infoCard[$i] = new Card("$id","$name", "$faceon", "$faceoff");
        //         echo "<form method='post'><div class='card'><button type='submit' name='button".$i."'>".$faceon."</div> </form>";
        //         }
        // }
         


            // $allInfo = $bdd -> prepare("SELECT * FROM cartes LIMIT 24 ;  ");
            // $allInfo -> execute();
            // $result = $allInfo->fetchAll(PDO::FETCH_ASSOC);
            // shuffle($result);
            // $infoCard=$result;
            // //var_dump($infoCard);
            // $_SESSION['memory_game'] = $infoCard;
            // for ($i = 0; $i <= 24; $i++) {
            //     $id=$result[$i]['id'];
            //     $name=$result[$i]['nom_carte'];
            //     $faceon=$result[$i]['face_on'];
            //     $faceoff=$result[$i]['face_off'];
            //     $infoCard[$i] = new Card("$id","$name", "$faceon", "$faceoff");
            //     echo "<form method='post'><div class='card'><button type='submit' name='button".$i."'>".$faceon."</div> </form>";
            // }
        
        //?>
       

        <?php
        //echo "<div class='card'>".$result[1]['face_off']."</div>";
        // $name3 = $infoCard[3]->getName();
        // echo $infoCard[0]->getId();
        // echo $infoCard[1]->getId();
        
        // $faceOff1 = $infoCard[1]->getFaceOff();
        // //echo "<br>".$faceOff1."</br>";
        // $faceOn3 = $infoCard[3]->getFaceOn();

        // if($name1 === $name3){
        //     echo "Ces deux cartes sont les mêmes c'est merveilleux !<br>";
        // }else{
        //     echo "Les deux cartes sont différentes";
        // };

        // if ($faceOn1 === $faceOn3){
        //     echo "Les deux faces sont les mêmes c'est merveilleux";
        // }else{
        //     echo "Les faces sont différentes";
        // };
        // $card0=$infoCard[0];
        // $name0 = $infoCard[0]->getName();
        // $faceOn0 = $infoCard[0]->getFaceOn();
        // $faceOff0= $infoCard[0]->getFaceOff();
        // echo $faceOff0;
        // function returnCard0($card0,$name0, $faceOn0, $faceOff0){
        //     echo "<h1>Agit sur image 0 </h1>";
        //     echo "son nom est ".$name0;
        //     $card0->setFaceOff($faceOn0);
        //     echo $faceOn0;
        // }




        ?>

<?php
        
        ?>
  
        </div>

        </div>
    </main>


    <?php include('footer.php'); ?>
</body>