<?php


// --------------------connexion à PDO----------------------------

$dsn = 'mysql:host=localhost;dbname=memory;charset=utf8';
$user = 'root';
$password = '';
$bdd = new PDO($dsn,$user,$password);

try{
    $bdd=new PDO('mysql:host=localhost;dbname=memory;charset=utf8','root','');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
    echo "Echec de la connexion: ".$e->getmessage();
    exit;
}

// --------------------calcul du score----------------------------
    if(isset($_SESSION['nb_card_return'])) {
        $_SESSION['nb_card_return']++;
    }else{
        $_SESSION['nb_card_return']=1;
    }
    $nb_card_return = $_SESSION['nb_card_return']++;
    $total_card=$_SESSION['total_card'];
    $scoreLogin = new Score("$login_id", "$nb_card_return", "$total_card");




    // faire requete PDO pour aller chercher infos du login (login et login_id)
    $login=$_SESSION['login'];

?>