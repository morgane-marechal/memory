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
    <?php include 'User-PDO.php'; ?>
    <?php include 'Score.php'; ?>

    <main>

        <?php if (empty($_SESSION['login'])){?>
            <div id="info">Connectez-vous pour voir les scores !</div>
        <?php } ?>
        <?php 
        $temporary_array=$_SESSION['temporary_array'];
        $permanent_array=$_SESSION['permanent_array'];
        
        $num_in_arr= count($temporary_array); // <- compte jusqu'à 2 pour ensuite vider le petit tableau

        $num_for_win_game=count($permanent_array); //<-condition de fin de jeu quand ce tableau comporte le nombre total de carte
        $total_card=$_SESSION['total_card'];
        //echo $total_card;
        if($num_for_win_game===$total_card){
                echo "<div id = 'win'>Bravo vous avez fini le jeu !".$_SESSION['score']."<br></div>";
  
        }

        $id= $_SESSION['id'];
        //echo "<br>Hello<br>".$id."<br><br>";
        ?>
        

        <h1>Vos meilleurs scores</h1>

        <?php
        $allScore = $bdd -> prepare("SELECT login, score, nb_card_return, total_card FROM score INNER JOIN utilisateurs ON score.login_id = utilisateurs.id where score.login_id = $id ORDER BY `score`.`score` DESC");
        $allScore -> execute();
        $resultPlayer = $allScore->fetchAll(PDO::FETCH_ASSOC);
        //echo var_dump($result);
        ?>
        <table>
            <thead>
                <tr>
                    
                    <td>Nom du joueur</td>
                    <td>Score</td>
                    <td>Cartes retournées</td>
                    <td>Nombre de cartes</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($resultPlayer as $ligne){
                    echo "<tr>";
                        foreach($ligne as $valeur){
                        echo "<td>";
                        echo $valeur;
                        echo "</td>";
                        }
                    echo "</tr>";
                }
                ?>
            </tbody>
            </table>

        <h1>Les meilleurs scores des joueurs</h1>

        <?php
        $allScore = $bdd -> prepare("SELECT login, score, nb_card_return, total_card FROM score INNER JOIN utilisateurs ON score.login_id = utilisateurs.id ORDER BY `score`.`score` DESC");
        $allScore -> execute();
        $result = $allScore->fetchAll(PDO::FETCH_ASSOC);
        //echo var_dump($result);
        ?>
        <table>
            <thead>
                <tr>
                    
                    <td>Nom du joueur</td>
                    <td>Score</td>
                    <td>Cartes retournées</td>
                    <td>Nombre de cartes</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach($result as $ligne){
                    echo "<tr>";
                        foreach($ligne as $valeur){
                        echo "<td>";
                        echo $valeur;
                        echo "</td>";
                        }
                    echo "</tr>";
                }
                ?>
            </tbody>
            </table>
    </main>
    <?php include('footer.php'); ?>
</body>